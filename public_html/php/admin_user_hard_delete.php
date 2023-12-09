<?php
// admin_user_soft_delete.php

session_start();
require_once './database_connection.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['UIN'])) {
    $uin = $_POST['UIN'];

    // Prepare SQL query to update the Can_Access field
    $sql = "DELETE from Users WHERE UIN = ?";
    
    if($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $uin);
        $stmt->execute();

        if($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'User hard deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No changes were made.']);
        }

        $stmt->close();
    } else {
        // Handle errors with preparing the SQL statement
        echo json_encode(['status' => 'error', 'message' => 'Error updating user data.']);
    }
} else {
    // If not a POST request or UIN not set
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method or missing UIN.']);
}

$conn->close();
?>
