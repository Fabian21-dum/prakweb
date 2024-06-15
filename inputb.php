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
  $judul = $_POST['judul'];
  $deskripsi   = $_POST['deskripsi'];
  $isi = $_POST['isi'];
  $tglpublish = $_POST['tglpublish'];
  $penulis = $_POST['penulis'];
  $kategori = $_POST['kategori'];

  $sql = "insert into berita(judul, deskripsi, isi, tgl_terbit, id_penulis, id_kategori) values ('$judul','$deskripsi','$isi','$tglpublish','$penulis', '$kategori') ";
  $result = $conn->query($sql);
  header("Location:/berita/koneksidb.php");
  // echo "input ";
}
echo "<br />";



$sql = "SELECT id_berita, judul, deskripsi, isi, tgl_terbit, id_penulis, id_kategori from berita";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

	?>
<form method="POST" action="/berita/inputb.php">
<input type="hidden" name="id"/>
  <label for="judul">Judul:</label><br>
  <input type="text" id="judul" name="judul"><br>
  <label for="deskripsi">Deskripsi:</label><br>
  <textarea name="deskripsi"></textarea><br>
  <label for="isi">isi:</label><br>
  <textarea name="isi"></textarea><br>
  <label for="tglpublish">Tgl Publish:</label><br>
  <input type="date" id="tglpublish" name="tglpublish"><br>
  <label for="penulis">Penulis</label><br>
  <select name="penulis">
      <option value="">
        <?php
      
      $sql = "SELECT * FROM penulis";
      $data = $conn->query($sql);
      
      ?>
      <?php foreach ($data as $row): ?>
      <option value="<?= $row['id_penulis']?>">
        <?= $row['nama'] ?>
      </option>
      <?php endforeach ?>
    </select>
      </br>
  <label for="kategori">Kategori</label><br>
  <select name="kategori">
      <option value="">
        <?php
      
      $sql = "SELECT * FROM kategori";
      $data = $conn->query($sql);
      
      ?>
      <?php foreach ($data as $row): ?>
      <option value="<?= $row['id_kategori']?>">
        <?= $row['nama_kat'] ?>
      </option>
      <?php endforeach ?>
    </select>
  <input type="submit" value="simpan" />
  <a href="/berita/koneksidb.php">kembali </a></br>

</form>