<?php session_start(); ?>
<?php require_once('../../connection/dbconnection.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOB HORIZON | Register as Applicant</title>

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

    <h1 class="textAlignment">Register as an Applicant</h1>

    <div class="container">

        <?php
        if (isset($_POST["submit"]) && isset($_FILES['image'])) {

            $image_name = $_FILES['image']['name'];
            $image_size = $_FILES['image']['size'];
            $tmp_name = $_FILES['image']['tmp_name'];
            // $errors = $_FILES['image']['error'];
            $img_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_extension);

            $allowed_extensions = array("jpg", "jpeg");

            $errors = array();

            if (in_array($img_ex_lc, $allowed_extensions)) {

                $new_img_name = uniqid("APPLICANT_IMG-", true) . "." . $img_ex_lc;
                $img_upload_path = '../../assets/uploads/applicants/profile-pictures/' . $new_img_name;

                move_uploaded_file($tmp_name, $img_upload_path);

                $applicant_username = $_POST["applicant_username"];
                $applicant_first_name = $_POST["applicant_first_name"];
                $applicant_last_name = $_POST["applicant_last_name"];
                $applicant_email = $_POST["applicant_email"];
                $applicant_password = $_POST["applicant_password"];
                $applicant_passwordRepeat = $_POST["repeat_applicant_password"];
                $applicantpasswordHash = password_hash($applicant_password, PASSWORD_DEFAULT);

                if (empty($applicant_username) or empty($applicant_first_name) or  empty($applicant_last_name) or empty($applicant_email) or empty($applicant_password) or empty($applicant_passwordRepeat)) {
                    array_push($errors, "All fields are required");
                }

                $query1 = "SELECT * FROM applicants
                           WHERE
                           applicant_username = '$applicant_username' ";

                $result1 = mysqli_query($connection, $query1);

                $rowCount1 = mysqli_num_rows($result1);
                if ($rowCount1 > 0) {
                    array_push($errors, "applicant username already exists!");
                }

                if (!filter_var($applicant_email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "applicant_email is not valid");
                }
                if (strlen($applicant_password) < 8) {
                    array_push($errors, "applicant_passwordmust be at least 8 charactes long");
                }
                if ($applicant_password !== $applicant_passwordRepeat) {
                    array_push($errors, "applicant_passworddoes not match");
                }

                $query2 = "SELECT * FROM applicants
                           WHERE
                           applicant_email = '$applicant_email' ";

                $result2 = mysqli_query($connection, $query2);

                $rowCount2 = mysqli_num_rows($result2);
                if ($rowCount2 > 0) {
                    array_push($errors, "applicant_email already exists!");
                }
                if (count($errors) > 0) {
                    foreach ($errors as  $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {

                    $query3 = "INSERT INTO applicants(applicant_username, applicant_first_name, applicant_last_name, applicant_email, applicant_password, applicant_profile_picture)
                               VALUES ('{$applicant_username}', '{$applicant_first_name}', '{$applicant_last_name}', '{$applicant_email}', '{$applicantpasswordHash}', '{$new_img_name}')";

                    $result3 = mysqli_query($connection, $query3);

                    if ($result3) {
                        header("Location: ../login and register/applicant_login.php");
                    }

                }
            } else {
                echo "File extension can not be allowed! Please upload jpg files only.";
            }
        }
        ?>

        <form action="applicant_register.php" method="post" enctype="multipart/form-data">
            <label class="form-group">Username</label>
            <div class="form-group">
                <input type="text" class="form-control" name="applicant_username" placeholder="Enter Username">
            </div>
            <label class="form-group">First Name</label>
            <div class="form-group">
                <input type="text" class="form-control" name="applicant_first_name" placeholder="Enter First Name">
            </div>
            <label class="form-group">Last Name</label>
            <div class="form-group">
                <input type="text" class="form-control" name="applicant_last_name" placeholder="Enter Last Name">
            </div>
            <label class="form-group">Email</label>
            <div class="form-group">
                <input type="email" class="form-control" name="applicant_email" placeholder="Enter Email">
            </div>
            <label class="form-group">Password (Give a password more than 8 characters)</label>
            <div class="form-group">
                <input type="password" class="form-control" name="applicant_password" placeholder="Enter Password">
            </div>
            <label class="form-group">Repeat your password</label>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_applicant_password" placeholder="Re-enter your Password">
            </div>
            <label class="form-group">Profile Picture (Accepts JPEG images only)</label>
            <div class="form-group">
                <input type="file" class="form-control" name="image">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary loginBtn" value="Register" name="submit">
            </div>
        </form>

        <div>
            <br>
            <div>
                <p>Already Registered? <a href="applicant_login.php" class="loginText">Login Here</a></p>
            </div>
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