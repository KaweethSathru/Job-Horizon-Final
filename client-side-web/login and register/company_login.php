<?php
session_start();
require_once('../../connection/dbconnection.php');

if (isset($_POST["login"])) {
    $company_username = $_POST["company_username"];
    $company_password = $_POST["company_password"];

    // Fetch the company details including whether it's approved or not, and if it's banned
    $query = "SELECT * FROM companies WHERE company_username = '$company_username'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $company = mysqli_fetch_assoc($result);

            // Check if the company is banned
            if ($company['company_recycle_bin'] == 1) {
                echo "Your company has been banned by the admin. Please contact support.";
            } else {
                // Check if the company is approved by the admin
                if ($company['is_approved'] == 1) {
                    if (password_verify($company_password, $company['company_password'])) {
                        $_SESSION['company_id'] = $company['company_id'];
                        header("Location: ../home.php");
                    } else {
                        echo "Incorrect password!";
                    }
                } elseif ($company['is_approved'] == 0) {
                    echo "Your company registration is pending approval.";
                } else {
                    echo "Your company registration was declined by the admin.";
                }
            }
        } else {
            echo "Company username not found!";
        }
    } else {
        echo "Login Failed!";
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOB HORIZON | Login as Company</title>

    <link rel="shortcut icon" type="image/x-icon" href="../../assets/favicon/favicon.ico">

    <link rel="stylesheet" href="../css/theme.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/price_rangs.css">
    <link rel="stylesheet" href="../css/slicknav.css">
    <link rel="stylesheet" href="../css/animate.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../css/themify-icons.css">
    <link rel="stylesheet" href="../css/slick.css">
    <link rel="stylesheet" href="../css/nice-select.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/theme.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login_and_register.css">
</head>

<body>

    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="../../assets/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div>
        <img class="logoAlignment" src="../../assets/logo/logo.png">
    </div>

    <h1 class="textAlignment">Login as a Company</h1>

    <div class="container">

        <form action="company_login.php" method="post">
            <label class="form-group">Username</label>
            <div class="form-group">
                <input type="text" placeholder="Enter company name" name="company_username" class="form-control">
            </div>
            <label class="form-group">Password</label>
            <div class="form-group">
                <input type="password" placeholder="Enter company password" name="company_password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary loginBtn">
            </div>
        </form>
        <br>
        <div>
            <p>Not registered yet? <a href="company_register.php" class="loginText">Register Here</a></p>
        </div>

    </div>

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="../js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="../components/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../components/js/popper.min.js"></script>
    <script src="../components/js/theme.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="../components/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="../components/js/owl.carousel.min.js"></script>
    <script src="../components/js/slick.min.js"></script>
    <script src="../components/js/price_rangs.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="../components/js/wow.min.js"></script>
    <script src="../components/js/animated.headline.js"></script>
    <script src="../components/js/jquery.magnific-popup.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="../components/js/jquery.scrollUp.min.js"></script>
    <script src="../components/js/jquery.nice-select.min.js"></script>
    <script src="../components/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="../components/js/contact.js"></script>
    <script src="../components/js/jquery.form.js"></script>
    <script src="../components/js/jquery.validate.min.js"></script>
    <script src="../components/js/mail-script.js"></script>
    <script src="../components/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="../components/js/plugins.js"></script>
    <script src="../components/js/main.js"></script>

</body>

</html>

<?php mysqli_close($connection); ?>