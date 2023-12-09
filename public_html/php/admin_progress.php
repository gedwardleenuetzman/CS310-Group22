<?php
// Start a new session
session_start();

// Set header to return JSON content
header('Content-Type: application/json');

require_once './database_connection.php';

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
        'class_enrollment' => "SELECT CE_Num, UIN, Class_ID, Status, Semester, Year FROM Class_Enrollment",
        'cert_enrollment' => "SELECT CertE_Num, UIN, Cert_ID, Status, Training_Status, Program_Num, Semester, Year FROM Cert_Enrollment",
        'intern_app' => "SELECT IA_Num, UIN, Intern_ID, Status, Year FROM Intern_App"
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