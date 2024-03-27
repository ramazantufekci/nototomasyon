<?php
include_once("database.php");
session_start();

// CSRF token oluşturma fonksiyonu
function generate_csrf_token() {
    return bin2hex(random_bytes(32));
}

// Kullanıcı kaydı fonksiyonu
function register_user($ad,$soyad,$email, $password) {    
	$db = new Database();
	if($db->addUser($ad,$soyad,$email,$password)===TRUE){
		return true;
	}
	return false;
	
}

// Kullanıcı kaydı formu
if (isset($_POST['register'])) {
	$ad = $_POST['ad'];
	$soyad = $_POST['soyad'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    register_user($ad, $soyad, $email, $password);
	header('location:/index.php');
    echo "Kullanıcı başarıyla kaydedildi!";
}

// CSRF token oluşturulması ve saklanması
$_SESSION['token'] = generate_csrf_token();
?><!doctype html>
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
		<div class="w-50 mx-auto">
			<h2>Okul Otomasyonu</h2>
		</div>
		
		<form class="card card-block w-50 h-100 m-auto p-2 bg-light" action="/kayit.php" method="POST">
		<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
		<div class="mb-3">
		  <label for="ad" class="form-label">Adınız</label>
		  <input type="text" class="form-control" id="ad" name="ad" placeholder="Adınız">
		</div>
		<div class="mb-3">
		  <label for="soyad" class="form-label">Soyadınız</label>
		  <input type="text" class="form-control" id="soyad" name="soyad" placeholder="Soyadınız"/>
		</div>
		<div class="mb-3">
		  <label for="email" class="form-label">Mail Adresiniz</label>
		  <input type="email" class="form-control" id="email" name="email" placeholder="mail@adresiniz.com"/> 
		</div>
		<div class="mb-3">
		  <label for="password" class="form-label">Şifrenizi Giriniz</label>
		  <input type="password" class="form-control" id="password" name="password" placeholder="Şifre Giriniz"/> 
		</div>
		<button type="submit" name="register" class="btn btn-primary">Kayıt Ol</button>
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