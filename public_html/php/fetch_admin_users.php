<?php
// Start a new session
session_start();

// Set header to return JSON content
header('Content-Type: application/json');

require_once './database_connection.php';

// SQL query to fetch all users
$sql = "SELECT UIN, First_Name, M_Initial, Last_Name, Username, Email, Discord_Name, Can_Access FROM Users";

$result = $conn->query($sql);

$users = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users);
} else {
    echo json_encode([]);
}

$conn->close();
?>
