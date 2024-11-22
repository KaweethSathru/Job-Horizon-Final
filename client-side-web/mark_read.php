<?php
include '../connection/dbconnection.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['application_id']) && isset($_POST['is_applicant'])) {
        $application_id = intval($_POST['application_id']);
        $is_applicant = intval($_POST['is_applicant']); // 1 for applicant, 0 for company

        if ($is_applicant === 1) {
            // Mark applicant notification as read
            $sql = "UPDATE `applications` SET `read_status_a` = 1 WHERE `application_id` = ?";
        } else {
            // Mark company notification as read
            $sql = "UPDATE `applications` SET `read_status` = 1 WHERE `application_id` = ?";
        }

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $application_id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "error" => "Invalid application ID or user type"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
