<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=berita_2243058", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
echo "<br />";

$id = $_GET['id_pen'];
$sql = "delete from penulis where id_penulis = '".$id."'";
$conn->query($sql);
header("Location:./penulis.php");