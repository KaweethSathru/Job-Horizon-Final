<?php
    include 'configAdmin.php';
    $id = $_GET['id'];
    $result = mysqli_query($conn,"UPDATE applicants SET applicant_recycle_bin = 1 WHERE applicant_id='".$id."'");
    header('location:applicants.php');
?>