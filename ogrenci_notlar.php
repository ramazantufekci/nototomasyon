<?php
include_once('database.php');
session_start();
if(!isset($_SESSION['role']))
{
	header('location:/index.php');
}
$db = new Database();
$grades = $db->getAllStudentGrades();

if (isset($_POST['ekle'])) {
    $ogrenci_no = $_POST['ogrenci_no'];
    $ders_adi = $_POST['ders_adi'];
    $donem = $_POST['donem'];
    $ders_notu = $_POST['ders_notu'];

    $db->addStudentGrade($ogrenci_no, $ders_adi, $donem,$ders_notu);
}

if(isset($_POST['guncelle'])){
	$id = $_POST['id'];
    $ders_adi = $_POST['ders_adi'];
    $donem = $_POST['donem'];
    $ders_notu = $_POST['ders_notu'];

    $db->updateStudentGrade($id, $ders_adi, $donem,$ders_notu);
}

if(isset($_POST['delete'])){
	$id = $_POST['id'];
	$db->deleteStudentGrade($id);
}

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Yönetimi</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">Not Ekle</button>
            <a class="btn btn-danger float-right" href="/cikis.php">Oturumu Kapat</a>
        </div>
    </div>
    <div class="row">
        
        <div class="col-md-12">
            <h2 class="text-center">Öğrenci Not Listesi</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Öğrenci No</th>
                        <th>Ders Adı</th>
                        <th>Dönem</th>
                        <th>Not</th>
						<th>Ortalama</th>
                        <th>Durum</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grades as $grade): ?>
                        <tr>
                            <td><?php echo $grade['ogrenci_no']; ?></td>
                            <td><?php echo $grade['ders_adi']; ?></td>
                            <td><?php echo $grade['donem']; ?></td>
                            <td><?php echo $grade['ders_notu']; ?></td>
							<td><?php echo $db->getOrtalama($grade['ogrenci_no'])['ortalama']; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?php echo $grade['id']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm">Sil</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?php echo $grade['id']; ?>">Düzenle</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="diallog" aria-labelledby="addModalLabel" aria-hedden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="addModalLabel">Öğrenci Not Ekranı</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
            <form method="post">
			<div class="modal-body">
                <div class="form-group">
                    <input type="text" name="ogrenci_no" class="form-control" placeholder="Öğrenci No" required>
                </div>
                <div class="form-group">
                    <input type="text" name="ders_adi" class="form-control" placeholder="Ders Adı" required>
                </div>
                <div class="form-group">
                    <input type="text" name="donem" class="form-control" placeholder="Dönem" required>
                </div>
				<div class="form-group">
                    <input type="text" name="ders_notu" class="form-control" placeholder="Not" required>
                </div>
			</div>
                
			<div class="modal-footer">
                <button type="submit" name="ekle" class="btn btn-primary">Not Ekle</button>
			</div>
            </form>
        </div>
	</div>
</div>	
<!-- Edit Modal -->
<?php foreach ($grades as $grade): ?>
    <div class="modal fade" id="editModal<?php echo $grade['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $grade['id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?php echo $grade['id']; ?>">Öğrenci Notunu Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $grade['id']; ?>">
                        <div class="form-group">
                            <input type="text" name="ogrenci_no" class="form-control" placeholder="Öğrenci No" value="<?php echo $grade['ogrenci_no']; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="ders_adi" class="form-control" placeholder="Ders Adı" value="<?php echo $grade['ders_adi']; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="donem" class="form-control" placeholder="Dönem" value="<?php echo $grade['donem']; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="ders_notu" class="form-control" placeholder="Ders Notu" value="<?php echo $grade['ders_notu']; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <button type="submit" name="guncelle" class="btn btn-primary">Değişikliği Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>