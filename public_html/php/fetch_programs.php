<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "id21627112_cs310_22";
$password = "Group22@TAMU";
$dbname = "id21627112_project_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Programs;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Initialize an array to hold the program data
  $programData = array();

  // Fetch data from the result set
  while ($row = $result->fetch_assoc()) {
      $programData[] = $row;
  }

  // Convert to JSON
  $jsonResult = json_encode($data, JSON_PRETTY_PRINT);

  // Output JSON
  echo $jsonResult;
} else {
  echo "No documentation found for the given UIN.";
}
