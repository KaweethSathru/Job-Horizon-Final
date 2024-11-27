<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php

if (!isset($_SESSION['applicant_id'])) {
    header("Location: ../client-side-web/login and register/applicant_login.php");
} else {
    $applicant_id = $_SESSION['applicant_id'];
}

?>

<?php
if (isset($_GET['job_id']) && isset($_GET['company_id'])) {
    $com_id = $_GET['company_id'];
    $j_id = $_GET['job_id'];
} else {
    echo "ID pass failed!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOB HORIZON | Apply Now</title>
    <link rel="manifest" href="site.webmanifest">

    <link rel="shortcut icon" type="image/x-icon" href="../assets/favicon/favicon.ico">

    <link rel="stylesheet" href="../client-side-web/css/theme.css">
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
    <link rel="stylesheet" href="../client-side-web/css/form.css">
    <link rel="stylesheet" href="../client-side-web/css/footer.css">

</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="../client-side-web/assets/images/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <?php require_once('../client-side-web/components/header.php'); ?>

    <main>

        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="../client-side-web/assets/images/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Apply Now</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->

        <center>

            <div class="formbold-main-wrapper">
                <div class="formbold-form-wrapper">
                    <div class="formbold-mb-5 formbold-pt-3">
                    </div>

                    <form action="../client-side-web/components/application_successful.php?job_id=<?= $j_id ?>&company_id=<?= $com_id ?>" method="POST" enctype="multipart/form-data">

                        <div class="formbold-mb-5">
                            <label for="name" class="formbold-form-label"> Full Name </label>
                            <input type="text" name="full_name" id="name" placeholder="Full Name" class="formbold-form-input" />
                        </div>
                        <div class="formbold-mb-5">
                            <label for="phone" class="formbold-form-label"> Mobile Number </label>
                            <input type="text" name="mobile_no" id="phone" placeholder="Enter your phone number" class="formbold-form-input" />
                        </div>
                        <div class="formbold-mb-5">
                            <label for="email" class="formbold-form-label"> Email Address </label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" class="formbold-form-input" />
                        </div>
                        <div class="flex flex-wrap formbold--mx-3">
                            <div class="w-full sm:w-half formbold-px-3">
                                <div class="formbold-mb-5 w-full">
                                    <label for="date" class="formbold-form-label"> CV </label>
                                    <input type="file" name="cv" class="formbold-form-input" />
                                </div>
                            </div>
                            <div class="w-full sm:w-half formbold-px-3">
                                <div class="formbold-mb-5">
                                    <label for="time" class="formbold-form-label"> Cover Letter </label>
                                    <input type="file" name="cover_letter" class="formbold-form-input" />
                                </div>
                            </div>
                        </div>
                        <div class="formbold-mb-5 formbold-pt-3">
                        </div>

                        <div>
                            <input type="submit" name="submit" value="Apply for job" class="formbold-btn">
                        </div>

                    </form>

                </div>
            </div>

        </center>

    </main>

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

<?php mysqli_close($connection); ?>