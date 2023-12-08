<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "id21627112_cs310_22";
$password = "Group22@TAMU";
$dbname = "id21627112_project_db";

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "DELETE FROM Document WHERE Doc_Num = '$id'";
  
  $result = $conn->query($sql);
  
  if ($result === true) {
    echo "Delete operation successful.";
  } else {
      echo "Error deleting record: " . $conn->error;
  }
} else {
  echo "Missing Document ID";
}