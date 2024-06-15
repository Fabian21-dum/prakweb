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

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   //jalankan perintah untuk insert ke database
//   $judul = $_POST['judul'];
//   $deskripsi   = $_POST['deskripsi'];
//   $isi = $_POST['isi'];
//   $tglpublish = $_POST['tglpublish'];
//   $penulis = $_POST['penulis'];
//   $kategori = $_POST['kategori'];
  
//   $sql = "insert into berita(judul, deskripsi, isi, tgl_terbit, id_penulis, id_kategori) values ('$judul','$deskripsi','$isi','$tglpublish','$penulis', '$kategori') ";
//   $result = $conn->query($sql);

 
  
  


echo "<br />";



$sql = "SELECT id_berita, judul, deskripsi, isi, tgl_terbit, id_penulis, id_kategori from berita";
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
        <th> kategori </th>
        <th> Aksi </th>
    </tr>
  </theader>
  <tbody>
  <?php
    foreach ($articles as $article) {
      ?>
      <tr>
          <td><?php echo $article['id_berita'] ?></td>
          <td><?php echo $article['judul'] ?></td>
          <td><?php echo $article['deskripsi'] ?></td>
          <td><?php echo $article['isi'] ?></td>
          <td><?php echo $article['tgl_terbit'] ?></td>
          <td><?php echo $article['id_penulis'] ?></td>
          <td><?php echo $article['id_kategori'] ?></td>
          <td><a href="editber.php?action=edit&id=<?php echo $article['id_berita']?>">Edit </a><a href="hapusber.php?action=hapus&id=<?php echo $article['id_berita']?>">Hapus</a>
      </tr>
      <?php
    }
  }
  ?>
  </tbody>
</table>

<br />
<a href="/berita/inputb.php">Input Berita </a></br></br>
<a href="/berita/inputp.php">Input Penulis </a></br>
<a href="/berita/penulis.php">Lihat Penulis </a></br></br>
<a href="/berita/inputk.php">Input Kategori </a></br>
<a href="/berita/kategori.php">Lihat Kategori </a></br>
