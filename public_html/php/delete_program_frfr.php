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

  // Programs
  $sql = "DELETE FROM programs WHERE Program_Num = '$id';";
  $result = $conn->query($sql);
  if ($result === true) {
    echo "Delete operation successful.";
  } else {
      echo "Error deleting record: " . $conn->error;
  }

  // Track
  $sql = "DELETE FROM track WHERE Program = '$id';";
  $result = $conn->query($sql);
  if ($result === true) {
    echo "Delete operation successful.";
  } else {
      echo "Error deleting record: " . $conn->error;
  }

  // Events
  $sql = "DELETE FROM events WHERE Program_Num = '$id';";
  $result = $conn->query($sql);
  if ($result === true) {
    echo "Delete operation successful.";
  } else {
      echo "Error deleting record: " . $conn->error;
  }
  $sql = "DELETE FROM event_tracking WHERE Event_ID NOT IN (SELECT Event_ID FROM events);";
  $result = $conn->query($sql);
  if ($result === true) {
    echo "Delete operation successful.";
  } else {
      echo "Error deleting record: " . $conn->error;
  }

  // Applications
  $sql = "DELETE FROM applications WHERE Program_Num = '$id';";
  $result = $conn->query($sql);
  if ($result === true) {
    echo "Delete operation successful.";
  } else {
      echo "Error deleting record: " . $conn->error;
  }
  $sql = "DELETE FROM documentation WHERE App_Num NOT IN (SELECT App_Num FROM applications);";
  $result = $conn->query($sql);
  if ($result === true) {
    echo "Delete operation successful.";
  } else {
      echo "Error deleting record: " . $conn->error;
  }

  // Certificates
  $sql = "DELETE FROM cert_enrollment WHERE Program_Num = '$id';";
  $result = $conn->query($sql);
  if ($result === true) {
    echo "Delete operation successful.";
  } else {
      echo "Error deleting record: " . $conn->error;
  }
} else {
  echo "Missing Program ID";
}