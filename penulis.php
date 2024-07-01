<?php
ob_start();
require_once("koneksidb.php");
require_once("headers.php");


$sql = "SELECT * from penulis";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

if ($articles) {
	?>
 <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 p-5">
                    <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Data Penulis</h3>
                  <a href="inputpen.php"><button class='btn btn-dark px-2'>Tambah Penulis</button></a><br/><br/>
                  <div class="table-responsive">
                    <table class="table">
                    <theader>
                      <tr>
                        <th> id </th>
                        <th> Nama </th>
                        <th> tanggal lahir </th>
                        <th> gender </th>
                        <th> Aksi </th>
                      </tr>
                    </theader>
                      <tbody>
                      <?php
                         foreach ($articles as $article) {
                      ?>
                        <tr>
                          <td><?php echo $article['id_penulis'] ?></td>
                          <td><?php echo $article['nama'] ?></td>
                          <td><?php echo $article['tgl_lahir'] ?></td>
                          <td><?php echo $article['gender'] ?></td>
                          <td><a href="editpen.php?action=edit&id_pen=<?php echo $article['id_penulis']?>"><button class='btn btn-info text-white px-3'>Edit </button></a>
                          <a href="hapuspen.php?action=hapus&id_pen=<?php echo $article['id_penulis']?>"><button class='btn btn-danger px-2'>Hapus</button></a>
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