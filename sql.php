<?php
$servername = "140.138.77.70";
$username = "CS380B";
$password = "CS380B";
$dbname = "CS380B";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SET NAMES UTF8";

if ($conn->query($sql) === TRUE) {
  echo "SET NAMES UTF8 successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO s1103334 (name, class, stdnum,sex,phone,email)
VALUES ('乾泰', 'a', 'g','f','d','s')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>