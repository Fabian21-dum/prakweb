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
  $id = $_GET['id'];
  $sql = "SELECT id_berita, judul, deskripsi, isi, tgl_terbit, id_penulis, id_kategori from berita where id_berita= '".$id."'";
  $result = $conn->query($sql);
  
  $article = $result->fetch(PDO::FETCH_ASSOC);
}else{

  $article = [
    'id' => '',
    'judul' => '',
    'deskripsi' => '',
    'isi' => '',
    'tgl_publish' => '',
    'penulis' => '',
    'kategori' => ''

  ];

}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //jalankan perintah untuk insert ke database
  $judul = $_POST['judul'];
  $deskripsi   = $_POST['deskripsi'];
  $isi = $_POST['isi'];
  $tglpublish = $_POST['tglpublish'];
  $penulis = $_POST['penulis'];
  $kategori = $_POST['kategori'];
  if ($_POST['id'] !== "") {
    $sql = "update berita set judul = '$judul', deskripsi = '$deskripsi', isi = '$isi', tgl_terbit = '$tglpublish', id_penulis = '$penulis', id_kategori = '$kategori' where id_berita = '".$_POST['id']."' ";
    header("Location:/berita/koneksidb.php");
    // echo $_POST;

  }
  $result = $conn->query($sql);


  echo $judul;
  echo $deskripsi;
  echo $isi;
  echo $tglpublish;
  echo $penulis;
  echo $kategori;


  echo $_POST['id'];
  

  
}
echo "<br />";



$sql = "SELECT id_berita, judul, deskripsi, isi, tgl_terbit, id_penulis, id_kategori from berita";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

	?>
<form method="POST" action="/berita/editber.php">
<input type="hidden" name="id" value="<?php echo $article['id_berita'] ?>" />
  <label for="judul">Judul:</label><br>
  <input type="text" id="judul" name="judul" value="<?php echo $article['judul'] ?>"><br>
  <label for="deskripsi">Deskripsi:</label><br>
  <textarea name="deskripsi"><?php echo $article['deskripsi'] ?></textarea><br>
  <label for="isi">isi:</label><br>
  <textarea name="isi"><?php echo $article['isi'] ?></textarea><br>
  <label for="tglpublish">Tgl Publish:</label><br>
  <input type="date" id="tglpublish" name="tglpublish" value="<?php echo date('Y-m-d',strtotime($article["tgl_terbit"])) ?>"><br>
  <label for="penulis">Penulis</label><br>
  <select name="penulis" value="<?php echo $article['id_penulis'] ?>">
      <option value=""><?php echo $article['id_penulis'] ?>
        <?php
      
      $sql = "SELECT * FROM penulis";
      $data = $conn->query($sql);
      
      ?>
      <?php foreach ($data as $row): 
        $selected = $row['id_penulis'] == $article["id_penulis"] ? "selected" : "";
        ?>
      <option value='<?= $selected = $row['id_penulis']?>' <?= $selected ?> ><?= $row['nama']?></option>
      <?php endforeach ?>
    </select>
      </br>
  <label for="kategori">Kategori</label><br>
  <select name="kategori" value="<?php echo $article['id_kategori'] ?>">
      <option value=""><?php echo $article['id_kategori'] ?>
        <?php
      
      $sql = "SELECT * FROM kategori";
      $data = $conn->query($sql);
      
      ?>
      <?php foreach ($data as $row): 
        $selected = $row['id_kategori'] == $article["id_kategori"] ? "selected" : "";
        ?>
      <option value='<?= $selected = $row['id_kategori']?>' <?= $selected ?> ><?= $row['nama_kat']?></option>
      <?php endforeach ?>
    </select>
  <input type="submit" value="simpan" />
  <a href="/berita/koneksidb.php">kembali </a></br>

</form>