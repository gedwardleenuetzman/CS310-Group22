<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "id21627112_cs310_22";
$password = "Group22@TAMU";
$dbname = "id21627112_project_db";

if (isset($_GET['id'], $_GET['link'])) {
  $id = $_GET['id'];
  $link = $_GET['link'];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "UPDATE documentation SET Link = '$link' WHERE Doc_Num = '$id';";
  
  $result = $conn->query($sql);
  
  if ($result === true) {
    echo "Edit operation successful.";
  } else {
      echo "Error deleting record: " . $conn->error;
  }
} else {
  echo "A parameter is missing.";
}