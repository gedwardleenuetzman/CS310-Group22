<?php
require_once './database_connection.php';

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

function populateTable() {
    // Build the query to retrieve all values from Class_Enrollment
    $table_name = "Class_Enrollment";
    $uin = $GET["UIN"];
    $query_str = "SELECT * FROM {$table_name} WHERE UIN = {$uin}";

    // Call the buildEditableTable function
    buildEditableTable($conn, $query_str, array(
        "CE_Num" => array("label" => "CE_Num", "type" => "text", "editable" => false),
        "UIN" => array("label" => "UIN", "type" => "text", "editable" => false),
        "Class_ID" => array("label" => "Class ID", "type" => "text", "editable" => true),
        "Status" => array("label" => "Status", "type" => "text", "editable" => true),
        "Semester" => array("label" => "Semester", "type" => "text", "editable" => true),
        "Year" => array("label" => "Year", "type" => "number", "editable" => true)
    ));
}

// Progress utility functions

function updateClassEnrollment() {
    $updates = [];
    foreach ($_POST as $key => $value) {
        if ($key != 'update' && $key != 'delete' && $key != 'insert' && $key != $primary_key) {
            // $updates[] = $conn->real_escape_string($key) . " = " . "'" . $conn->real_scape_string($value)
        }
    }
    $updates = implode(", ", $updates);
    $sql = "UPDATE {$table_name} SET {$updates} WHERE {$primary_key} = '{$_POST[$primary_key]}'";
    $conn->query($sql);
}

function deleteClassEnrollment() {
    $sql = "DELETE FROM {$table_name} WHERE {$primary_key} = '{$_POST[$primary_key]}'";
    $conn->query($sql);
}

function insertClassEnrollment() {
    // Insert new row
    $columns = [];
    $values = [];

    foreach ($POST as $key => $value) {
        if ($key != 'update' && $key != 'delete' && $key != 'insert' && $key != $primary_key) {
            $columns[] = $conn->real_escape_string($key);
            $values[] = "'" . $conn->real_escape_string($value);
        }
    }

    $columns = implode(", ", $columns);
    $values = implode(", ", $values);

    $sql = "INSERT INTO {$table_name} VALUES {$columns} VALUES '{$values}'";
    $conn->query($sql);
}


?>