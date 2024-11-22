<?php session_start(); ?>
<?php require_once('../../connection/dbconnection.php'); ?>

<?php

if (!isset($_SESSION['company_id'])) {
    header("Location: ../login and register/company_login.php");
} else {
    $company_id = $_SESSION['company_id'];
}

?>

<?php

if (isset($_POST['submit'])) {

    $cat = mysqli_real_escape_string($connection, $_POST['job_category']);
    $j_role = mysqli_real_escape_string($connection, $_POST['job_role']);
    $sal = mysqli_real_escape_string($connection, $_POST['salary']);
    $sal_type = mysqli_real_escape_string($connection, $_POST['salary_type']);
    $j_loc = mysqli_real_escape_string($connection, $_POST['job_location']);
    $desc = mysqli_real_escape_string($connection, $_POST['description']);
    $vac = mysqli_real_escape_string($connection, $_POST['vacancies']);
    $j_nat = mysqli_real_escape_string($connection, $_POST['job_nature']);
    $req_skills = mysqli_real_escape_string($connection, $_POST['requirement_skills']);
    $ed_exp = mysqli_real_escape_string($connection, $_POST['education_and_experience']);
    $app_deadline = mysqli_real_escape_string($connection, $_POST['deadline']);

    $query = "INSERT INTO jobs(company_id, category, job_role, salary, salary_type, location, description, vacancies, job_nature, requirement_skills, education_and_experience, deadline)
              VALUES ('{$company_id}', '{$cat}', '{$j_role}','{$sal}', '{$sal_type}', '{$j_loc}','{$desc}','{$vac}','{$j_nat}','{$req_skills}','{$ed_exp}','{$app_deadline}')";

    $result = mysqli_query($connection, $query);

    if ($result) { ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="manifest" href="site.webmanifest">
            <title>HireME | Successful</title>

            <link rel="shortcut icon" type="image/x-icon" href="../../assets/favicon/favicon.ico">

            <link rel="stylesheet" href="../client-side-web/css/bootstrap.min.css">
            <link rel="stylesheet" href="../client-side-web/css/owl.carousel.min.css">
            <link rel="stylesheet" href="../client-side-web/css/flaticon.css">
            <link rel="stylesheet" href="../client-side-web/css/price_rangs.css">
            <link rel="stylesheet" href="../client-side-web/css/slicknav.css">
            <link rel="stylesheet" href="../client-side-web/css/animate.min.css">
            <link rel="stylesheet" href="../client-side-web/css/magnific-popup.css">
            <link rel="stylesheet" href="../client-side-web/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="../client-side-web/css/themify-icons.css">
            <link rel="stylesheet" href="../client-side-web/css/slick.css">
            <link rel="stylesheet" href="../client-side-web/css/nice-select.css">
            <link rel="stylesheet" href="../client-side-web/css/style.css">
            <link rel="stylesheet" href="../client-side-web/css/footer.css">
            <link rel="stylesheet" href="../client-side-web/css/form.css">
            <link rel="stylesheet" href="../css/successful_message.css">

        </head>

        <body>
            <div class="container">
                <div class="popup" id="popup">
                    <img src="../../assets/images/tick.png">
                    <h2>Successfully Published!</h2>
                    <p>you will get the most exposure for your job.</p>
                    <a href="../home.php"><button type="button">ok</button></a>
                </div>
            </div>
            <script>
                let popup = document.getElementById("popup");

                function openPopup() {
                    popup.classList.add("open-popup")
                }

                function closePopup() {
                    popup.classList.remove("open-popup")
                }
            </script>

            <!-- JS here -->

            <!-- All JS Custom Plugins Link Here here -->
            <script src="../client-side-web/components/js/vendor/modernizr-3.5.0.min.js"></script>
            <!-- Jquery, Popper, Bootstrap -->
            <script src="../client-side-web/components/js/vendor/jquery-1.12.4.min.js"></script>
            <script src="../client-side-web/components/js/popper.min.js"></script>
            <script src="../client-side-web/components/js/bootstrap.min.js"></script>
            <!-- Jquery Mobile Menu -->
            <script src="../client-side-web/components/js/jquery.slicknav.min.js"></script>

            <!-- Jquery Slick , Owl-Carousel Plugins -->
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

<?php } else {
        header('Location: error.php');
    }
} else {
    header('Location: ../post_job.php');
}

?>

<?php mysqli_close($connection); ?>