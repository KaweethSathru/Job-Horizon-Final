<?php session_start(); ?>
<?php require_once('../../connection/dbconnection.php'); ?>

<?php

if (!isset($_SESSION['applicant_id'])) {
    header("Location: ../client-side-web/login and register/applicant_login.php");
} else {
    $applicant_id = $_SESSION['applicant_id'];
}

?>

<?php

if (isset($_POST['submit']) && isset($_GET['job_id']) && isset($_GET['company_id']) && isset($_FILES['cv']) && isset($_FILES['cover_letter'])) {

    $j_id = $_GET['job_id'];
    $com_id = $_GET['company_id'];
    $full_name = mysqli_real_escape_string($connection, $_POST['full_name']);
    $mobile_no = mysqli_real_escape_string($connection, $_POST['mobile_no']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);

    $cv_name = $_FILES['cv']['name'];
    $cv_size = $_FILES['cv']['size'];
    $cv_tmp_name = $_FILES['cv']['tmp_name'];
    $cv_errors = $_FILES['cv']['error'];

    $cover_letter_name = $_FILES['cover_letter']['name'];
    $cover_letter_size = $_FILES['cover_letter']['size'];
    $cover_letter_tmp_name = $_FILES['cover_letter']['tmp_name'];
    $cover_letter_errors = $_FILES['cover_letter']['error'];

    if ($cv_errors === 0 && $cover_letter_errors === 0) {

        $cv_extension = pathinfo($cv_name, PATHINFO_EXTENSION);
        $cv_ex_lc = strtolower($cv_extension);

        $cover_letter_extension = pathinfo($cover_letter_name, PATHINFO_EXTENSION);
        $cover_letter_ex_lc = strtolower($cover_letter_extension);

        $allowed_cv_extensions = array("pdf", "docx");
        $allowed_cover_letter_extensions = array("pdf", "docx");

        if (in_array($cv_ex_lc, $allowed_cv_extensions) && in_array($cover_letter_ex_lc, $allowed_cover_letter_extensions)) {

            $new_cv_name = uniqid("CV-", true) . "." . $cv_ex_lc;
            $cv_upload_path = '../../assets/uploads/applications/CVs/' . $new_cv_name;
            move_uploaded_file($cv_tmp_name, $cv_upload_path);

            $new_cover_letter_name = uniqid("COVER_LETTER-", true) . "." . $cover_letter_ex_lc;
            $cover_letter_upload_path = '../../assets/uploads/applications/cover-letters/' . $new_cover_letter_name;
            move_uploaded_file($cover_letter_tmp_name, $cover_letter_upload_path);

            $query = "INSERT INTO applications(applicant_id, job_id, company_id, applicant_full_name, applicant_mobile_number, applicant_contact_email, applicant_cv, applicant_cover_letter)
                      VALUES ('{$applicant_id}', '{$j_id}', '{$com_id}', '{$full_name}', '{$mobile_no}', '{$email}', '{$new_cv_name}', '{$new_cover_letter_name}')";

            $result = mysqli_query($connection, $query);

            if ($result) { ?>

                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="manifest" href="site.webmanifest">
                    <title>JOB HORIZON | Successful</title>

                    <link rel="shortcut icon" type="image/x-icon" href="../../assets/favicon/favicon.ico">

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
                    <link rel="stylesheet" href="../css/successful_message.css">

                </head>

                <body>
                    <div class="container">
                        <div class="popup" id="popup">
                            <img src="../../assets/images/tick.png">
                            <h2>Submission Successful!</h2>
                            <p>you will be contact by the company soon.</p>
                            <a href="../home.php"><button type="button">ok</button></a>
                        </div>
                    </div>
                    <script>
                        let popup = document.getElementById("popup");

                        function openPopup() {
                            popup.classList.add("open-popup")
                        }

                        function closePopup() {
                            popup.classList.remove("open-popup")
                        }
                    </script>

                    <!-- JS here -->

                    <!-- All JS Custom Plugins Link Here here -->
                    <script src="../client-side-web/components/js/vendor/modernizr-3.5.0.min.js"></script>
                    <!-- Jquery, Popper, Bootstrap -->
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

<?php } else {
                header('Location: error.php');
            }
        }
    } else {
        header('Location: error.php');
    }
}else{
    header('Location: ../apply_now.php');
}

?>

<?php mysqli_close($connection); ?>