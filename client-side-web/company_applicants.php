<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php

if (!isset($_SESSION['company_id'])) {
    header("Location: ../client-side-web/login and register/company_login.php");
} else {
    $company_id = $_SESSION['company_id'];
}

?>

<?php

$companies_list = " ";

$query = "SELECT
      applications.*,
      jobs.*,
      applicants.*
      FROM
      applications
      INNER JOIN jobs ON applications.job_id = jobs.job_id
      INNER JOIN applicants ON applications.applicant_id = applicants.applicant_id
      WHERE
      applications.company_id = '{$company_id}'
      AND
      applications.application_recycle_bin = 0
      ORDER BY
      applications.application_id DESC";

$result = mysqli_query($connection, $query);


if ($result) {

    if (mysqli_num_rows($result) > 0) {

        while ($record = mysqli_fetch_array($result)) {

            if ($record['is_approved'] == 0) {
                $action = "<div class='content'>
                            <a onclick='show({$record['application_id']})'>Approve</a>
                            <a href='actions/decline.php?id={$record['application_id']}'>Decline</a>
                        </div>";
            } elseif ($record['is_approved'] == 1) {
                $action = "<a>Approved</a>";
            } else {
                $action = "<a>Declined</a>";
            }

            $companies_list .= "<tbody>";
            $companies_list .= "<tr>";
            $companies_list .= "<td class=\"text-left\"> {$record['application_id']} </td>";
            $companies_list .= "<td class=\"text-left\"> {$record['applicant_id']} </td>";
            $companies_list .= "<td class=\"text-left\"> {$record['applicant_full_name']} </td>";
            $companies_list .= "<td class=\"text-left\"> {$record['job_role']} </td>";
            $companies_list .= "<td class=\"text-left\"> {$record['applicant_contact_email']} </td>";
            $companies_list .= "<td class=\"text-left\"> {$record['applicant_mobile_number']} </td>";
            $companies_list .= "<td class=\"text-left\"> <a href=\"./components/cv_downloads.php?cv_file={$record['applicant_cv']}\"><button class=\"downloadBtn\">Download CV</button></a></td>";
            $companies_list .= "<td class=\"text-left\"> <a href=\"./components/cover_letter_downloads.php?cv_file={$record['applicant_cover_letter']}\"><button class=\"downloadBtn\">Download Cover Letter</button></a></td>";
            $companies_list .= "<td class=\"text-left\"> {$action} </td>";
            $companies_list .= "</tr>";
            $companies_list .= "</tbody>";
        }
    } else {
        $companies_list .= "<tbody><tr><div class='filter-warning'><h1>Ooops... No Any Applications Found!</h1></div></tr></tbody>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOB HORIZON | Applicants</title>

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
    <link rel="stylesheet" href="../client-side-web/css/box.css?v=<?php echo time() ?>">

</head>

<body>
    <?php require_once('components/header.php'); ?>
    <main>

        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="../client-side-web/assets/images/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>My Applicants</h2>
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
                                <th>Application ID</th>
                                <th>Applicant's ID</th>
                                <th>Applicant's Full Name</th>
                                <th>Applied Job Role</th>
                                <th>Applicant's Email</th>
                                <th>Applicant's Mobile Number</th>
                                <th>Applicant's CV</th>
                                <th>Applicant's Cover Letter hi</th>
                                <th>Approvel</th>
                            </tr>
                            <tr>
                                <?php echo $companies_list ?>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </section>

        <div class="conform-box" id="detail-box" style="display: none;">
            <div>
                <button class="closebtn" onclick="closebox()">X</button>
                <form action="actions/aprove.php" method="post">
                    <h1>Applicant Interview</h1>
                    <input type="hidden" name="application_id" id="application_id">
                    <textarea name="description" placeholder="Enter description..." required></textarea>
                    <textarea name="interview_link" placeholder="Enter Interview Link..." required></textarea>
                    <input type="submit" value="Submit" name="details-submit">
                </form>
            </div>
        </div>

        

        <?php require_once('../client-side-web/components/footer.php'); ?>

        <!-- JS here -->

        <!-- All JS Custom Plugins Link Here here -->
        <script src="../client-side-web/components/js/vendor/modernizr-3.5.0.min.js"></script>
        <!-- Jquery, Popper, theme -->
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

    <script>
        function show(id) {
            document.getElementById('application_id').value = id; // Set the application ID
            document.getElementById('detail-box').style.display = 'flex'; // Show the box
        }

        function closebox() {
            document.getElementById('detail-box').style.display = 'none'; // Hide the box
        }
    </script>

</body>

</html>

<?php mysqli_close($connection); ?>