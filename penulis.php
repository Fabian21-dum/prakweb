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



$sql = "SELECT * from penulis";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

if ($articles) {
	?>

<table border="2">
  <theader>
     <tr>
        <th> id </th>
        <th> Nama </th>
        <th> tanggal lahir </th>
        <th> gender </th>
        <th> Aksi </th>
    </tr>
  </theader>
  <tbody>
  <?php
    foreach ($articles as $article) {
      ?>
      <tr>
          <td><?php echo $article['id_penulis'] ?></td>
          <td><?php echo $article['nama'] ?></td>
          <td><?php echo $article['tgl_lahir'] ?></td>
          <td><?php echo $article['gender'] ?></td>
          <td><a href="editpen.php?action=edit&id_pen=<?php echo $article['id_penulis']?>">Edit </a><a href="hapuspen.php?action=hapus&id_pen=<?php echo $article['id_penulis']?>">Hapus</a>
      </tr>
      <?php
    }
  }
  ?>
  </tbody>
</table>

<br />
<a href="/berita/inputp.php">Input Penulis </a></br></br>
<a href="/berita/inputb.php">Input Berita </a></br>
<a href="/berita/koneksidb.php">Lihat Berita </a></br></br>

<a href="/berita/inputk.php">Input Kategori </a></br>
<a href="/berita/kategori.php">Lihat Kategori </a></br>