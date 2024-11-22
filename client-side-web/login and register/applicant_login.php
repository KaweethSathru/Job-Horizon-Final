<?php session_start(); ?>
<?php require_once('../../connection/dbconnection.php'); ?>

<?php
if (isset($_POST["login"])) {
    $applicant_username = $_POST["applicant_username"];
    $applicant_password = $_POST["applicant_password"];

    $query = "SELECT * FROM applicants WHERE applicant_username = '$applicant_username'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $applicant = mysqli_fetch_assoc($result);

            if ($applicant['applicant_recycle_bin'] == 1) {
                echo "<div class='error-box'>Your account has been banned by the admin. Please contact support.</div>";
            } else {
                if (password_verify($applicant_password, $applicant['applicant_password'])) {
                        $_SESSION['applicant_id'] = $applicant['applicant_id'];
                        header("Location: ../home.php");
                    } else {
                        echo "<div class='error-box'>Incorrect password!</div>";
                    }
            }
        } else {
            echo "<div class='error-box'>Applicant username not found!</div>";
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
    <title>JOB HORIZON | Login as Applicant</title>

    <link rel="shortcut icon" type="image/x-icon" href="../../assets/favicon/favicon.ico">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    
                </div>
            </div>
        </div>
    </div>

    <div>
        <img class="logoAlignment" src="../../assets/logo/logo.png" alt="Job Horizon Logo">
    </div>

    <div class="card-box">
        <h1 class="textAlignment">Login as an Applicant</h1>

        <form action="applicant_login.php" method="post">
            <label class="form-group">Username</label>
            <div class="form-group mb-3">
                <input type="text" placeholder="Enter Username" name="applicant_username" class="form-control">
            </div>
            <label class="form-group">Password</label>
            <div class="form-group mb-3">
                <input type="password" placeholder="Enter password" name="applicant_password" class="form-control">
            </div>
            <div class="form-btn mb-3">
                <input type="submit" value="Login" name="login" class="btn btn-primary loginBtn">
            </div>
        </form>

        <p>Not registered yet?<a href="applicant_register.php" class="loginText"> Register Here</a></p>
    </div>
</body>

</html>