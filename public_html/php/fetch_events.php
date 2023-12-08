<?php
require_once './database_connection.php';

// Get database connection
$conn = getDbConnection();

// SQL query to fetch all users
$sql = "SELECT Event_ID, Program_Num, Start_Date, Location, Event_Type FROM Event";

$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    echo json_encode($users);
} else {
    echo json_encode([]);
}

$conn->close();
?>