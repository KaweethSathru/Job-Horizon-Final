<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php

if (isset($_POST['submit'])) {

    $key = mysqli_real_escape_string($connection, $_POST['keyword']);
    $j_loc = mysqli_real_escape_string($connection, $_POST['job_location']);

    if (isset($key) && $j_loc == "Anywhere") {
        $query = "SELECT * FROM jobs
                  WHERE
                  job_role LIKE '%{$key}%'
                  AND jobs_recycle_bin = 0";
    } else {
        $query = "SELECT * FROM jobs
            WHERE
            job_role LIKE '%{$key}%'
            AND location = '{$j_loc}'
            AND jobs_recycle_bin = 0";
    }
} else {

    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOB HORIZON | Search Result</title>

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

</head>

<body>
    <?php require_once('../client-side-web/components/header.php'); ?>
    <main>

        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="../client-side-web/assets/images/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Search Result</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->


        <section class="featured-job-area filterContainer">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">

                        <?php
                        $result1 = mysqli_query($connection, $query);
                        ?>
                        <?php

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
                                            <div class="single-job-items mb-30">
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

                            <?php } else {
                            ?>
                                <div class="filter-warning">
                                    <h1>Ooops... No Any Matches Found!</h1>
                                </div>
                        <?php
                            }
                        } else {
                            echo "DB failed!";
                        }

                        ?>

                    </div>
                </div>
            </div>
        </section>

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

</body>

</html>

<?php mysqli_close($connection); ?>