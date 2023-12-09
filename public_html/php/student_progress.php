<?php
// Start a new session
session_start();

// Set header to return JSON content
header('Content-Type: application/json');

require_once './database_connection.php';

// Function to fetch data based on the entity
function fetchData($entity) {
    global $conn;

    // Define SQL queries based on the entity
    $sqlQueries = array(
        'classes' => "SELECT Class_ID, Name, Description, Type FROM Classes",
        'certifications' => "SELECT Cert_ID, Level, Name, Description FROM Certifications",
        'internships' => "SELECT Intern_ID, Name, Description, Is_Gov FROM Internships"
    );

    // Check if the entity is valid
    if (array_key_exists($entity, $sqlQueries)) {
        $sql = $sqlQueries[$entity];
        $result = $conn->query($sql);

        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo json_encode([]);
        }
    } else {
        echo json_encode(['error' => 'Invalid entity specified.']);
    }
}

// Check if the entity parameter is provided
if (isset($_GET['entity'])) {
    $entity = $_GET['entity'];
    fetchData($entity);
} else {
    echo json_encode(['error' => 'Entity parameter not provided.']);
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
    // updating class code
}

function deleteClassEnrollment() {
    $sql = "DELETE FROM {$table_name} WHERE {$primary_key} = '{$_POST[$primary_key]}'";
    $conn->query($sql);
}

function insertClassEnrollment() {
    // insert class code
}

$conn->close();

?>