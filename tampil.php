<?php
$sql = "SELECT * from berita";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

if ($articles) {

    foreach ($articles as $article) {
      ?>
      
      <?php
    }
}

    ?>
