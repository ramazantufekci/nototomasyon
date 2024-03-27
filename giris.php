<?php
include_once("database.php");
session_start();

if($_POST){
	$db = new Database();
	$email = $_POST['email'];
	$password = $_POST['password'];
	if($db->authenticateUser($email,$password)){
		$user = $db->getUserByEmail($email);
		$_SESSION['role'] = $user['role'];
		$_SESSION['email'] = $user['email'];
		$_SESSION['ad'] = $user['ad']." ".$user['soyad'];
	}
	if(isset($_SESSION["role"]) && $_SESSION["role"]=='user'){
		header("location:ogrenci.php");
	}else if(isset($_SESSION["role"]) && $_SESSION["role"]=='admin'){
		header("location:admin.php");
	}
}
?>
<!doctype html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Okul Otomasyonu</title>
  </head>
  <body class="container mt-5">
  <div class="row">
	<div class="col-sm-12 my-auto">
		<div class="w-50 mx-auto text-center">
			<h2>Okul Otomasyonu</h2>
			
		</div>
		
		<form class="card card-block w-50 h-100 m-auto p-2 bg-light mt-3" action="/giris.php" method="POST">
			<div class="mb-3">
			  <label for="email" class="form-label">Mail Adresiniz</label>
			  <input type="email" class="form-control" id="email" name="email" placeholder="mail@adresiniz.com"/> 
			</div>
			<div class="mb-3">
			  <label for="password" class="form-label">Şifreniz</label>
			  <input type="password" class="form-control" id="password" name="password" placeholder="Şifre Giriniz"/> 
			</div>
			<button type="submit" class="btn btn-primary">Giriş Yap</button>
			<a class="mt-3 btn btn-primary" href="/kayit.php">Kayıt Ol</a>
		</form>
	</div>
  </div>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>