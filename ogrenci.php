<?php
require_once('database.php');
session_start();
if(!isset($_SESSION['role']))
{
	header('location:/index.php');
}
$db = new Database();

// CRUD işlemleri
if (isset($_POST['ekle'])) {
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $ogrenci_no = $_POST['ogrenci_no'];

    $db->addStudent($ad, $soyad, $ogrenci_no);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $ogrenci_no = $_POST['ogrenci_no'];

    $db->updateStudent($id, $ad, $soyad, $ogrenci_no);
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $db->deleteStudent($id);
}

$ogrenciler = $db->getAllStudents();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci İşlemleri</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary" href="/ogrenci_notlar.php">Not Gir</a>
            <a class="btn btn-danger float-right" href="/cikis.php">Oturumu Kapat</a>
        </div>
    </div>
    <div class="row">
        
        <div class="col-md-6">
            <h2>Öğrenci Ekle</h2>
            <form method="post" action="ogrenci.php">
                <div class="form-group">
                    <input type="text" name="ad" class="form-control" placeholder="Ad" required>
                </div>
                <div class="form-group">
                    <input type="text" name="soyad" class="form-control" placeholder="Soyad" required>
                </div>
                <div class="form-group">
                    <input type="text" name="ogrenci_no" class="form-control" placeholder="Öğrenci Numarası" required>
                </div>
                <button type="submit" name="ekle" class="btn btn-primary">Ekle</button>
            </form>
        </div>
        <div class="col-md-6">
            <h2>Öğrenci Listesi</h2>
            <ul class="list-group">
                <?php foreach ($ogrenciler as $ogrenci): ?>
                    <li class="list-group-item">
                        <?php echo $ogrenci['ad'] . ' ' . $ogrenci['soyad'] . ' (' . $ogrenci['ogrenci_no'] . ')' ?>
                        <form method="post" class="float-right">
                            <input type="hidden" name="id" value="<?php echo $ogrenci['id'] ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm mr-2">Sil</button>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?php echo $ogrenci['id'] ?>">Düzenle</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<?php foreach ($ogrenciler as $ogrenci): ?>
    <div class="modal fade" id="editModal<?php echo $ogrenci['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $ogrenci['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?php echo $ogrenci['id'] ?>">Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $ogrenci['id'] ?>">
                        <div class="form-group">
                            <input type="text" name="ad" class="form-control" placeholder="Adınız" value="<?php echo $ogrenci['ad'] ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="soyad" class="form-control" placeholder="Soyadınız" value="<?php echo $ogrenci['soyad'] ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="ogrenci_no" class="form-control" placeholder="Öğrenci Numarası" value="<?php echo $ogrenci['ogrenci_no'] ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <button type="submit" name="update" class="btn btn-primary">Değişiklikleri Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach;?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>