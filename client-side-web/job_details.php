<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php

$j_id = " ";
$com_id = " ";

if (isset($_GET['job_id']) && isset($_GET['company_id'])) {
    // echo "Both IDs passed!";
    $_GET['com_id'] = $_GET['company_id'];
    $_GET['j_id'] = $_GET['job_id'];
} else {
    echo "ID pass failed!";
}

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>JOB HORIZON | Job Details</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">

    <link rel="shortcut icon" type="image/x-icon" href="../assets/favicon/favicon.ico">

    <link rel="stylesheet" href="../client-side-web/css/theme.css">
    <link rel="stylesheet" href="../client-side-web/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../client-side-web/css/flaticon.css">
    <link rel="stylesheet" href="../client-side-web/css/slicknav.css">
    <link rel="stylesheet" href="../client-side-web/css/price_rangs.css">
    <link rel="stylesheet" href="../client-side-web/css/animate.min.css">
    <link rel="stylesheet" href="../client-side-web/css/magnific-popup.css">
    <link rel="stylesheet" href="../client-side-web/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../client-side-web/css/themify-icons.css">
    <link rel="stylesheet" href="../client-side-web/css/slick.css">
    <link rel="stylesheet" href="../client-side-web/css/nice-select.css">
    <link rel="stylesheet" href="../client-side-web/css/style.css">
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

        <!-- job post company Start -->
        <?php

        $j_id = $_GET['job_id'];

        $query1 = "SELECT * FROM jobs WHERE job_id = '{$j_id}' LIMIT 1";

        $result1 = mysqli_query($connection, $query1);

        if ($result1) {

            while ($record1 = mysqli_fetch_array($result1)) {

                $com_id = $record1['company_id'];

                $query2 = "SELECT * FROM companies WHERE company_id = '{$com_id}' LIMIT 1";
                $result2 = mysqli_query($connection, $query2);

                if ($result2) {

                    while ($record2 = mysqli_fetch_array($result2)) {

        ?>
                        <!-- Hero Area Start-->
                        <div class="slider-area ">
                            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="../client-side-web/assets/images/hero/about.jpg">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="hero-cap text-center">
                                                <h2><?php echo $record1['category'] ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Hero Area End -->

                        <div class="job-post-company pt-120 pb-120">
                            <div class="container">
                                <div class="row justify-content-between">
                                    <!-- Left Content -->
                                    <div class="col-xl-7 col-lg-8">
                                        <!-- job single -->
                                        <div class="single-job-items mb-50">
                                            <div class="job-items">
                                                <div class="company-img company-img-details">
                                                    <img class="companyLogo" src="../assets/uploads/companies/company-logo/<?php echo $record2['company_logo'] ?>" alt="<?php echo $record2['company_logo']; ?>">
                                                </div>
                                                <div class=" job-tittle">
                                                    <a href="#">
                                                        <h4><?php echo $record1['job_role'] ?></h4>
                                                    </a>
                                                    <ul>
                                                        <li><?php echo $record2['company_name'] ?></li>
                                                        <li><i class="fas fa-map-marker-alt"></i><?php echo $record1['location'] ?></li>
                                                        <li>$<?php echo $record1['salary'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- job single End -->

                                        <div class="job-post-details">
                                            <div class="post-details1 mb-50">
                                                <!-- Small Section Tittle -->
                                                <div class="small-section-tittle">
                                                    <h4>Job Description</h4>
                                                </div>
                                                <p><?php echo $record1['description'] ?></p>
                                            </div>
                                            <div class="post-details2  mb-50">
                                                <!-- Small Section Tittle -->
                                                <div class="small-section-tittle">
                                                    <h4>Required Knowledge, Skills, and Abilities</h4>
                                                </div>
                                                <ul>
                                                    <?php echo $record1['requirement_skills'] ?>
                                                </ul>
                                            </div>
                                            <div class="post-details2  mb-50">
                                                <!-- Small Section Tittle -->
                                                <div class="small-section-tittle">
                                                    <h4>Education + Experience</h4>
                                                </div>
                                                <ul>
                                                    <?php echo $record1['education_and_experience'] ?>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Right Content -->
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="post-details3  mb-50">
                                            <!-- Small Section Tittle -->
                                            <div class="small-section-tittle">
                                                <h4>Job Overview</h4>
                                            </div>
                                            <ul>
                                                <li>Posted date : <span><?php echo $record1['posted_date'] ?></span></li>
                                                <li>Location : <span><?php echo $record1['location'] ?></span></li>
                                                <li>Vacancy : <span><?php echo $record1['vacancies'] ?></span></li>
                                                <li>Job nature : <span><?php echo $record1['job_nature'] ?></span></li>
                                                <li>Salary : <span>$<?php echo $record1['salary'] ?> <?php echo $record1['salary_type'] ?></span></li>
                                                <li>Application Deadline : <span><?php echo $record1['deadline'] ?></span></li>
                                            </ul>
                                            <?php if (isset($_SESSION['applicant_id'])) { ?>
                                                <div class="apply-btn2">
                                                     <a href="apply_now.php?job_id=<?= $_GET['j_id'] ?>&company_id=<?= $_GET['com_id'] ?>" class="btn">Apply Now</a>
                                                 </div>
                                            <?php } ?>
                                        </div>
                                        <div class="post-details4  mb-50">
                                            <!-- Small Section Tittle -->
                                            <div class="small-section-tittle">
                                                <h4>Company Information</h4>
                                            </div>
                                            <span><?php echo $record2['company_name'] ?></span>
                                            <p><?php echo $record2['company_description'] ?></p>
                                            <ul>
                                                <li>Name: <span><?php echo $record2['company_name'] ?></span></li>
                                                <li>Web : <span><?php echo $record2['company_website'] ?></span></li>
                                                <li>Email: <span><?php echo $record2['company_email'] ?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php

                    }
                } ?>

        <?php

            }
        }

        ?>
        <!-- job post company End -->

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