<?php

include 'configAdmin.php';
session_start();
// $error[] = 'Incorrect email or password!';
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, ($_POST['password']));

    $select_users = mysqli_query($conn, "SELECT * FROM `admins` WHERE admin_email = '$email' AND admin_password = '$pass' ") or die('query failed');

    echo $email;
    if (mysqli_num_rows($select_users) > 0) {
      $error[] = '';
        $row = mysqli_fetch_assoc($select_users);
            $_SESSION['admin_username'] = $row['admin_username'];
            $_SESSION['admin_email'] = $row['admin_email'];
            $_SESSION['admin_id'] = $row['admin_id'];
            header('location:applicants.php');
    } else {
        $error[] = 'Incorrect email or password!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.ico">
    <title>JOB HORIZON Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="./css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="./css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="./css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(images/background/login-register.jpg);">
        <div class="login-box card">

        <?php
        if (isset($error)) {
            foreach ($error as $message) {
                echo '<div class="container">
                  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <span>' . $message . '</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
              </div>';
            }
        }
    ?>
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <a href="javascript:void(0)" class="text-center db"><br/><img src="images/logo-text.png" alt="Home" /></a>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="email" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="submit">Log In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="./css/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="./css/plugins/bootstrap/js/popper.min.js"></script>
    <script src="./css/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="./css/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="./css/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
</body>

</html>