<?php
// Start a new session
session_start();

// Set header to return JSON content
header('Content-Type: application/json');

// Include database connection file (adjust the path as needed)
require_once './database_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['UIN'])) {
    $UIN = $_GET['UIN'];

    // SQL to fetch user information
    $sql1 = "SELECT * FROM Users WHERE UIN = '$UIN'";
    $sql2 = "SELECT * FROM College_Student WHERE UIN = '$UIN'";

    $response = [];

    // Execute first query
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        $response['Users'] = $result1->fetch_assoc();
    }

    // Execute second query
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        $response['College_Student'] = $result2->fetch_assoc();
    }

    if (!empty($response)) {
        echo json_encode(['success' => true] + $response);
    } else {
        echo json_encode(['success' => false]);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false]);
}
?>