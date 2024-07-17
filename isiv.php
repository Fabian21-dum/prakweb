<?php
ob_start();
require_once("koneksidb.php");
require_once("headview.php");

$action = isset($_GET['action']) ? $_GET['action'] : '' ;
// echo $action;
if ($action == 'view') {
  $id = $_GET['id'];
  $sql = "SELECT * from berita where id_berita= '".$id."'";
  $result = $conn->query($sql);
  
  $article = $result->fetch(PDO::FETCH_ASSOC);

}else{
    
echo "Not Found";
}
$sql = "SELECT * from berita";
       $result = $conn->query($sql);
       
       $articles = $result->fetchAll(PDO::FETCH_ASSOC);
       if($articles){
        
?>
  <div class="row g-5 px-5 mx-5 my-3">
  <input type="hidden" name="id" value="<?php echo $article['id_berita'] ?>"/>
    <div class="col-md-8">
      <article class="blog-post">
        <h2 class="display-5 link-body-emphasis mb-1 fw-bold py-3"><?php echo $article['judul'] ?></h2>
        <img class="rounded  text-body-emphasis bg-image align-items-left h-5 w-5 object-fit-cover" src="images/<?php echo $article['images'];?>" width="100%" height="500" ></img>
        <p class="blog-post-meta"><?php echo $article['tgl_terbit'] ?><h6>Ditulis oleh <?php echo $article['id_penulis'];?></h6></p>
        <p class="text-secondary h6 py-3"><?php echo $article['deskripsi'];?></p>
        <p style="text-align: justify;"class="h4"><?php echo nl2br($article['isi']);?></p>
      </article>
    </div>

    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-body-tertiary rounded">
          <h4 class="fst-italic">About Us</h4>
          <p class="mb-0">ZVVL is a place for you to get the new info on all of your favorite things</p>
        </div>
        
       
          <h4 class="fst-italic">Recent posts</h4>
          <?php
        //   foreach(array_slice($section['Article'], 0, 3) as $article ):
        foreach(array_slice($articles, 0, 3) as $article){
            ?>
             <div>
          <ul class="list-unstyled">
            <li>
              <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 
              link-body-emphasis text-decoration-none border-top" href="isiv.php?action=view&id=<?php echo $article['id_berita']?>">
                <img class="bd-placeholder-img object-fit-cover" src="images/<?php echo $article['images'];?>" width="100%" height="96"></img>
                <div class="col-lg-8">
                  <h6 class="mb-0"><?php echo $article['judul'] ?></h6>
                  <small class="text-body-secondary"><?php echo $article['tgl_terbit'] ?></small>
                </div>
              </a>
            </li>
        </ul>
        </div>


      <?php
        }
    }
    ?>

</div> 
</div>
</div>
 <?php
require_once("footer.php");
?>