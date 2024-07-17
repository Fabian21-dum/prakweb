<?php
ob_start();
require_once("koneksidb.php");
require_once("headers.php");
$action = isset($_GET['action']) ? $_GET['action'] : '' ;
// echo $action;
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
    $sql = "update kategori set id_kategori = '$id', nama_kat = '$nama' where id_kategori = '".$_POST['id_kat']."' ";
    header("Location:./kategori.php");
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
  <div class="col-lg-12 col-xlg-9 col-md-12 p-5">
    <h2 class='py-3'>Edit Kategori</h2>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="./editkat.php" class="form-horizontal form-material" >
                                    <div class="form-group mb-4">
                                    <input type="hidden" name="id_kat" value="<?php echo $article['id_kategori'] ?>"/>
                                        <label class="col-md-12 p-0 pb-1 fw-bold">ID Kategori</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="id_kategori" placeholder="MUS"
                                                class="form-control p-0 border-0" value="<?php echo $article['id_kategori'] ?>" maxlength="3" required> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="username" class="col-md-12 p-0 pb-1 fw-bold">Nama kategori</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="nama_kat" placeholder="Music"
                                                class="form-control p-0 border-0" value="<?php echo $article['nama_kat'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                        <button type="submit" name="Submit" class="mt-4 btn btn-dark d-flex justify-content-center align-items-center" name="submit">Edit Kategori</button>
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