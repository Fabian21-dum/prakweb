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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //jalankan perintah untuk insert ke database
  $id = $_POST['id_penulis'];
  $nama   = $_POST['nama'];
  $tgllahir = $_POST['tgl_lahir'];
  $gender = $_POST['gender'];
  
  $sql = "insert into penulis(id_penulis, nama, tgl_lahir, gender) values ('$id','$nama','$tgllahir','$gender') ";
  $result = $conn->query($sql);
  header("Location:/berita/penulis.php");
}
echo "<br />";



$sql = "SELECT * from penulis";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

	?>
<form method="POST" action="/berita/inputp.php">
  <label for="id">Id Penulis:</label><br>
  <input type="text" id="id_penulis" name="id_penulis"><br>
  <label for="nama">Nama:</label><br>
  <input type="text" name="nama"></input><br>
  <label for="isi">isi:</label><br>
  <input type="date" name="tgl_lahir"></input><br>
  <label for="gender">Gender:</label><br>
  <select name="gender" id="gender">
<option value="L">Laki-Laki</option>
<option value="P">Perempuan</option>
<option value="O">Other</option>
<option value="X">XE/XER</option>
</select>
  <input type="submit" value="simpan" />
  <a href="/berita/penulis.php">kembali </a></br>
</form>