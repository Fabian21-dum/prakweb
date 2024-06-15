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
  $id = $_POST['id_kategori'];
  $nama   = $_POST['nama_kat'];
    $sql = "insert into kategori(id_kategori, nama_kat) values ('$id', '$nama') ";
    header("Location:/berita/kategori.php");
    // echo "inp ";

    

  
  $result = $conn->query($sql);

}
echo "<br />";



$sql = "SELECT * from kategori";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

	?>
<form method="POST" action="/berita/inputk.php">
<label for="judul">ID Kategori:</label><br>
<input type="text" name="id_kategori" value="" /></br>
<label for="deskripsi">Nama:</label><br>
  <input type="text" id="nama_kat" name="nama_kat" value=""><br>
  <input type="submit" value="simpan" />
  <a href="/berita/kategori.php">kembali </a></br>

</form>