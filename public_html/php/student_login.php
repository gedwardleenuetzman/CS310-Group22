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
    $inputUsername = isset($_POST['inputUsername']) ? trim($_POST['inputUsername']) : null;
    $inputPassword = isset($_POST['inputPassword']) ? trim($_POST['inputPassword']) : null;

    // Validate input
    if (empty($inputUsername) || empty($inputPassword)) {
        echo json_encode(["success" => false, "message" => "Please enter both username and password."]);
        exit;
    } else {
        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT Username, Password FROM Users WHERE Username = ?");
        $stmt->bind_param("s", $inputUsername);

        // Execute the statement
        $stmt->execute();

        // Store the result to check if the account exists
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Bind the result to variables
            $stmt->bind_result($username_result, $password_result);
            $stmt->fetch();

            // Check if the provided password matches
            if ($inputPassword === $password_result) {
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $username_result;

                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Invalid username or password."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid username or password."]);
        }

        $stmt->close();
    }

    $conn->close();
}
?>
