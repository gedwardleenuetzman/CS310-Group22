<?php
require_once './database_connection.php';

// SQL query to fetch all users
$sql = "SELECT Event_Type, Location, Start_Date, Start_Time, Event_ID FROM Events"; 

$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    echo json_encode($events);
} else {
    echo json_encode([]);
}

$conn->close();
?>