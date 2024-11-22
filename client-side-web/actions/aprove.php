<?php session_start(); ?>
<?php require_once('../../connection/dbconnection.php'); 

if(isset($_POST['details-submit'])){
    $desc = $_POST["description"];
    $link = $_POST['interview_link'];
    $id = $_POST['application_id'];
    $sql = "UPDATE `applications` SET `is_approved`='1', `approved_description`= '$desc', `approved_link`='$link' WHERE application_id = '$id'";
    $res = mysqli_query($connection,$sql);
    if($res){
        header('location:../company_applicants.php');
    }else{
        echo "Error";
    }
}