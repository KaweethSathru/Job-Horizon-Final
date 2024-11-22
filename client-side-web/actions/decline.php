<?php session_start(); ?>
<?php require_once('../../connection/dbconnection.php'); 

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "UPDATE `applications` SET `is_approved`='2' WHERE application_id = '$id'";
    $res = mysqli_query($connection,$sql);
    if($res){
        header('location:../company_applicants.php');
    }else{
        echo "Error";
    }
}
