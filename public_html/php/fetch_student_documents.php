<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "id21627112_cs310_22";
$password = "Group22@TAMU";
$dbname = "id21627112_project_db";



if (isset($_GET['uin'])) {
  $uin = $_GET['uin'];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "
    SELECT
      Doc_Num,
      Link,
      Doc_Type,
      Programs.Name AS Program_Name
    FROM
      Document
    JOIN
      Applications ON Document.App_Num = Applications.App_Num
    JOIN
      Programs ON Applications.Program_Num = Programs.Program_Num
    WHERE
      Applications.UIN = '$uin';
  ";
  
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $programName = $row['Program_Name'];
        unset($row['Program_Name']); // Remove Program_Name from the row data
        $data[$programName][] = $row;
    }

    // Convert to JSON
    $jsonResult = json_encode($data, JSON_PRETTY_PRINT);

    // Output JSON
    echo $jsonResult;
  } else {
    echo "No documentation found for the given UIN.";
  }
} else {
  echo "UIN parameter is missing.";
}

