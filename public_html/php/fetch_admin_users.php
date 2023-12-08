<?php
require_once './database_connection.php';

// Get database connection
$conn = getDbConnection();

// SQL query to fetch all users
$sql = "SELECT First_Name, M_Initial, Last_Name, Username, Email, Discord_Name FROM Users";

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
