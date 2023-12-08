<?php
require_once './database_connection.php'; // Include your database connection file

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
    $hispanicLatino = isset($_POST['hispanicLatino']) ? sanitizeInput($_POST['hispanicLatino']) : null;
    $race = isset($_POST['race']) ? sanitizeInput($_POST['race']) : null;
    $usCitizen = isset($_POST['usCitizen']) ? sanitizeInput($_POST['usCitizen']) : null;
    $firstGenCollegeStudent = isset($_POST['firstGenCollegeStudent']) ? sanitizeInput($_POST['firstGenCollegeStudent']) : null;
    $dob = sanitizeInput($_POST['registerDOB']);
    $gpa = sanitizeInput($_POST['registerGPA']);
    $major = sanitizeInput($_POST['registerMajor']);
    $minor1 = sanitizeInput($_POST['registerMinor1']);
    $minor2 = sanitizeInput($_POST['registerMinor2']); 
    $expectedGraduation = sanitizeInput($_POST['registerExpectedGraduation']);
    $school = sanitizeInput($_POST['registerSchool']);
    $classification = sanitizeInput($_POST['registerClassification']);
    $phoneNumber = sanitizeInput($_POST['registerPhoneNumber']);
    $userType = "Student"
    $studentType = "Program Member"

    // Start transaction
    $conn->begin_transaction();

    try {
        // First Insert Statement
        $stmt1 = $conn->prepare("INSERT INTO Users (UIN, First_Name, M_Initial, Last_Name, Username, Password, User_Type, Email, Discord_Name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("sssssssss", $uin, $firstName, $middleInitial, $lastName, $username, $password, $userType, $email, $discordUsername);
        $stmt1->execute();
        $stmt1->close();

        // Second Insert Statement
        $stmt2 = $conn->prepare("INSERT INTO College_Student(UIN, Gender, Hispanic_Latino, Race, US_Citizen, First_Generation, DoB, GPA, Major, Minor_1, Minor_2, Expected_Graduation, School, Classification, Phone, Student_Type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("sssssssdssssssss", $uin, $gender, $hispanicLatino, $race, $usCitizen, $firstGenCollegeStudent, $dob, $gpa, $major, $minor1, $minor2, $expectedGraduation, $school, $classification, $phoneNumber, $studentType);
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