<?php
require_once("koneksidb.php");
require_once("headview.php");
require_once("tampil.php");
$action = isset($_GET['action']) ? $_GET['action'] : '' ;
if ($action == 'kat') {
$id=$_GET['id_kat'];
$sql = "SELECT * from berita where id_kategori= '".$id."'";
$result = $conn->query($sql);
        
        $articles = $result->fetchAll(PDO::FETCH_ASSOC);
}
        if($articles){
          ?>
<main class="container">
  <div class="p-4 p-md-5 mb-4 h-50 rounded text-body-emphasis bg-image align-items-left" style="background-image: url('<?php echo './images/'. $article['images'];?>'); background-size: cover; background-repeat: no-repeat;">
    <div class="col-lg-6 px-0">
    <h5 class="fst-italic text-white"><?php echo $article['id_kategori'];?></h6>
      <h1 class="display-6 fst-italic text-white"><?php echo $article['judul'];?></h1>
      <p class="lead my-3 text-white"><?php echo $article['deskripsi'];?></p>
      <p class="lead mb-0 text-white"><a href="isi.php?action=view&id=<?php echo $article['id_berita']?>" class="text-white fw-bold ">Continue reading...</a></p>
    </div>
  </div>
  <!-- <div id="display-image">
            <img src="images/<?php echo $article['images']; ?>">
    </div> -->
    <h2 class="display-4 fw-bold">Recent Stories</h2>
    <div class="album py-3">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php
        foreach($articles as $article){
            ?>
        <div class="col rounded">
          <div class="card">
          <img class="bd-placeholder-img object-fit-cover rounded-top" width="100%" height="200" src="images/<?php echo $article['images'];?>"></img>
            <div class="card-body">
            <input type="hidden" name="id" value="<?php echo $article['id_berita'] ?>"/>
            <h6 class="mb-2"><a href="mainkat.php?action=kat&id_kat=<?php echo $article['id_kategori']?>" class="text-black text-decoration-none"><?php echo $article['id_kategori'];?></a></h6>
            <h4 class="mb-2"><a href="isi.php?action=view&id=<?php echo $article['id_berita']?>" class="text-black text-decoration-none"><?php echo $article['judul'];?></a></h4>
              <p class="card-text"><?php echo $article['deskripsi'];?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="isi.php?action=view&id=<?php echo $article['id_berita']?>"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                  <!-- <a href="editber.php?action=edit&id=<?php echo $article['id_berita']?>"><button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a> -->
                  <!-- <a href="hapusber.php?action=hapus&id=<?php echo $article['id_berita']?>"><button type="button" class="btn btn-sm btn-outline-secondary">Hapus</button></a> -->
                </div>
                <small class="text-body-secondary"><?php echo $article['tgl_terbit'];?></small>
              </div>
            </div>
          </div>
        </div>
<?php 
        }
      }
       
    ?>
</main>

