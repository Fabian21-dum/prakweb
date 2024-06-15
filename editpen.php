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
  $id = $_GET['id_pen'];
  $sql = "SELECT * from penulis where id_penulis= '".$id."'";
  $result = $conn->query($sql);
  
  $article = $result->fetch(PDO::FETCH_ASSOC);

}else{

  $article = [
    'id_kategori' => '',
    'nama_kat' => '',
    'tgl_lahir' =>'',
    'gender'=>''
    
  ];

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //jalankan perintah untuk insert ke database
  $id = $_POST['id_penulis'];
  $nama   = $_POST['nama'];
  $tgllahir   = $_POST['tgl_lahir'];
  $gender   = $_POST['gender'];

  if ($_POST['id_pen'] !== "") {
    $sql = "update penulis set nama = '$nama', tgl_lahir = '$tgllahir', gender = '$gender' where id_penulis = '".$_POST['id_penulis']."' ";
    header("Location:/berita/penulis.php");
    // echo "upd ";

  }
  $result = $conn->query($sql);


  echo $nama;
  echo $_POST['id_penulis'];
  

  
}
echo "<br />";



$sql = "SELECT * from penulis";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

	?>
<form method="POST" action="/berita/editpen.php">
  <label for="id">Id Penulis:</label><br>
  <input type="text" name="id_penulis" value="<?php echo $article['id_penulis'] ?>" /></br>
  <label for="nama">Nama:</label><br>
  <input type="text" name="nama" value="<?php echo $article['nama'] ?>" /></br>
  <label for="isi">isi:</label><br>
  <input type="date" name="tgl_lahir"></input><br>
  <label for="gender">Gender:</label><br>
  <select name="gender" id="gender" value="<?php echo $article['gender'] ?>">
    <option value="L">Laki-Laki</option>
    <option value="P">Perempuan</option>
    <option value="O">Other</option>
    <option value="X">XE/XER</option>
    </select>
    <input type="submit" value="simpan" />
    <a href="/berita/penulis.php">kembali </a></b>
</form>