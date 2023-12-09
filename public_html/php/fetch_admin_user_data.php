<?php
// fetch_admin_user_data.php

session_start();
header('Content-Type: application/json');
require_once './database_connection.php';

if(isset($_GET['UIN'])) {
    $uin = $_GET['UIN'];

    $sql = "SELECT UIN, First_Name, M_Initial, Last_Name, Username, Email, Discord_Name, Can_Access FROM Users WHERE UIN = ?";
    if($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $uin);
        $stmt->execute();
        $result = $stmt->get_result();

        if($row = $result->fetch_assoc()) {
            echo json_encode($row);
        } else {
            echo json_encode(["error" => "No user found with the specified UIN."]);
        }

        $stmt->close();
    }
} else {
    echo json_encode(["error" => "UIN not specified."]);
}

$conn->close();
?>
