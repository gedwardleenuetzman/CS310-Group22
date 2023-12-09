<?php
// Start a new session
session_start();

// Set header to return JSON content
header('Content-Type: application/json');

require_once './database_connection.php';

function formatDate($date) {
    $date = date_create($date);
    return date_format($date, "Y-m-d");
}

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize user input
    $uin = sanitizeInput($_POST['registerUIN']);
    $firstName = sanitizeInput($_POST['registerFirstName']);
    $middleInitial = sanitizeInput($_POST['registerMiddleInitial']);
    $lastName = sanitizeInput($_POST['registerLastName']);
    $username = sanitizeInput($_POST['registerUsername']);
    $password = sanitizeInput($_POST['registerPassword']);
    $email = sanitizeInput($_POST['registerEmail']);
    $discordUsername = sanitizeInput($_POST['registerDiscordUsername']);
    $userType = "Admin";
    $canAccess = 1

    $existingUIN = isset($_POST['existingUIN']) ? sanitizeInput($_POST['existingUIN']) : null;

    // Start transaction
    $conn->begin_transaction();

    try {
        // If existing UIN is provided, delete existing records
        if ($existingUIN) {
            $deleteStmt1 = $conn->prepare("DELETE FROM Users WHERE UIN = ?");
            $deleteStmt1->bind_param("i", $existingUIN); // Changed the data type to integer
            $deleteStmt1->execute();
            $deleteStmt1->close();
        }
        
        // First Insert Statement
        $stmt1 = $conn->prepare("INSERT INTO Users (UIN, First_Name, M_Initial, Last_Name, Username, Password, User_Type, Email, Discord_Name, Can_Access) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("issssssssi", $uin, $firstName, $middleInitial, $lastName, $username, $password, $userType, $email, $discordUsername, $canAccess);
        $stmt1->execute();
        $stmt1->close();

        // Commit transaction
        $conn->commit();

        echo json_encode(["success" => true, "message" => "Registration successful."]);
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }

    $conn->close();
}
?>