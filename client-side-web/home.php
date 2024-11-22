<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php
$query = "SELECT * FROM jobs
WHERE jobs_recycle_bin = 0
ORDER BY posted_date DESC
LIMIT 5";


$companyCountQuery = "SELECT * FROM companies";
$companyCountResult = mysqli_query($connection, $companyCountQuery);
$companyCount = mysqli_num_rows($companyCountResult);

$applicationsCountQuery = "SELECT * FROM applications";
$applicationsCountResult = mysqli_query($connection, $applicationsCountQuery);
$applicationsCount = mysqli_num_rows($applicationsCountResult);

$salesAndMarketingCountQuery = "SELECT * FROM jobs
                                WHERE
                                category = 'Sales and Marketing'
                                AND jobs_recycle_bin = 0";
$salesAndMarketingCountResult = mysqli_query($connection, $salesAndMarketingCountQuery);
$salesAndMarketingCount = mysqli_num_rows($salesAndMarketingCountResult);

$biCountQuery = "SELECT * FROM jobs
                                WHERE
                                category = 'Banking and Insurance'
                                AND jobs_recycle_bin = 0";
$biCountResult = mysqli_query($connection, $biCountQuery);
$biCount = mysqli_num_rows($biCountResult);

$uiuxCountQuery = "SELECT * FROM jobs
                                WHERE
                                category = 'UI/UX Design'
                                AND jobs_recycle_bin = 0";
$uiuxCountResult = mysqli_query($connection, $uiuxCountQuery);
$uiuxCount = mysqli_num_rows($uiuxCountResult);

$telCountQuery = "SELECT * FROM jobs
                                WHERE
                                category = 'Telecommunication'
                                AND jobs_recycle_bin = 0";
$telCountResult = mysqli_query($connection, $telCountQuery);
$telCount = mysqli_num_rows($telCountResult);

$conCountQuery = "SELECT * FROM jobs
                                WHERE
                                category = 'Construction'
                                AND jobs_recycle_bin = 0";
$conCountResult = mysqli_query($connection, $conCountQuery);
$conCount = mysqli_num_rows($conCountResult);

$itCountQuery = "SELECT * FROM jobs
                                WHERE
                                category = 'Information Technology'
                                AND jobs_recycle_bin = 0";
$itCountResult = mysqli_query($connection, $itCountQuery);
$itCount = mysqli_num_rows($itCountResult);

$archCountQuery = "SELECT * FROM jobs
                                WHERE
                                category = 'Architecture'
                                AND jobs_recycle_bin = 0";
$archCountResult = mysqli_query($connection, $archCountQuery);
$archCount = mysqli_num_rows($archCountResult);

$accCountQuery = "SELECT * FROM jobs
                                WHERE
                                category = 'Accounting and Auditing'
                                AND jobs_recycle_bin = 0";
$accCountResult = mysqli_query($connection, $accCountQuery);
$accCount = mysqli_num_rows($accCountResult);

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>JOB HORIZON | Home</title>
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
    <link rel="stylesheet" href="../client-side-web/css/form.css">
</head>

