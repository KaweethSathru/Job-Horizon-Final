<?php session_start(); ?>
<?php require_once('../../connection/dbconnection.php'); ?>

<?php
// Ensure the user is logged in as a company
if (!isset($_SESSION['company_id'])) {
    header("Location: ../login and register/company_login.php");
    exit();
} else {
    $company_id = $_SESSION['company_id'];
}

// Check if a job_id is provided
if (isset($_GET['job_id']) && is_numeric($_GET['job_id'])) {
    $job_id = mysqli_real_escape_string($connection, $_GET['job_id']);

    // Update the specific job post to mark it as removed
    $query = "UPDATE jobs
              SET jobs_recycle_bin = 1
              WHERE job_id = '{$job_id}' AND company_id = '{$company_id}'";

    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) > 0) {
        // Redirect with a success message
        header('Location: ../company_job_posts.php?message=post_removed');
    } else {
        // Redirect with an error message if no rows were updated
        header('Location: ../company_job_posts.php?error=failed_to_remove_post');
    }
} else {
    // Redirect if no valid job_id is provided
    header('Location: ../company_job_posts.php?error=invalid_job_id');
}

mysqli_close($connection);
?>
