<?php
session_start();
require_once('../../connection/dbconnection.php');

if (isset($_POST["submit"]) && isset($_FILES['image'])) {
    $image_name = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];

    $img_extension = pathinfo($image_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_extension);

    $allowed_extensions = array("PNG", "png");

    $errors = array();

    if (in_array($img_ex_lc, $allowed_extensions)) {
        $new_img_name = uniqid("COMPANY_IMG-", true) . "." . $img_ex_lc;
        $img_upload_path = '../../assets/uploads/companies/company-logo/' . $new_img_name;

        move_uploaded_file($tmp_name, $img_upload_path);

        $company_username = $_POST["company_username"];
        $company_name = $_POST["company_name"];
        $company_website = $_POST["company_website"];
        $company_email = $_POST["company_email"];
        $company_description = $_POST["company_description"];
        $company_password = $_POST["company_password"];
        $company_passwordRepeat = $_POST["repeat_company_password"];
        $companypasswordHash = password_hash($company_password, PASSWORD_DEFAULT);

        if (empty($company_username) || empty($company_name) || empty($company_website) || empty($company_email) || empty($company_password) || empty($company_passwordRepeat) || empty($company_description)) {
            array_push($errors, "All fields are required");
        }

        $query1 = "SELECT * FROM companies WHERE company_username = '$company_username'";
        $result1 = mysqli_query($connection, $query1);

        if (mysqli_num_rows($result1) > 0) {
            array_push($errors, "Company username already exists!");
        }

        if (!filter_var($company_email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }

        if (strlen($company_password) < 8) {
            array_push($errors, "Password must be at least 8 characters long");
        }

        if ($company_password !== $company_passwordRepeat) {
            array_push($errors, "Passwords do not match");
        }

        $query2 = "SELECT * FROM companies WHERE company_email = '$company_email'";
        $result2 = mysqli_query($connection, $query2);

        if (mysqli_num_rows($result2) > 0) {
            array_push($errors, "Email already exists!");
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='error-box'>$error</div>";
            }
        } else {
            $query3 = "INSERT INTO companies (company_username, company_name, company_website, company_email, company_description, company_password, company_logo)
                       VALUES ('{$company_username}', '{$company_name}', '{$company_website}', '{$company_email}', '{$company_description}', '{$companypasswordHash}', '{$new_img_name}')";

            $result3 = mysqli_query($connection, $query3);

            if ($result3) {
                header("Location: ../login and register/company_login.php");
            }
        }
    } else {
        echo "<div class='error-box'>File extension not allowed! Please upload PNG files only.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOB HORIZON | Register as Company</title>
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
        <h1 class="textAlignment">Register as a Company</h1>

        <form action="company_register.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <!-- Left Column -->
                <div class="form-column">
                    <label class="form-group">Username</label>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="company_username" placeholder="Enter Username">
                    </div>

                    <label class="form-group">Company Name</label>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name">
                    </div>

                    <label class="form-group">Website</label>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="company_website" placeholder="Enter Website URL">
                    </div>

                    <label class="form-group">Email</label>
                    <div class="form-group mb-3">
                        <input type="email" class="form-control" name="company_email" placeholder="Enter Email">
                    </div>
                </div>

                <!-- Right Column -->
                <div class="form-column">
                    <label class="form-group">Company Description</label>
                    <div class="form-group mb-3">
                        <textarea class="form-control" name="company_description" placeholder="Enter Description"></textarea>
                    </div>

                    <label class="form-group">Password</label>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" name="company_password" placeholder="Enter Password">
                    </div>

                    <label class="form-group">Repeat Password</label>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" name="repeat_company_password" placeholder="Re-enter Password">
                    </div>

                    <label class="form-group">Company Logo (PNG only)</label>
                    <div class="form-group mb-3">
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>
            </div>

            <div class="form-btn">
                <input type="submit" class="btn btn-primary loginBtn" value="Register" name="submit">
            </div>
        </form>

        <p>Already registered? <a href="company_login.php" class="loginText">Login Here</a></p>
    </div>
</body>

</html>
