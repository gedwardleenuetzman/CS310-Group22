<?php
// Start a new session
session_start();

// Set header to return JSON content
header('Content-Type: application/json');

require_once './database_connection.php';

// SQL query to fetch all class enrollments
$sql = "SELECT CE_Num, UIN, Class_ID, Status, Semester, Year FROM Class_Enrollment";

$result = $conn->query($sql);

$enrollments = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $enrollments[] = $row;
    }
    echo json_encode($enrollments);
} else {
    echo json_encode([]);
}

// SQL query to fetch all cert enrollments
$sql = "SELECT CertE_Num, UIN, Cert_ID, Status, Training_Status, Program_Num, Semester, Year FROM Cert_Enrollment";

$result = $conn->query($sql);

$certEnrollments = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $certEnrollments[] = $row;
    }
    echo json_encode($certEnrollments);
} else {
    echo json_encode([]);
}

// SQL query to fetch all intern apps
$sql = "SELECT IA_Num, UIN, Intern_ID, Status, Year FROM Intern_App";

$result = $conn->query($sql);

$internApps = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $internApps[] = $row;
    }
    echo json_encode($internApps);
} else {
    echo json_encode([]);
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    console_log($POST);
    if (isset($_POST["update"])) {
        updateClassEnrollment();
    } elseif (isset($_POST["delete"])) {
        deleteClassEnrollment();
    } elseif (isset($_POST["insert"])) {
        addClassEnrollment();
    }
}

// Progress utility functions

function updateClassEnrollment() {
    // $updates = [];
    // foreach ($_POST as $key => $value) {
    //     if ($key != 'update' && $key != 'delete' && $key != 'insert' && $key != $primary_key) {
    //         // $updates[] = $conn->real_escape_string($key) . " = " . "'" . $conn->real_scape_string($value)
    //     }
    // }
    // $updates = implode(", ", $updates);
    // $sql = "UPDATE {$table_name} SET {$updates} WHERE {$primary_key} = '{$_POST[$primary_key]}'";
    // $conn->query($sql);
}

function deleteClassEnrollment() {
    $sql = "DELETE FROM {$table_name} WHERE {$primary_key} = '{$_POST[$primary_key]}'";
    $conn->query($sql);
}

function insertClassEnrollment() {
    // Insert new row
    // $columns = [];
    // $values = [];

    // foreach ($POST as $key => $value) {
    //     if ($key != 'update' && $key != 'delete' && $key != 'insert' && $key != $primary_key) {
    //         $columns[] = $conn->real_escape_string($key);
    //         $values[] = "'" . $conn->real_escape_string($value);
    //     }
    // }

    // $columns = implode(", ", $columns);
    // $values = implode(", ", $values);

    // $sql = "INSERT INTO {$table_name} VALUES {$columns} VALUES '{$values}'";
    // $conn->query($sql);
}

$conn->close();

?>