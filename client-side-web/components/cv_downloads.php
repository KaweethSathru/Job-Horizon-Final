<?php session_start(); ?>
<?php require_once('../../connection/dbconnection.php'); ?>

<?php

if (!isset($_SESSION['company_id'])) {
    header("Location: ../login and register/company_login.php");
} else {
    $company_id = $_SESSION['company_id'];
}

?>

<?php

if (!empty($_GET['cv_file'])) {
    $fileName = basename($_GET['cv_file']);
    $filePath = "../../assets/uploads/applications/CVs/" . $fileName;

    if (!empty($fileName) && file_exists($filePath)) {
        header("Cache-control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
    }

    readfile($filePath);
    exit;
    
} else {
    echo "file not found!";
}
