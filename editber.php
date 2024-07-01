<?php
ob_start();
require_once("koneksidb.php");
require_once("headers.php");
$action = isset($_GET['action']) ? $_GET['action'] : '' ;
// echo $action;
if ($action == 'edit') {
  $id = $_GET['id'];
  $sql = "SELECT id_berita, judul, deskripsi, isi, tgl_terbit, images, id_penulis, id_kategori from berita where id_berita='$id'";
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

  $filename = $_FILES["images"]["name"];
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  $allowedTypes = array("jpg", "png", "jpeg");
  $tempname = $_FILES["images"]["tmp_name"];
  $targetpath = "images/".$filename;
  if(in_array($ext, $allowedTypes)){
    if(move_uploaded_file($tempname, $targetpath)){
      // $sql = "insert into berita(judul, deskripsi, isi, tgl_terbit, images, id_penulis, id_kategori) values ('$judul','$deskripsi','$isi','$tglpublish', '$filename', '$penulis', '$kategori') ";
      $sql = "update berita set judul = '$judul', deskripsi = '$deskripsi', isi = '$isi', tgl_terbit = '$tglpublish', images = '$filename', id_penulis = '$penulis', id_kategori = '$kategori' where id_berita = '".$_POST['id']."' ";
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
  // if ($_POST['id'] !== "") {
  //   $sql = "update berita set judul = '$judul', deskripsi = '$deskripsi', isi = '$isi', tgl_terbit = '$tglpublish', id_penulis = '$penulis', id_kategori = '$kategori' where id_berita = '".$_POST['id']."' ";
  //   header("Location:./index.php");
  //   // echo $_POST;

  // }
  // $result = $conn->query($sql);


  // echo $judul;
  // echo $deskripsi;
  // echo $isi;
  // echo $tglpublish;
  // echo $penulis;
  // echo $kategori;


  // echo $_POST['id'];
  

  
}
echo "<br />";



$sql = "SELECT id_berita, judul, deskripsi, isi, tgl_terbit, id_penulis, id_kategori from berita";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

	?>
   <div class="col-lg-12 col-xlg-9 col-md-12 p-5">
    <h2 class='py-3'>Edit Berita</h2>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="./editber.php" class="form-horizontal form-material" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $article['id_berita'] ?>"/>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0"><strong>Judul</strong></label>
                                        <div class="col-md-12 border-bottom p-0">

                                            <input type="text" name="judul" placeholder="Judul"
                                                class="form-control p-0 border-0" value="<?php echo $article['judul'] ?>"/></div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="username" class="col-md-12 p-0"><strong>Deskripsi</strong></label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <textarea name="deskripsi" placeholder="Deskripsi"
                                                class="form-control p-0 border-0"
                                               ><?php echo $article['deskripsi'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="control-group">
                                            <label class="control-label" class="col-md-12 p-0"><strong>Isi</strong></label>
                                            <div class="col-md-12 border-bottom p-0">
                                            <textarea name="isi" placeholder="Isi"
                                                class="form-control p-0 border-0"><?php echo $article['isi'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="control-group">
                                            <label class="control-label"><strong>Tanggal Publish</strong></label>
                                            <div class="controls">
                                                <input name="tglpublish" class="form-control" type="date" id="receiving_date" value="<?php echo date('Y-m-d',strtotime($article["tgl_terbit"])) ?>" required
                                                class="input-xlarge"/>
                                                <a href="javascript:showCalendar('date')"><img src="date.gif" width="19" height="17" border="0"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <h for="username" class="col-md-12 p-0"><strong>Penulis</strong></label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <select name="penulis" id="select" class="form-select" value="<?php echo $article['id_penulis'] ?>">
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
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="username" class="col-md-12 p-0"><strong>Kategori</strong></label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <select name="kategori" id="select" class="form-select" value="<?php echo $article['id_kategori'] ?>">
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
                                        </br>
                                    </div>
                                    <div class="form-group">
                                        <div class="control-group">
                                            <label class="control-label"><strong></strong></label>
                                            <div class="controls">
                                            <input type="file" name="images"
                                                class="form-control p-0 border-0" value="<?php echo $article['images'] ?>"><?php echo $article['images'] ?></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                        <button type="submit" name="Submit" class="mt-4 btn btn-dark d-flex justify-content-center align-items-center" name="submit">Edit Berita</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
</div>
<!--   
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
  <a href="/berita/koneksidb.php">kembali </a></br> -->

</form>