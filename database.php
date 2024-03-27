<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "sifrecokuzunolacak";
    private $dbname = "nototomasyon";
    private $conn;

    // Veritabanı bağlantısını kurma
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Bağlantı hatası kontrolü
        if ($this->conn->connect_error) {
            die("Veritabanı bağlantı hatası: " . $this->conn->connect_error);
        }
    }

    // Kullanıcı ekleme
    public function addUser($ad, $soyad, $email, $password) {
        // Şifreyi hashleme
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Veritabanına kullanıcı ekleme sorgusu
        $sql = "INSERT INTO users (ad, soyad, email, password) VALUES ('$ad', '$soyad', '$email', '$hashed_password')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
	
	// Kullanıcı doğrulama
    public function authenticateUser($email, $password) {
        // Kullanıcıyı e-posta adresine göre sorgula
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Parolayı doğrula
            if (password_verify($password, $row['password'])) {
                return true;
            }
        }
        return false;
    }
	
	// Kullanıcı bilgisi alma
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
	
	public function addStudent($ad, $soyad, $ogrenci_no) {
        $sql = "INSERT INTO ogrenciler (ad, soyad, ogrenci_no) VALUES ('$ad', '$soyad', '$ogrenci_no')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Öğrenci bilgisi güncelleme
    public function updateStudent($id, $ad, $soyad, $ogrenci_no) {
        $sql = "UPDATE ogrenciler SET ad='$ad', soyad='$soyad', ogrenci_no='$ogrenci_no' WHERE id=$id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Öğrenci silme
    public function deleteStudent($id) {
        $sql = "DELETE FROM ogrenciler WHERE id=$id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Tüm öğrencileri getirme
    public function getAllStudents() {
        $sql = "SELECT * FROM ogrenciler";
        $result = $this->conn->query($sql);
        $ogrenciler = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $ogrenciler[] = $row;
            }
        }

        return $ogrenciler;
    }

    // Belirli bir öğrenciyi getirme
    public function getStudentById($id) {
        $sql = "SELECT * FROM ogrenciler WHERE id=$id";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
	
	// Öğrenci notu ekleme
    public function addStudentGrade($ogrenci_no, $ders_adi, $donem, $ders_notu) {
        $sql = "INSERT INTO ogrenci_notlari (ogrenci_no, ders_adi, donem, ders_notu) VALUES ('$ogrenci_no', '$ders_adi', '$donem', '$ders_notu')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Öğrenci notu güncelleme
    public function updateStudentGrade($id, $ders_adi, $donem, $ders_notu) {
        $sql = "UPDATE ogrenci_notlari SET ders_adi='$ders_adi', donem='$donem', ders_notu='$ders_notu' WHERE id=$id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Öğrenci notu silme
    public function deleteStudentGrade($id) {
        $sql = "DELETE FROM ogrenci_notlari WHERE id=$id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Tüm öğrenci notlarını getirme
    public function getAllStudentGrades() {
        $sql = "SELECT * FROM ogrenci_notlari";
        $result = $this->conn->query($sql);
        $grades = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $grades[] = $row;
            }
        }

        return $grades;
    }

    // Belirli bir öğrenci notunu getirme
    public function getStudentGradeById($id) {
        $sql = "SELECT * FROM ogrenci_notlari WHERE id=$id";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
	
	public function getOrtalama($ogrenci_no){
		$sql = "SELECT AVG(ders_notu) as ortalama FROM ogrenci_notlari where ogrenci_no='$ogrenci_no'";
		$result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
	}


    // Bağlantıyı kapatma
    public function closeConnection() {
        $this->conn->close();
    }
}
?>