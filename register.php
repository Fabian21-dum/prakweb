<?php
require_once("koneksidb.php");
?>
<head>
    <title>Login|ZVVL</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="css/style.css">
</head>
<body>
<section class="ftco-section">
		<div class="container pb-5">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Register|ZVVL</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Dont Have an account?</h3>
						<form method="POST" action="./register.php" class="login-form pb-5">
		      		<div class="form-group">
		      			<input type="text" class="form-control rounded-left" placeholder="Nama" name="nama" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" placeholder="Password" name="password" required>
	            </div>
	            <div class="form-group d-md-flex">
                Have an account? <a href="login.php" class="text-dark">&nbsp;Login here</a>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="btn btn-dark rounded submit p-3 px-5" name="submit">Get Started</button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //jalankan perintah untuk insert ke database
  $nama = $_POST['nama'];
  $password   = $_POST['password'];
  $password = md5($password);
  $sql = "insert into admin(nama, password) values ('$nama','$password') ";
  $result = $conn->query($sql);
  header("Location:./main.php");
// echo "input";
}
echo "<br />";



$sql = "SELECT * from admin";
$result = $conn->query($sql);

$articles = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

<!-- Pills content -->
</body>