<?php
// Start a new session
session_start();

// Set header to return JSON content
header('Content-Type: application/json');

// Include database connection file (adjust the path as needed)
require_once './database_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    // Validate input
    if (empty($username) || empty($password)) {
        // Handle error - both fields are required
        echo json_encode(["success" => false, "message" => "Please enter both username and password."]);
        exit;
    } else {
        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);

        // Execute the statement
        $stmt->execute();

        // Store the result so we can check if the account exists in the database
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Bind the result to variables
            $stmt->bind_result($username_result, $password_result);
            $stmt->fetch();

            // Check if the provided password matches the one in the database
            if ($password === $password_result) {
                // Password is correct, start a new session
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $username_result;

                // Return success JSON
                echo json_encode(["success" => true]);
            } else {
                // Password is not valid, return error JSON
                echo json_encode(["success" => false, "message" => "Invalid username or password."]);
            }
        } else {
            // Username doesn't exist, return error JSON
            echo json_encode(["success" => false, "message" => "Invalid username or password."]);
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
}
?>
