<?php
ob_start();
require_once("koneksidb.php");
require_once("headers.php");
$action = isset($_GET['action']) ? $_GET['action'] : '' ;
// echo $action;
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
    $sql = "update penulis set id_penulis = '$id', nama = '$nama', tgl_lahir = '$tgllahir', gender = '$gender' where id_penulis = '".$_POST['id_pen']."' ";
    header("Location:./penulis.php");
    // echo "upd ";

  }
  $result = $conn->query($sql);


  echo $nama;
  echo $_POST['id_penulis'];
  

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;

}
echo "<br />";



$sql = "SELECT * from penulis";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

	?>
<div class="col-lg-12 col-xlg-9 col-md-12 p-5">
    <h2 class='py-3'>Edit Penulis</h2>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="./editpen.php" class="form-horizontal form-material" >
                                    <div class="form-group mb-4">
                                    <input type="hidden" name="id_pen" value="<?php echo $article['id_penulis'] ?>"/>
                                        <label class="col-md-12 p-0 pb-1 fw-bold">ID Penulis</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="id_penulis" placeholder="ID Penulis"
                                                class="form-control p-0 border-0" value="<?php echo $article['id_penulis'] ?>" maxlength="3" required> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="username" class="col-md-12 p-0 pb-1 fw-bold">Nama Penulis</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="nama" placeholder="Chat"
                                                class="form-control p-0 border-0" value="<?php echo $article['nama'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="control-group">
                                            <label class="control-label pb-1 fw-bold">Tanggal Lahir:</label>
                                            <div class="controls">
                                                <input name="tgl_lahir" class="form-control" type="date" id="receiving_date" value="<?php echo date('Y-m-d',strtotime($article["tgl_lahir"])) ?>" required
                                                class="input-xlarge"/>
                                                <!-- <a href="javascript:showCalendar('date')"><img src="date.gif" width="19" height="17" border="0"></a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="username" class="col-md-12 p-0 pb-1 fw-bold">Gender</label>
                                        <div class="col-md-12 border-bottom p-0 ">
                                        <select name="gender" id="gender" class="form-select" value="<?php echo $article['gender'] ?>" required>
                                        <option value="<?php echo $article['gender'] ?>"><?php echo $article['gender'] ?></option>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                            <option value="O">Other</option>
                                            <option value="X">XE/XER</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                        <button type="submit" name="Submit" class="mt-4 btn btn-dark d-flex justify-content-center align-items-center" name="submit">Edit Penulis</button>
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
