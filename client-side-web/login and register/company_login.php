<?php
session_start();
require_once('../../connection/dbconnection.php');

if (isset($_POST["login"])) {
    $company_username = $_POST["company_username"];
    $company_password = $_POST["company_password"];

    $query = "SELECT * FROM companies WHERE company_username = '$company_username'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $company = mysqli_fetch_assoc($result);

            if ($company['company_recycle_bin'] == 1) {
                echo "<div class='error-box'>Your company has been banned by the admin. Please contact support.</div>";
            } else {
                if ($company['is_approved'] == 1) {
                    if (password_verify($company_password, $company['company_password'])) {
                        $_SESSION['company_id'] = $company['company_id'];
                        header("Location: ../home.php");
                    } else {
                        echo "<div class='error-box'>Incorrect password!</div>";
                    }
                } elseif ($company['is_approved'] == 0) {
                    echo "<div class='error-box'>Your company registration is pending approval.</div>";
                } else {
                    echo "<div class='error-box'>Your company registration was declined by the admin.</div>";
                }
            }
        } else {
            echo "<div class='error-box'>Company username not found!</div>";
        }
    } else {
        echo "<div class='error-box'>Login Failed!</div>";
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
    <link rel="stylesheet" href="../css/login.css">
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
        <h1 class="textAlignment">Login as a Company</h1>

        <form action="company_login.php" method="post">
            <label class="form-group">Username</label>
            <div class="form-group mb-3">
                <input type="text" placeholder="Enter Company Username" name="company_username" class="form-control">
            </div>
            <label class="form-group">Password</label>
            <div class="form-group mb-3">
                <input type="password" placeholder="Enter Password" name="company_password" class="form-control">
            </div>
            <div class="form-btn mb-3">
                <input type="submit" value="Login" name="login" class="btn btn-primary loginBtn">
            </div>
        </form>

        <p>Not registered yet? <a href="company_register.php" class="loginText">Register Here</a></p>
    </div>
</body>

</html>

<?php mysqli_close($connection); ?>
