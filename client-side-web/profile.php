<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php

if (isset($_SESSION['applicant_id'])) {

    $applicant_id = $_SESSION['applicant_id'];

    $query = "SELECT * FROM applicants
        WHERE
        applicant_id = '{$applicant_id}'
        AND
        applicant_recycle_bin = 0
        LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {

        if (mysqli_num_rows($result) > 0) { ?>

            <?php while ($record = mysqli_fetch_array($result)) {

                $_GET['applicant_id'] = $record['applicant_id'];

            ?>

                <!doctype html>
                <html class="no-js" lang="zxx">

                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="x-ua-compatible" content="ie=edge">
                    <title>JOB HORIZON | <?php echo $record['applicant_username'] ?></title>
                    <meta name="description" content="">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                    <link rel="stylesheet" href="../client-side-web/css/footer.css">
                    <link rel="stylesheet" href="../client-side-web/css/profile.css">
                    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/theme.js"></script>
                    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/theme.css" rel="stylesheet" id="bootstrap-css"> -->

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
                                                <h2><?php echo $record['applicant_username'] ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Hero Area End -->

                        <div class="container emp-profile">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-img">
                                        <img src="../assets/uploads/applicants/profile-pictures/<?php echo $record['applicant_profile_picture'] ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-head">
                                        <h5>
                                            <?php echo $record['applicant_username'] ?>
                                        </h5>
                                        <h6>
                                            <?php echo $record['applicant_email'] ?>
                                        </h6>
                                        <p class="proile-rating"><span><?php echo $record['applicant_username'] ?></span></p>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">User Info</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a href="./edit_applicant_profile.php">
                                        <button class="profile-edit-btn">Edit Profile</button>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-work">
                                        <p>SEE MY APPLICATIONS</p>
                                        <a href="./applicant_applications.php">
                                            <button class="profile-edit-btn">Go to my applications</button>
                                        </a>
                                        <!-- <p>WORK LINK</p>
                                      <a href="">Website Link</a><br />
                                      <a href="">Bootsnipp Profile</a><br />
                                      <a href="">Bootply Profile</a>
                                      <p>SKILLS</p>
                                      <a href="">Web Designer</a><br />
                                      <a href="">Web Developer</a><br />
                                      <a href="">WordPress</a><br />
                                      <a href="">WooCommerce</a><br />
                                      <a href="">PHP, .Net</a><br /> -->
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Username</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $record['applicant_username'] ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $record['applicant_email'] ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>First Name</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $record['applicant_first_name'] ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Last Name</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $record['applicant_last_name'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </main>

                    <?php require_once('../client-side-web/components/footer.php'); ?>

                    <!-- JS here -->

                    <!-- All JS Custom Plugins Link Here here -->
                    <script src="../client-side-web/components/js/vendor/modernizr-3.5.0.min.js"></script>
                    <!-- Jquery, Popper, Bootstrap -->
                    <script src="../client-side-web/components/js/vendor/jquery-1.12.4.min.js"></script>
                    <script src="../client-side-web/components/popper.min.js"></script>
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

            <?php
            }
        } else {
            echo "DB Failed!";
        }
    }
} else if (isset($_SESSION['company_id'])) {
    $company_id = $_SESSION['company_id'];

    $query = "SELECT * FROM companies
          WHERE
          company_id = '{$company_id}'
          AND
          company_recycle_bin = 0
          LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {

        if (mysqli_num_rows($result) > 0) { ?>

            <?php while ($record = mysqli_fetch_array($result)) {

                $_GET['company_id'] = $record['company_id'];

            ?>

                <!doctype html>
                <html class="no-js" lang="zxx">

                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="x-ua-compatible" content="ie=edge">
                    <title>JOB HORIZON | <?php echo $record['company_name'] ?></title>
                    <meta name="description" content="">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                    <link rel="stylesheet" href="../client-side-web/css/footer.css">
                    <link rel="stylesheet" href="../client-side-web/css/profile.css">
                    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/theme.js"></script>
                    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/theme.css" rel="stylesheet" id="bootstrap-css"> -->

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
                                                <h2><?php echo $record['company_name'] ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Hero Area End -->

                        <div class="container emp-profile">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-img">
                                        <img src="../assets/uploads/companies/company-logo/<?php echo $record['company_logo'] ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-head">
                                        <h5>
                                            <?php echo $record['company_name'] ?>
                                        </h5>
                                        <h6>
                                            <?php echo $record['company_email'] ?>
                                        </h6>
                                        <p class="proile-rating"><span><?php echo $record['company_username'] ?></span></p>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">User Info</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a href="./edit_company_profile.php">
                                        <button class="profile-edit-btn">Edit Profile</button>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-work">
                                        <p>SEE WHO ARE THE APPLICANTS</p>
                                        <a href="./company_applicants.php">
                                            <button class="profile-edit-btn">Go to my applicants</button>
                                        </a>
                                        <p>SEE MY POSTS</p>
                                        <a href="./company_job_posts.php">
                                            <button class="profile-edit-btn">Go to my posts</button>
                                        </a>
                                        <!-- <p>WORK LINK</p>
                                        <a href="">Website Link</a><br /> -->
                                        <!-- <a href="">Bootsnipp Profile</a><br />
                                        <a href="">Bootply Profile</a>
                                        <p>SKILLS</p>
                                        <a href="">Web Designer</a><br />
                                        <a href="">Web Developer</a><br />
                                        <a href="">WordPress</a><br />
                                        <a href="">WooCommerce</a><br />
                                        <a href="">PHP, .Net</a><br /> -->
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Username</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $record['company_username'] ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $record['company_email'] ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Website</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $record['company_website'] ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>About</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $record['company_description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </main>

                    <?php require_once('../client-side-web/components/footer.php'); ?>

                    <!-- JS here -->

                    <!-- All JS Custom Plugins Link Here here -->
                    <script src="../client-side-web/components/js/vendor/modernizr-3.5.0.min.js"></script>
                    <!-- Jquery, Popper, Bootstrap -->
                    <script src="../client-side-web/components/js/vendor/jquery-1.12.4.min.js"></script>
                    <script src="../client-side-web/components/popper.min.js"></script>
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

<?php
            }
        } else {
            echo "DB Failed!";
        }
    }
} else {
    header("Location: ../client-side-web/login and register/applicant_login.php");
}

?>

<?php mysqli_close($connection); ?>