<body>

    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="../client-side-web/assets/images/logo/logo.png" alt="" >
                </div>
            </div>
        </div>
    </div>

    <?php require_once('../client-side-web/components/header.php'); ?>

    <main>

        <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="slider-active">
            <?php if (isset($_SESSION['applicant_id'])) { ?>
                <div class="single-slider slider-height d-flex align-items-center mb-200" data-background="../client-side-web/assets/images/hero/h1_hero.jpg">
            <?php } elseif (isset($_SESSION['company_id'])) { ?>
                <div class="single-slider slider-height d-flex align-items-center mb-200" data-background="../client-side-web/assets/images/hero/h2_hero.jpg">
            <?php } else { ?>
                <div class="single-slider slider-height d-flex align-items-center mb-200" data-background="../client-side-web/assets/images/hero/h1_hero.jpg">
            <?php } ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-9 col-md-10">
                                <div class="hero__caption">
                                <h1 style="margin-left: 25px;">Find the most exciting startup jobs</h1>
                                </div>
                            </div>
                        </div>
                        <!-- Search Box -->
                        <div class="row">
                            <div class="col-xl-8">
                                <!-- form -->
                                <form style="margin-left: 25px;" action="../client-side-web/search.php" class="search-box" method="POST">
                                    <div class="input-form">
                                        <input type="text" name="keyword" placeholder="Job Role or Keyword" required>
                                    </div>

                                    <div class="select-form">
                                        <div class="select-itms"  >
                                            <select name="job_location" id="select1">
                                                <option value="Anywhere" >Anywhere</option>
                                                <option value="Western Province">Western Province</option>
                                                <option value="Central Province">Central Province</option>
                                                <option value="Southern Province">Southern Province</option>
                                                <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                                            </select>
                                        </div>
                                    </div>

                                    <input class="search-form" type="submit" name='submit' value="Find job">

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Services Start -->
        <div class="our-services section-pad-t30">
            <div class="container " style="margin-top: -300px; border-radius: 10px; background-color: #F8F8F8;">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12" id="category">
                        <div class="section-tittle text-center" style="margin-top: 30px;" >
                            <span>Jobs From Over <?php echo $companyCount ?> Local and International Companies</span>
                            <h2 style="margin-bottom: 25px;">Browse Top Categories </h2>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-contnet-center" style=" background: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px; margin: 20px; border: 2px solid green; padding: 15px;">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <a href="category.php?job_cat=Banking and Insurance">
                            <div class="single-services text-center mb-30" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="services-ion">
                                    <span class="flaticon-tour"></span>
                                </div>
                                <div class="services-cap">
                                    <h5>Banking and Insurance</h5>
                                    <span>(<?php echo $biCount ?>)</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6"><a href="category.php?job_cat=UI/UX Design">
                            <div class="single-services text-center mb-30" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="services-ion">
                                    <span class="flaticon-cms"></span>
                                </div>
                                <div class="services-cap">
                                    <h5>UI/UX Design</h5>
                                    <span>(<?php echo $uiuxCount ?>)</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6"><a href="category.php?job_cat=Sales and Marketing">
                            <div class="single-services text-center mb-30" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="services-ion">
                                    <span class="flaticon-report"></span>
                                </div>
                                <div class="services-cap">
                                    <h5>Sales and Marketing</h5>
                                    <span>(<?php echo $salesAndMarketingCount ?>)</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6"><a href="category.php?job_cat=Telecommunication">
                            <div class="single-services text-center mb-30" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="services-ion">
                                    <span class="flaticon-app"></span>
                                </div>
                                <div class="services-cap">
                                    <h5>Telecommunication</h5>
                                    <span>(<?php echo $telCount ?>)</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6"><a href="category.php?job_cat=Construction">
                            <div class="single-services text-center mb-30" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="services-ion">
                                    <span class="flaticon-helmet"></span>
                                </div>
                                <div class="services-cap">
                                    <h5>Construction</h5>
                                    <span>(<?php echo $conCount ?>)</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6"><a href="category.php?job_cat=Information Technology">
                            <div class="single-services text-center mb-30" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="services-ion">
                                    <span class="flaticon-high-tech"></span>
                                </div>
                                <div class="services-cap">
                                    <h5>Information Technology</h5>
                                    <span>(<?php echo $itCount ?>)</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6"><a href="category.php?job_cat=Architecture">
                            <div class="single-services text-center mb-30" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="services-ion">
                                    <span class="flaticon-real-estate"></span>
                                </div>
                                <div class="services-cap">
                                    <h5>Architecture</h5>
                                    <span>(<?php echo $archCount ?>)</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6"><a href="category.php?job_cat=Accounting and Auditing">
                            <div class="single-services text-center mb-30" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="services-ion">
                                    <span class="flaticon-content"></span>
                                </div>
                                <div class="services-cap">
                                    <h5>Accounting and Auditing</h5>
                                    <span>(<?php echo $accCount ?>)</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- More Btn -->
                <!-- Section Button -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="browse-btn2 text-center mt-50">
                            <a style="margin-bottom: 30px;" href="find_jobs.php" class="border-btn2">Browse All Sectors</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Services End -->

        <!-- Online CV Area Start -->
        <?php if (isset($_SESSION['applicant_id'])) { ?>
        <div class="online-cv cv-bg section-overly pt-90 pb-120" data-background="../client-side-web/assets/images/gallery/cv_bg.jpg" id="find">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="cv-caption text-center">
                            <p class="pera1">Upload Your CV & Cover Letter</p>
                            <p class="pera2"> Make a Difference with Your Online Resume!</p>
                            <a href="find_jobs.php" class="border-btn2 border-btn4">Find a Job & Upload your CV & Cover Letter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if (isset($_SESSION['company_id'])) { ?>
        <div class="online-cv cv-bg section-overly pt-90 pb-120" data-background="../client-side-web/assets/images/gallery/cv_ag.jpg" id="post">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="cv-caption text-center">
                            <p class="pera1">Upload Your Job Post</p>
                            <p class="pera2"> Make a Difference by Posting Your Job Online!</p>
                            <a href="post_job.php" class="border-btn2 border-btn4">Post a Job & Attract Top Talent with Ease</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- Online CV Area End-->

        <!-- Featured_job_start -->
        <section class="featured-job-area feature-padding" id="recent">
            <div class="container" style=" border-radius: 10px; background-color: #F8F8F8;">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center" style="margin-top: 30px;">
                            <span>Find Recent Posted Jobs</span>
                            <h2 style="margin-bottom: 30px;">Recent Jobs</h2>
                        </div>
                    </div>
                </div>

                <di class="row justify-content-center" style="background: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px; margin: 20px; border: 2px solid green; padding: 15px;">
                    <div class="col-xl-10">

                        <!-- single-job-content -->
                        <?php

                        $query = "SELECT * FROM jobs 
                                  INNER JOIN companies ON jobs.company_id = companies.company_id 
                                  WHERE jobs.jobs_recycle_bin = 0 
                                  AND companies.company_recycle_bin = 0 
                                  ORDER BY jobs.posted_date DESC 
                                  LIMIT 5";

                        $result1 = mysqli_query($connection, $query);

                        if ($result1) { ?>

                            <?php

                            if (mysqli_num_rows($result1) > 0) { ?>

                                <?php while ($record1 = mysqli_fetch_array($result1)) {

                                    $_GET['j_id'] = $record1['job_id'];
                                    $com_id = $record1['company_id'];
                                    $_GET['com_id'] = $record1['company_id'];

                                    $query2 = "SELECT * FROM companies WHERE company_id = '{$com_id}' LIMIT 1";
                                    $result2 = mysqli_query($connection, $query2);

                                    if ($result2) {

                                        while ($record2 = mysqli_fetch_array($result2)) {

                                ?>
                                            <div class="single-job-items mb-30" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                                                <div class="job-items">
                                                    <div class="company-img">
                                                        <a href="job_details.php?job_id=<?= $_GET['j_id'] ?>&company_id=<?= $_GET['com_id'] ?>">
                                                            <img class="companyLogo" src="../assets/uploads/companies/company-logo/<?php echo $record2['company_logo'] ?>" alt="<?php echo $record2['company_logo']; ?>">
                                                        </a>
                                                    </div>
                                                    <div class="job-tittle">
                                                        <a href="job_details.php?job_id=<?= $_GET['j_id'] ?>&company_id=<?= $_GET['com_id'] ?>">
                                                            <h4><?php echo strtoupper($record1['job_role']) ?></h4>
                                                        </a>
                                                        <ul>
                                                            <li><?php echo $record2['company_name'] ?></li>
                                                            <li><i class="fas fa-map-marker-alt"></i><?php echo $record1['location'] ?></li>
                                                            <li>$<?php echo $record1['salary'] ?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="items-link f-right">
                                                    <a href="job_details.php?job_id=<?= $_GET['j_id'] ?>&company_id=<?= $_GET['com_id'] ?>"><?php echo $record1['job_nature'] ?></a>
                                                    <span><?php echo $record1['posted_date'] ?></span>
                                                </div>
                                            </div>

                                        <?php
                                        }

                                        ?>

                                <?php

                                    }
                                } ?>

                        <?php }
                        } else {
                            echo "DB failed!";
                        }

                        ?>

                    </div>
                </div>
            </div>
        </section>
        <!-- Featured_job_end -->

        <!-- How  Apply Process Start-->
        <div class="apply-process-area apply-bg pt-150 pb-150" data-background="../client-side-web/assets/images/gallery/how-applybg.png" id="about">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle white-text text-center">
                            <span>Apply process</span>
                            <h2> How it works</h2>
                        </div>
                    </div>
                </div>
                <!-- Apply Process Caption -->
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-search"></span>
                            </div>
                            <div class="process-cap">
                                <h5>1. Search a job</h5>
                                <p>
                                    Search your favorite job from using search bar or
                                    find job page. You can also filter jobs according to your requirement.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-curriculum-vitae"></span>
                            </div>
                            <div class="process-cap">
                                <h5>2. Upload your CV, Cover Letter & Apply for Job</h5>
                                <p>
                                    After finding your wishing job go and apply for the job.
                                    Make sure to give correct information and upload your CV and cover letter.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-tour"></span>
                            </div>
                            <div class="process-cap">
                                <h5>3. Get your job</h5>
                                <p>
                                    You will be informed or contact soon by from your applied
                                    company. Good luck!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- How  Apply Process End-->

        
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