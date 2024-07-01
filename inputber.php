    <?php
ob_start();
require_once("koneksidb.php");
require_once("headers.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //jalankan perintah untuk insert ke database
  $judul = $_POST['judul'];
  $deskripsi   = $_POST['deskripsi'];
  $isi = $_POST['isi'];
  $tglpublish = $_POST['tglpublish'];
  $penulis = $_POST['penulis'];
  $kategori = $_POST['kategori'];
  
  $filename = $_FILES["images"]["name"];
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  $allowedTypes = array("jpg", "png", "jpeg");
  $tempname = $_FILES["images"]["tmp_name"];
  $targetpath = "images/".$filename;
  if(in_array($ext, $allowedTypes)){
    if(move_uploaded_file($tempname, $targetpath)){
      $sql = "insert into berita(judul, deskripsi, isi, tgl_terbit, images, id_penulis, id_kategori) values ('$judul','$deskripsi','$isi','$tglpublish', '$filename', '$penulis', '$kategori') ";
      if($result = $conn->query($sql)){
      header("Location:./index.php");
        // echo "input ";

      }else{
        echo "uh oh";
      }

    }else{
      echo "file not uploaded";
    }
  }else{
    echo "types not allowed";
  }

  
}
echo "<br />";
$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;



$sql = "SELECT id_berita, judul, deskripsi, isi, tgl_terbit, images, id_penulis, id_kategori from berita";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

	?>
  <div class="col-lg-12 col-xlg-9 col-md-12 p-5">
    <h2 class='py-3'>Tambah Berita</h2>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="./inputber.php" class="form-horizontal form-material" enctype="multipart/form-data">
                                <input type="hidden" name="id"/>
                                    <div class="form-group mb-4">
                                    <div class="col-md-12 border-bottom p-0">

                                        <label class="col-md-12 p-0 pb-1 fw-bold">Judul</label>
                                            <input type="text" name="judul" placeholder="Judul"
                                                class="form-control p-0 border-0"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="username" class="col-md-12 p-0 pb-1 fw-bold">Deskripsi</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <textarea name="deskripsi" placeholder="Deskripsi"
                                                class="form-control p-0 border-0"
                                               ></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="control-group">
                                            <label class="col-md-12 p-0 pb-1 fw-bold">Isi</label>
                                            <div class="col-md-12 border-bottom p-0">
                                            <textarea name="isi" placeholder="Isi"
                                                class="form-control p-0 border-0"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="control-group">
                                            <label class="control-label pb-1 fw-bold">Tanggal Publish</label>
                                            <div class="controls">
                                                <input name="tglpublish" class="form-control" type="date" id="receiving_date" value="<?php echo $today; ?>" required
                                                class="input-xlarge"/>
                                                <!-- <a href="javascript:showCalendar('date')"><img src="date.gif" width="19" height="17" border="0"></a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <h for="username" class="col-md-12 p-0 pb-1 fw-bold">Penulis</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <select name="penulis" id="select" class="form-select">
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
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="username" class="col-md-12 p-0 pb-1 fw-bold">Kategori</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <select name="kategori" id="select" class="form-select">
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
                                        </br>
                                    </div>
                                    <div class="form-group">
                                        <div class="control-group">
                                            <label class="control-label pb-1 fw-bold">Image</label>
                                            <div class="controls">
                                            <input type="file" name="images"
                                                class="form-control p-0 border-0"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                        <button type="submit" name="Submit" class="mt-4 btn btn-dark d-flex justify-content-center align-items-center" name="submit">Tambah Berita</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
</div>

<!-- <form method="POST" action="./inputber.php" enctype="multipart/form-data">
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

    <label for="judul">Image:</label><br>
  <input type="file" id="judul" name="images"><br>

  <input type="submit" value="simpan" />
  <a href="/berita/koneksidb.php">kembali </a></br> -->

</form>