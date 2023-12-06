<?php
// Replace with your actual database credentials
$servername = "http://cs310group22.000webhostapp.com";
$username = "id21627112_cs310_22";
$password = "Group22@TAMU";
$dbname = "id21627112_project_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all users
$sql = "SELECT First_Name, M_Initial, Last_Name, Username, Email, Discord_Name FROM User";

$result = $conn->query($sql);

$users = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users);
} else {
    echo json_encode([]);
}

$conn->close();
?>
