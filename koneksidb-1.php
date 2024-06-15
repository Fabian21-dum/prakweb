<?php
$servername = "localhost";
$username = "root";
$password = "wicida";

try {
  $conn = new PDO("mysql:host=$servername;dbname=website_berita", $username, $password);
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
  
  $sql = "insert into artikel(judul, deskripsi, isi, tgl_publish, penulis) values ('$judul','$deskripsi','$isi','$tglpublish','$penulis') ";
  $result = $conn->query($sql);
}



echo "<br />";

$sql = "SELECT id, judul, deskripsi, isi, tgl_publish, penulis from artikel";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

if ($articles) {
?>
<table border="2">
  <theader>
     <tr>
        <th> id </th>
        <th> judul </th>
        <th> deskripsi </th>
        <th> isi </th>
        <th> tgl publish </th>
        <th> penulis </th>
    </tr>
  </theader>
  <tbody>
  <?php
    foreach ($articles as $article) {
      ?>
      <tr>
          <td><?php echo $article['id'] ?></td>
          <td><?php echo $article['judul'] ?></td>
          <td><?php echo $article['deskripsi'] ?></td>
          <td><?php echo $article['isi'] ?></td>
          <td><?php echo $article['tgl_publish'] ?></td>
          <td><?php echo $article['penulis'] ?></td>
      </tr>
      <?php
    }
  }
  ?>
  </tbody>
</table>

<br />

<form method="POST" action="/belajar-db/koneksidb.php">
  <label for="judul">Judul:</label><br>
  <input type="text" id="judul" name="judul"><br>
  <label for="deskripsi">Deskripsi:</label><br>
  <textarea name="deskripsi"></textarea><br>
  <label for="isi">isi:</label><br>
  <textarea name="isi"></textarea><br>
  <label for="tglpublish">Tgl Publish:</label><br>
  <input type="text" id="tglpublish" name="tglpublish"><br>
  <label for="penulis">Penulis</label><br>
  <input type="text" id="penulis" name="penulis"><br>
  <input type="submit" value="simpan" />
</form>


