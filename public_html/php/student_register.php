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
    $gender = isset($_POST['gender']) ? sanitizeInput($_POST['gender']) : null;
    $hispanicLatino = (isset($_POST['hispanicLatino']) && $_POST['hispanicLatino'] === 'Yes') ? 1 : 0;
    $race = isset($_POST['race']) ? sanitizeInput($_POST['race']) : null;
    $usCitizen = (isset($_POST['usCitizen']) && $_POST['usCitizen'] === 'Yes') ? 1 : 0;
    $firstGenCollegeStudent = (isset($_POST['firstGenCollegeStudent']) && $_POST['firstGenCollegeStudent'] === 'Yes') ? 1 : 0;
    $dob = formatDate(sanitizeInput($_POST['registerDOB']));
    $gpa = sanitizeInput($_POST['registerGPA']);
    $major = sanitizeInput($_POST['registerMajor']);
    $minor1 = sanitizeInput($_POST['registerMinor1']);
    $minor2 = sanitizeInput($_POST['registerMinor2']); 
    $expectedGraduation = sanitizeInput($_POST['registerExpectedGraduation']);
    $school = sanitizeInput($_POST['registerSchool']);
    $classification = sanitizeInput($_POST['registerClassification']);
    $phoneNumber = sanitizeInput($_POST['registerPhoneNumber']);
    $userType = "Student";
    $studentType = "Program Member";
    $canAccess = 0

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

            $deleteStmt2 = $conn->prepare("DELETE FROM College_Student WHERE UIN = ?");
            $deleteStmt2->bind_param("i", $existingUIN); // Changed the data type to integer
            $deleteStmt2->execute();
            $deleteStmt2->close();
        }
        
        // First Insert Statement
        $stmt1 = $conn->prepare("INSERT INTO Users (UIN, First_Name, M_Initial, Last_Name, Username, Password, User_Type, Email, Discord_Name, Can_Access) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("issssssssb", $uin, $firstName, $middleInitial, $lastName, $username, $password, $userType, $email, $discordUsername, $canAccess);
        $stmt1->execute();
        $stmt1->close();

        // Second Insert Statement
        $stmt2 = $conn->prepare("INSERT INTO College_Student (UIN, Gender, Hispanic_Latino, Race, US_Citizen, First_Generation, DoB, GPA, Major, Minor_1, Minor_2, Expected_Graduation, School, Classification, Phone, Student_Type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("isbsbbsdsssissis", $uin, $gender, $hispanicLatino, $race, $usCitizen, $firstGenCollegeStudent, $dob, $gpa, $major, $minor1, $minor2, $expectedGraduation, $school, $classification, $phoneNumber, $studentType);
        $stmt2->execute();
        $stmt2->close();

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