<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "id21627112_cs310_22";
$password = "Group22@TAMU";
$dbname = "id21627112_project_db";



if (isset($_POST['uin'], $_POST['prog_name'], $_POST['link'], $_POST['doc_type'])) {
  $uin = $_POST['uin'];
  $programName = $_POST['prog_name'];
  $link = $_POST['link'];
  $doc_type = $_POST['doc_type'];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("SELECT app.App_Num FROM applications app
                          INNER JOIN programs prog ON app.Program_Num = prog.Program_Num
                          WHERE app.UIN = ? AND prog.Name = ?");
  $stmt->bind_param("is", $uin, $programName);
  $stmt->execute();
  $stmt->bind_result($appNum);
  $stmt->fetch();
  $stmt->close();

  $sql = "INSERT INTO documentation (App_Num, Link, Doc_Type) VALUES ($appNum, $link, $doc_type)";
  
  $result = $conn->query($sql);
  
  if ($result === true) {
    echo "Delete operation successful.";
  } else {
    echo "Error adding record: " . $conn->error;
  }
} else {
  echo "UIN parameter is missing.";
}

