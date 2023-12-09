<?php
// modify_admin_user.php

session_start();
require_once './database_connection.php';

header('Content-Type: application/json');

// Function to validate input data
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST variables and validate them
    $uin = validate($_POST['UIN']);
    $firstName = validate($_POST['First_Name']);
    $middleInitial = validate($_POST['M_Initial']);
    $lastName = validate($_POST['Last_Name']);
    $username = validate($_POST['Username']);
    $email = validate($_POST['Email']);
    $discordName = validate($_POST['Discord_Name']);
    $canAccess = validate($_POST['Can_Access']);

    // Prepare SQL query to update the user's data
    $sql = "UPDATE Users SET First_Name = ?, M_Initial = ?, Last_Name = ?, Username = ?, Email = ?, Discord_Name = ?, Can_Access = ? WHERE UIN = ?";
    
    if($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssbi", $firstName, $middleInitial, $lastName, $username, $email, $discordName, $canAccess, $uin);
        $stmt->execute();

        if($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No changes were made to the user data.']);
        }

        $stmt->close();
    } else {
        // Handle errors with preparing the SQL statement
        echo json_encode(['status' => 'error', 'message' => 'Error updating user data.']);
    }
} else {
    // If not a POST request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

$conn->close();
?>
