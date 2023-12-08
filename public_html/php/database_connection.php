<?php
// Database credentials
$servername = "localhost";
$username = "id21627112_cs310_22";
$password = "Group22@TAMU";
$dbname = "id21627112_project_db";

// Create and return the database connection
function getDbConnection() {
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
