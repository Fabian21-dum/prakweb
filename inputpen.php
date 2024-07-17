<?php
ob_start();
require_once("headers.php");
require_once("koneksidb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //jalankan perintah untuk insert ke database
  $id = $_POST['id_penulis'];
  $nama   = $_POST['nama'];
  $tgllahir = $_POST['tgl_lahir'];
  $gender = $_POST['gender'];
  
  $sql = "insert into penulis(id_penulis, nama, tgl_lahir, gender) values ('$id','$nama','$tgllahir','$gender') ";
  $result = $conn->query($sql);
  header("Location:./penulis.php");
}
echo "<br />";



$sql = "SELECT * from penulis";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;

	?>
  <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  </head>
  <body>
  <div class="col-lg-12 col-xlg-9 col-md-12 p-5">
    <h2 class='py-3'>Tambah Penulis</h2>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="./inputpen.php" class="form-horizontal form-material" >
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 pb-1 fw-bold">ID Penulis</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="id_penulis" placeholder="ID Anda"
                                                class="form-control p-0 border-0" maxlength="3" required> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="username" class="col-md-12 p-0 pb-1 fw-bold">Nama Penulis</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="nama" placeholder="Nama Anda"
                                                class="form-control p-0 border-0"
                                               >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="control-group">
                                            <label class="control-label pb-1 fw-bold">Tanggal Lahir:</label>
                                            <div class="controls">
                                                <input name="tgl_lahir" class="form-control" type="date" id="receiving_date" value="<?php echo $today; ?>" required
                                                class="input-xlarge"/>
                                                <!-- <a href="javascript:showCalendar('date')"><img src="date.gif" width="19" height="17" border="0"></a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="username" class="col-md-12 p-0 pb-1 fw-bold">Gender</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <select name="gender" id="gender" class="form-select" required>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                            <option value="O">Other</option>
                                            <option value="X">XE/XER</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                        <button type="submit" name="Submit" class="mt-4 btn btn-dark d-flex justify-content-center align-items-center" name="submit">Tambah Penulis</button>
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
  </body>
</html>
