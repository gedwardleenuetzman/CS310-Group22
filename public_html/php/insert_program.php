<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "id21627112_cs310_22";
$password = "Group22@TAMU";
$dbname = "id21627112_project_db";

if (isset($$_POST['name'], $_POST['description'])) {
  $name = $_POST['name'];
  $description = $_POST['description'];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO programs (Name, Description) VALUES ('$name', '$description')";
  
  $result = $conn->query($sql);
  
  if ($result === true) {
    echo "Insert operation successful.";
  } else {
    echo "Error adding record: " . $conn->error;
  }
} else {
  echo "A parameter is missing.";
}

