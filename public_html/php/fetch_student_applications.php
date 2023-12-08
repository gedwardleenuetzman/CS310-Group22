<?php
// Start a new session
session_start();

// Set header to return JSON content
header('Content-Type: application/json');

require_once './database_connection.php';

// SQL query to fetch all apps
$sql = "SELECT App_Num, Program_Num, UIN, Uncom_Cert, Com_Cert FROM Applications";

$result = $conn->query($sql);

$apps = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $apps[] = $row;
    }
    echo json_encode($users);
} else {
    echo json_encode([]);
}

$conn->close();
?>