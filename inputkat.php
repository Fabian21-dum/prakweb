<?php
ob_start();
require_once("koneksidb.php");
require_once("headers.php");



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //jalankan perintah untuk insert ke database
  $id = $_POST['id_kategori'];
  $nama   = $_POST['nama_kat'];
    $sql = "insert into kategori(id_kategori, nama_kat) values ('$id', '$nama') ";
    header("Location:./kategori.php");
    // echo "inp ";

  $result = $conn->query($sql);

}
echo "<br />";



$sql = "SELECT * from kategori";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

	?>
  <div class="col-lg-12 col-xlg-9 col-md-12 p-5">
    <h2 class='py-3'>Tambah Kategori</h2>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="./inputkat.php" class="form-horizontal form-material" >
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 pb-1 fw-bold">ID Kategori</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="id_kategori" placeholder="Input disini"
                                                class="form-control p-0 border-0" maxlength="3" required> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="username" class="col-md-12 pb-1 fw-bold">Nama kategori</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="nama_kat" placeholder="Input disini"
                                                class="form-control p-0 border-0" required
                                               >
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                        <button type="submit" name="Submit" class="mt-4 btn btn-dark d-flex justify-content-center align-items-center" name="submit">Tambah Kategori</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
</div>
<?php
require_once("footer.php");
?>