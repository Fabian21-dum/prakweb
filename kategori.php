<?php
require_once("koneksidb.php");
require_once("headers.php");


$sql = "SELECT * from kategori";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

if ($articles) {
	?>
<div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 p-5">
                    <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Data Kategori</h3>
                  <a href="inputkat.php"><button class='btn btn-dark px-2'>Tambah Kategori</button></a><br/><br/>
                  <div class="table-responsive">
                    <table class="table">
                    <theader>
                      <tr>
                        <th> ID Kategori </th>
                        <th> Nama Kategori</th>
                        <th> Aksi </th>
                      </tr>
                    </theader>
                      <tbody>
                      <?php
                         foreach ($articles as $article) {
                      ?>
                        <tr>
                          <td><?php echo $article['id_kategori'] ?></td>
                          <td><?php echo $article['nama_kat'] ?></td>

                          <td><a href="editkat.php?action=edit&id_kat=<?php echo $article['id_kategori']?>"><button class="btn btn-info text-white px-3">Edit </button></a>
                              <a href="hapuskat.php?action=hapus&id_kat=<?php echo $article['id_kategori']?>"><button class="btn btn-danger px-2">Hapus</button></a>
                        </tr>
                      <?php
                          }
                        }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                    </div>
                </div>
<br />
<?php
require_once("footer.php");
?>

