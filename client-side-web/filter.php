<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php

if (isset($_POST['submit'])) {

    $cat = mysqli_real_escape_string($connection, $_POST['job_category']);
    $j_loc = mysqli_real_escape_string($connection, $_POST['job_location']);
    $sal = mysqli_real_escape_string($connection, $_POST['salary']);
    $sal2 = "";

    if ($sal == 1) {
        $sal = 1000;
        $sal2 = 2000;
    } elseif ($sal == 2) {
        $sal = 2000;
        $sal2 = 3000;
    } elseif ($sal == 3) {
        $sal = 3000;
        $sal2 = 4000;
    } elseif ($sal == 4) {
        $sal = 4000;
        $sal2 = 5000;
    } elseif ($sal == 5) {
        $sal = 5000;
    }

    if ($cat == "All Category" && $j_loc == "Anywhere" && $sal == "Any") {
        $query = "SELECT * FROM jobs
        AND jobs_recycle_bin = 0";
    } elseif ($cat != "All Category" && $j_loc == "Anywhere" && $sal == "Any") {
        $query = "SELECT * FROM jobs
            WHERE
            category = '{$cat}'
            AND jobs_recycle_bin = 0";
    } elseif ($cat == "All Category" && $j_loc != "Anywhere" && $sal == "Any") {
        $query = "SELECT * FROM jobs
            WHERE
            location = '{$j_loc}'
            AND jobs_recycle_bin = 0";
    } elseif ($cat == "All Category" && $j_loc == "Anywhere" && $sal != "Any") {
        $query = "SELECT * FROM jobs
            WHERE
            salary >= '{$sal}' AND salary < '{$sal2}'
            AND jobs_recycle_bin = 0";
    } elseif ($cat != "All Category" && $j_loc != "Anywhere" && $sal == "Any") {
        $query = "SELECT * FROM jobs
            WHERE
            category = '{$cat}'
            AND
            location = '{$j_loc}'
            AND jobs_recycle_bin = 0";
    } elseif ($cat == "All Category" && $j_loc != "Anywhere" && $sal != "Any") {
        $query = "SELECT * FROM jobs
            WHERE
            location = '{$j_loc}'
            AND
            salary >= '{$sal}' AND salary < '{$sal2}'";
    } elseif ($cat != "All Category" && $j_loc == "Anywhere" && $sal != "Any") {
        $query = "SELECT * FROM jobs
            WHERE
            category = '{$cat}'
            AND
            salary >= '{$sal}' AND salary < '{$sal2}'";
    } else {
        $query = "SELECT * FROM jobs
            WHERE
            category = '{$cat}'
            AND
            location = '{$j_loc}'
            AND
            salary >= '{$sal}' AND salary < '{$sal2}'";
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
    <title>JOB HORIZON | Filtered List</title>

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
                                <h2>Filter Results</h2>
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
                                    <h1>Ooops... No any matches!</h1>
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

    </main>

    <?php require_once('../client-side-web/components/footer.php'); ?>

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