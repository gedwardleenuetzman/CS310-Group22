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
      programs.Name AS Program_Name
    FROM
      documentation
    JOIN
      applications ON documentation.App_Num = applications.App_Num
    JOIN
      programs ON applications.Program_Num = programs.Program_Num
    WHERE
      applications.UIN = '$uin';
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

