<?php
$servername = "localhost";
$username = "id21627112_cs310_22";
$password = "Group22@TAMU";
$dbname = "id21627112_project_db";

if (isset($_GET['id'], $_GET['name'], $_GET['description'])) {
  $id = $_GET['id'];
  $name = $_GET['name'];
  $description = $_GET['description'];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "UPDATE Programs SET Name = '$name', Description = '$description' WHERE Program_Num = '$id';";
  
  $result = $conn->query($sql);
  
  if ($result === true) {
    echo "Edit operation successful.";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
} else {
  echo "A parameter is missing.";
}