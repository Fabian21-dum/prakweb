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

$action = isset($_GET['action']) ? $_GET['action'] : '' ;
echo $action;
if ($action == 'edit') {
  $id = $_GET['id_kat'];
  $sql = "SELECT * from kategori where id_kategori= '".$id."'";
  $result = $conn->query($sql);
  
  $article = $result->fetch(PDO::FETCH_ASSOC);

}else{

  $article = [
    'id_kategori' => '',
    'nama_kat' => ''
    
  ];

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //jalankan perintah untuk insert ke database
  $id = $_POST['id_kategori'];
  $nama   = $_POST['nama_kat'];

  if ($_POST['id_kat'] !== "") {
    $sql = "update kategori set nama_kat = '$nama' where id_kategori = '".$_POST['id_kategori']."' ";
    header("Location:/berita/kategori.php");
    // echo "upd ";

  }
  $result = $conn->query($sql);


  echo $nama;
  echo $_POST['id_kategori'];
  

  
}
echo "<br />";



$sql = "SELECT * from kategori";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

	?>
<form method="POST" action="/berita/editkat.php">
<label for="judul">ID Kategori:</label><br>
<input type="text" name="id_kategori" value="<?php echo $article['id_kategori'] ?>" readonly/></br>
<label for="deskripsi">Nama:</label><br>
  <input type="text" id="nama_kat" name="nama_kat" value="<?php echo $article['nama_kat'] ?>"><br>
  <input type="submit" value="simpan" />
  <a href="/berita/kategori.php">kembali </a></br>

</form>