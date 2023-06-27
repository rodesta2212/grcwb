<?php
class Register {
    private $conn;
    private $table_peserta = 'peserta';

    public $id_peserta;
    public $nama;
    public $tgl_lahir;
    public $jenis_kelamin;
    public $telp;
    public $email;
    public $foto;
    public $alamat;
    public $id_user;

	public function __construct($db) {
		$this->conn = $db;
	}

    function insert() {
        $query = "INSERT INTO {$this->table_peserta} (id_peserta, id_user, nama, tgl_lahir, jenis_kelamin, telp, email, foto, alamat) VALUES(:id_peserta, :id_user, :nama, :tgl_lahir, :jenis_kelamin, :telp, :email, :foto, :alamat)";

        $stmt = $this->conn->prepare($query);
        // peserta
        $stmt->bindParam(':id_peserta', $this->id_peserta);
        $stmt->bindParam(':id_user', $this->id_user);
		$stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':tgl_lahir', $this->tgl_lahir);
        $stmt->bindParam(':jenis_kelamin', $this->jenis_kelamin);
        $stmt->bindParam(':telp', $this->telp);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':foto', $this->foto);
        $stmt->bindParam(':alamat', $this->alamat);

		if ($stmt->execute()) {
            // var_dump($stmt);
			return true;
		} else {
            // var_dump($this->tgl_lahir);
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_peserta) AS code FROM {$this->table_peserta}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '');
		} else {
			return $this->genCode($nomor_terakhir, '');
		}
	}

	function genCode($latest, $key, $chars = 0) {
    $new = intval(substr($latest, strlen($key))) + 1;
    $numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
    return $key . $numb;
	}

}
