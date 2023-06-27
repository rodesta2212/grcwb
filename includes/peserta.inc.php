<?php
class Peserta {
	private $conn;
    private $table_peserta = 'peserta';

    public $id_peserta;
    public $nama;
    public $tgl_lahir;
    public $foto;
    public $email;
	public $telp;
	public $jenis_kelamin;
	public $alamat;
	public $id_user;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_peserta} VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_peserta);
        $stmt->bindParam(2, $this->nama);
        $stmt->bindParam(3, $this->tgl_lahir);
        $stmt->bindParam(4, $this->foto);
        $stmt->bindParam(5, $this->email);
		$stmt->bindParam(6, $this->jenis_kelamin);
		$stmt->bindParam(7, $this->telp);
		$stmt->bindParam(8, $this->alamat);
		$stmt->bindParam(9, $this->id_user);

		if ($stmt->execute()) {
			return true;
		} else {
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

	function readAll() {
		$query = "SELECT id_peserta, nama, tgl_lahir, foto, email, telp, jenis_kelamin, alamat, id_user
		FROM {$this->table_peserta}
		ORDER BY id_peserta ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT id_peserta, nama, tgl_lahir, foto, email, telp, jenis_kelamin, alamat, id_user
		FROM {$this->table_peserta}
		WHERE id_peserta=:id_peserta LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_peserta', $this->id_peserta);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_peserta = $row['id_peserta'];
		$this->nama = $row['nama'];
		$this->tgl_lahir = $row['tgl_lahir'];
		$this->foto = $row['foto'];
		$this->email = $row['email'];
		$this->telp = $row['telp'];
		$this->jenis_kelamin = $row['jenis_kelamin'];
		$this->alamat = $row['alamat'];
		$this->id_user = $row['id_user'];
	}

	function update() {
		$query = "UPDATE {$this->table_peserta}
			SET
                id_peserta = :id_peserta,
				nama = :nama,
                tgl_lahir = :tgl_lahir,
                foto = :foto,
				email = :email,
				telp = :telp,
				jenis_kelamin = :jenis_kelamin,
				alamat = :alamat,
				id_user = :id_user
			WHERE
				id_peserta = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_peserta', $this->id_peserta);
		$stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':tgl_lahir', $this->tgl_lahir);
        $stmt->bindParam(':foto', $this->foto);
        $stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':telp', $this->telp);
		$stmt->bindParam(':jenis_kelamin', $this->jenis_kelamin);
		$stmt->bindParam(':alamat', $this->alamat);
		$stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':id', $this->id_peserta);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_peserta} WHERE id_peserta = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_peserta);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

}
