<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php
// Check if the user is logged in as a company
if (!isset($_SESSION['company_id'])) {
    header("Location: ../client-side-web/login and register/company_login.php");
    exit();
}

$company_id = $_SESSION['company_id'];

$jobs_list = "";

// Fetch all active job posts for the logged-in company
$query = "SELECT * FROM jobs
          WHERE company_id = '{$company_id}'
          AND jobs_recycle_bin = 0
          ORDER BY job_id DESC";

$result = mysqli_query($connection, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result)) {
            $jobs_list .= "<tbody>";
            $jobs_list .= "<tr>";
            $jobs_list .= "<td class=\"text-left\"> {$record['job_id']} </td>";
            $jobs_list .= "<td class=\"text-left\"> {$record['category']} </td>";
            $jobs_list .= "<td class=\"text-left\"> {$record['job_role']} </td>";
            $jobs_list .= "<td class=\"text-left\"> {$record['salary']} </td>";
            $jobs_list .= "<td class=\"text-left\"> {$record['salary_type']} </td>";
            $jobs_list .= "<td class=\"text-left\"> {$record['location']} </td>";
            $jobs_list .= "<td class=\"text-left\"> {$record['description']} </td>";
            $jobs_list .= "<td class=\"text-left\"> {$record['vacancies']} </td>";
            $jobs_list .= "<td class=\"text-left\"> {$record['job_nature']} </td>";
            $jobs_list .= "<td class=\"text-left\"> {$record['requirement_skills']} </td>";
            $jobs_list .= "<td class=\"text-left\"> {$record['education_and_experience']} </td>";
            $jobs_list .= "<td class=\"text-left\"> {$record['deadline']} </td>";
            $jobs_list .= "<td class=\"text-left\"> {$record['posted_date']} </td>";
            $jobs_list .= "<td class=\"text-left\">
                            <a href=\"../client-side-web/components/cancel_job_post.php?job_id={$record['job_id']}\" 
                            onclick=\"return confirm('Are you sure you want to remove this job post?');\">
                            <button class=\"cancelBtn\">Remove Post</button></a>
                           </td>";
            $jobs_list .= "</tr>";
            $jobs_list .= "</tbody>";
        }
    } else {
        $jobs_list .= "<tbody><tr><div class='filter-warning'><h1>Ooops... No Job Posts Found!</h1></div></tr></tbody>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOB HORIZON | Job Posts</title>

    <link rel="shortcut icon" type="image/x-icon" href="../assets/favicon/favicon.ico">
    <link rel="stylesheet" href="../client-side-web/css/theme.css">
    <link rel="stylesheet" href="../client-side-web/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../client-side-web/css/price_rangs.css">
    <link rel="stylesheet" href="../client-side-web/css/flaticon.css">
    <link rel="stylesheet" href="../client-side-web/css/slicknav.css">
    <link rel="stylesheet" href="../client-side-web/css/animate.min.css">
    <link rel="stylesheet" href="../client-side-web/css/magnific-popup.css">
    <link rel="stylesheet" href="../client-side-web/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../client-side-web/css/themify-icons.css">
    <link rel="stylesheet" href="../client-side-web/css/slick.css">
    <link rel="stylesheet" href="../client-side-web/css/nice-select.css">
    <link rel="stylesheet" href="../client-side-web/css/style.css">
    <link rel="stylesheet" href="../client-side-web/css/footer.css">
    <link rel="stylesheet" href="../client-side-web/css/tables.css">
</head>

<body>
    <?php require_once('../client-side-web/components/header.php'); ?>
    <main>
        <!-- Hero Area Start -->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" 
                 data-background="../client-side-web/assets/images/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>My Job Posts</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->

        <section class="featured-job-area filterContainer">
            <div class="tableContainer">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <table id="customers">
                            <tr>
                                <th>Job ID</th>
                                <th>Category</th>
                                <th>Job Role</th>
                                <th>Salary</th>
                                <th>Salary Type</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Vacancies</th>
                                <th>Job Nature</th>
                                <th>Requirement Skills</th>
                                <th>Education and Experience</th>
                                <th>Deadline</th>
                                <th>Posted Date</th>
                                <th>Options</th>
                            </tr>
                            <?php echo $jobs_list ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <?php require_once('../client-side-web/components/footer.php'); ?>
    </main>

        <!-- JS here -->

        <!-- All JS Custom Plugins Link Here here -->
        <script src="../client-side-web/components/js/vendor/modernizr-3.5.0.min.js"></script>
        <!-- Jquery, Popper, Bootstrap -->
        <script src="../client-side-web/components/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="../client-side-web/components/js/popper.min.js"></script>
        <script src="../client-side-web/components/js/theme.js"></script>
        <!-- Jquery Mobile Menu -->
        <script src="../client-side-web/components/js/jquery.slicknav.min.js"></script>

        <!-- Jquery Slick , Owl-Carousel Range -->
        <script src="../client-side-web/components/js/owl.carousel.min.js"></script>
        <script src="../client-side-web/components/js/slick.min.js"></script>
        <script src="../client-side-web/components/js/price_rangs.js"></script>
        <!-- One Page, Animated-HeadLin -->
        <script src="../client-side-web/components/js/wow.min.js"></script>
        <script src="../client-side-web/components/js/animated.headline.js"></script>
        <script src="../client-side-web/components/js/jquery.magnific-popup.js"></script>

        <!-- Scrollup, nice-select, sticky -->
        <script src="../client-side-web/components/js/jquery.scrollUp.min.js"></script>
        <script src="../client-side-web/components/js/jquery.nice-select.min.js"></script>
        <script src="../client-side-web/components/js/jquery.sticky.js"></script>

        <!-- contact js -->
        <script src="../client-side-web/components/js/contact.js"></script>
        <script src="../client-side-web/components/js/jquery.form.js"></script>
        <script src="../client-side-web/components/js/jquery.validate.min.js"></script>
        <script src="../client-side-web/components/js/mail-script.js"></script>
        <script src="../client-side-web/components/js/jquery.ajaxchimp.min.js"></script>

        <!-- Jquery Plugins, main Jquery -->
        <script src="../client-side-web/components/js/plugins.js"></script>
        <script src="../client-side-web/components/js/main.js"></script>
</body>

</html>

<?php mysqli_close($connection); ?>
