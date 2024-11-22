<?php
    include 'configAdmin.php';
    $id = $_GET['id'];
    $result = mysqli_query($conn,"UPDATE companies SET company_recycle_bin = 1 WHERE company_id='".$id."'");
    header('location:companies.php');
?>