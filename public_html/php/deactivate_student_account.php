<?php
// Start a new session
session_start();

// Set header to return JSON content
header('Content-Type: application/json');

// Include database connection file (adjust the path as needed)
require_once './database_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $_DELETE = json_decode(file_get_contents('php://input'), true);
    $UIN = isset($_DELETE['UIN']) ? $conn->real_escape_string($_DELETE['UIN']) : null;

    if (!$UIN) {
        echo json_encode(['success' => false, 'message' => 'UIN is required']);
        exit;
    }

    // SQL to delete user information
    $conn->autocommit(FALSE); // Start transaction
    $success = true;

    $sql1 = "DELETE FROM Users WHERE UIN = '$UIN'";
    if (!$conn->query($sql1)) {
        $success = false;
        error_log("Error deleting from Users: " . $conn->error);
    }

    $sql2 = "DELETE FROM College_Student WHERE UIN = '$UIN'";
    if (!$conn->query($sql2)) {
        $success = false;
        error_log("Error deleting from College_Student: " . $conn->error);
    }

    if ($success) {
        $conn->commit();
        echo json_encode(['success' => true]);
    } else {
        $conn->rollback();
        echo json_encode(['success' => false]);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false]);
}
?>