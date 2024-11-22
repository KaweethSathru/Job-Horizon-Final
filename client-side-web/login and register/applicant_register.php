<?php
session_start();
require_once('../../connection/dbconnection.php');

if (isset($_POST["submit"]) && isset($_FILES['image'])) {
    $image_name = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];
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

        if (empty($applicant_username) || empty($applicant_first_name) || empty($applicant_last_name) || empty($applicant_email) || empty($applicant_password) || empty($applicant_passwordRepeat)) {
            array_push($errors, "All fields are required");
        }

        $query1 = "SELECT * FROM applicants WHERE applicant_username = '$applicant_username'";
        $result1 = mysqli_query($connection, $query1);

        if (mysqli_num_rows($result1) > 0) {
            array_push($errors, "Applicant username already exists!");
        }

        if (!filter_var($applicant_email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Invalid email address");
        }

        if (strlen($applicant_password) < 8) {
            array_push($errors, "Password must be at least 8 characters long");
        }

        if ($applicant_password !== $applicant_passwordRepeat) {
            array_push($errors, "Passwords do not match");
        }

        $query2 = "SELECT * FROM applicants WHERE applicant_email = '$applicant_email'";
        $result2 = mysqli_query($connection, $query2);

        if (mysqli_num_rows($result2) > 0) {
            array_push($errors, "Email already exists!");
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='error-box'>$error</div>";
            }
        } else {
            $query3 = "INSERT INTO applicants (applicant_username, applicant_first_name, applicant_last_name, applicant_email, applicant_password, applicant_profile_picture)
                       VALUES ('$applicant_username', '$applicant_first_name', '$applicant_last_name', '$applicant_email', '$applicantpasswordHash', '$new_img_name')";

            $result3 = mysqli_query($connection, $query3);

            if ($result3) {
                header("Location: ../login and register/applicant_login.php");
            }
        }
    } else {
        echo "<div class='error-box'>Invalid file format! Please upload JPG or JPEG images only.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOB HORIZON | Register as Applicant</title>
    <link rel="stylesheet" href="../css/register.css">
</head>

<body>
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text"></div>
            </div>
        </div>
    </div>

    <div>
        <img class="logoAlignment" src="../../assets/logo/logo.png" alt="Job Horizon Logo">
    </div>

    <div class="card-box">
        <h1 class="textAlignment">Register as an Applicant</h1>

        <form action="applicant_register.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <!-- Left Column -->
                <div class="form-column">
                    <label class="form-group">Username</label>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="applicant_username" placeholder="Enter Username">
                    </div>

                    <label class="form-group">First Name</label>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="applicant_first_name" placeholder="Enter First Name">
                    </div>

                    <label class="form-group">Last Name</label>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="applicant_last_name" placeholder="Enter Last Name">
                    </div>

                    <label class="form-group">Email</label>
                    <div class="form-group mb-3">
                        <input type="email" class="form-control" name="applicant_email" placeholder="Enter Email">
                    </div>
                </div>

                <!-- Right Column -->
                <div class="form-column">
                    <label class="form-group">Password</label>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" name="applicant_password" placeholder="Enter Password">
                    </div>

                    <label class="form-group">Repeat Password</label>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" name="repeat_applicant_password" placeholder="Re-enter Password">
                    </div>

                    <label class="form-group">Profile Picture (JPEG only)</label>
                    <div class="form-group mb-3">
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>
            </div>

            <div class="form-btn">
                <input type="submit" class="btn btn-primary loginBtn" value="Register" name="submit">
            </div>
        </form>

        <p>Already registered? <a href="applicant_login.php" class="loginText">Login Here</a></p>
    </div>
</body>

</html>
