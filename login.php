<?php
session_start();
require_once("koneksidb.php");
try{
               if(isset($_POST["login"]))  
			   {  
				$nama=$_POST['nama'];
$password=$_POST['password'];
$password = md5($password);
					if(empty($_POST["nama"]) || empty($_POST["password"]))  
					{  
						 $message = '<label>All fields are required</label>';  
					}  
					else  
					{  
						 $sql = "SELECT * FROM admin WHERE nama = :nama AND password = :password";  
						 $stmt = $conn->prepare($sql);  
						 $stmt->execute(  
							  array(  
								   'nama'     =>     $nama,  
								   'password'     =>     $password  
							  )  
						 );  
						 $count = $stmt->rowCount();  
						 if($count > 0)  
						 {  
							  $_SESSION["nama"] = $_POST["nama"];  
							  header("location:main.php");  
						 }  
						 else  
						 {  
							  $message = '<label>Wrong Data</label>';  
						 }  
					}  
				}
			}
		  catch(PDOException $error)  
		  {  
			   $message = $error->getMessage();  
		  }  

?>
<head>
    <title>Login|ZVVL</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="css/style.css">
</head>
<body>
<section class="ftco-section">
		<div class="container">
		<?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login|ZVVL</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Have an account?</h3>
						<form action="login.php" method="POST" class="login-form pb-5">
		      		<div class="form-group">
		      			<input type="text" class="form-control rounded-left" placeholder="Nama" name="nama" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" placeholder="Password" name="password"required>
	            </div>
	            <div class="form-group d-md-flex">
                Don't have an account? <a href="./register.php" class="text-dark">	&nbsp; Register here</a>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="btn btn-dark rounded submit p-3 px-5" name="login">Login</button>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>
	

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

<!-- Pills content -->
</body>