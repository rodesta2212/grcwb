<?php
class Testimoni {
	private $conn;
    private $table_testimoni = 'testimoni';
	private $table_peserta = 'peserta';
	private $table_pelatihan = 'pelatihan';

    public $id_testimoni;
    public $id_peserta;
    public $id_pelatihan;
    public $testimoni;
    public $tampil;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_testimoni} VALUES(?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_testimoni);
        $stmt->bindParam(2, $this->id_peserta);
        $stmt->bindParam(3, $this->id_pelatihan);
        $stmt->bindParam(4, $this->testimoni);
        $stmt->bindParam(5, $this->tampil);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_testimoni) AS code FROM {$this->table_testimoni}";
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
		$query = "SELECT id_testimoni, id_peserta, id_pelatihan, testimoni, tampil
		FROM {$this->table_testimoni}
		ORDER BY id_testimoni ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readIndex() {
		$query = "SELECT A.id_testimoni, A.id_peserta, A.id_pelatihan, A.testimoni, A.tampil,
		B.id_peserta, B.nama AS nama_peserta, B.tgl_lahir, B.email, B.telp, B.jenis_kelamin, B.alamat, B.foto, 
		C.id_pelatihan, C.nama AS nama_pelatihan, C.deskripsi AS deskripsi_pelatihan, C.tgl_mulai, C.tgl_selesai, C.gambar AS gambar_pelatihan
		FROM {$this->table_testimoni} A
		LEFT JOIN {$this->table_peserta} B ON A.id_peserta=B.id_peserta 
		LEFT JOIN {$this->table_pelatihan} C ON A.id_pelatihan=C.id_pelatihan 
		WHERE A.tampil = 'YES'
		ORDER BY RAND() limit 3";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readMenungguKorfirmasi() {
		$query = "SELECT A.id_testimoni, A.id_peserta, A.id_pelatihan, A.testimoni, A.tampil,
		B.id_peserta, B.nama AS nama_peserta, B.tgl_lahir, B.email, B.telp, B.jenis_kelamin, B.alamat, B.foto, 
		C.id_pelatihan, C.nama AS nama_pelatihan, C.deskripsi AS deskripsi_pelatihan, C.tgl_mulai, C.tgl_selesai, C.gambar AS gambar_pelatihan
		FROM {$this->table_testimoni} A
		LEFT JOIN {$this->table_peserta} B ON A.id_peserta=B.id_peserta 
		LEFT JOIN {$this->table_pelatihan} C ON A.id_pelatihan=C.id_pelatihan 
		WHERE A.tampil = 'NOT SET'
		ORDER BY A.id_testimoni ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT id_testimoni, id_peserta, id_pelatihan, testimoni, tampil
		FROM {$this->table_testimoni}
		WHERE id_testimoni=:id_testimoni LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_testimoni', $this->id_testimoni);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_testimoni = $row['id_testimoni'];
		$this->id_peserta = $row['id_peserta'];
		$this->id_pelatihan = $row['id_pelatihan'];
		$this->testimoni = $row['testimoni'];
		$this->tampil = $row['tampil'];
	}

	function update() {
		$query = "UPDATE {$this->table_testimoni}
			SET
                id_testimoni = :id_testimoni,
				id_peserta = :id_peserta,
                id_pelatihan = :id_pelatihan,
                testimoni = :testimoni,
				tampil = :tampil
			WHERE
				id_testimoni = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_testimoni', $this->id_testimoni);
		$stmt->bindParam(':id_peserta', $this->id_peserta);
        $stmt->bindParam(':id_pelatihan', $this->id_pelatihan);
        $stmt->bindParam(':testimoni', $this->testimoni);
        $stmt->bindParam(':tampil', $this->tampil);
        $stmt->bindParam(':id', $this->id_testimoni);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function updateTampil() {
		$query = "UPDATE {$this->table_testimoni}
			SET
                id_testimoni = :id_testimoni,
				id_peserta = :id_peserta,
                id_pelatihan = :id_pelatihan,
                testimoni = :testimoni,
				tampil = :tampil
			WHERE
				id_testimoni = :id_testimoni";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_testimoni', $this->id_testimoni);
		$stmt->bindParam(':id_peserta', $this->id_peserta);
        $stmt->bindParam(':id_pelatihan', $this->id_pelatihan);
        $stmt->bindParam(':testimoni', $this->testimoni);
        $stmt->bindParam(':tampil', $this->tampil);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_testimoni} WHERE id_testimoni = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_testimoni);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

}
