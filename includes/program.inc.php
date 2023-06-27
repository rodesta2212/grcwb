<?php
class Program {
	private $conn;
    private $table_program = 'program';

    public $id_program;
    public $nama;
    public $deskripsi;
    public $jam_mulai;
    public $jam_selesai;
	public $gambar;
	public $biaya;
	public $senin;
	public $selasa;
	public $rabu;
	public $kamis;
	public $jumat;
	public $sabtu;
	public $minggu;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_program} VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_program);
        $stmt->bindParam(2, $this->nama);
        $stmt->bindParam(3, $this->deskripsi);
        $stmt->bindParam(4, $this->jam_mulai);
        $stmt->bindParam(5, $this->jam_selesai);
		$stmt->bindParam(6, $this->biaya);
		$stmt->bindParam(7, $this->gambar);
		$stmt->bindParam(8, $this->senin);
		$stmt->bindParam(9, $this->selasa);
		$stmt->bindParam(10, $this->rabu);
		$stmt->bindParam(11, $this->kamis);
		$stmt->bindParam(12, $this->jumat);
		$stmt->bindParam(13, $this->sabtu);
		$stmt->bindParam(14, $this->minggu);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_program) AS code FROM {$this->table_program}";
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
		$query = "SELECT id_program, nama, deskripsi, jam_mulai, jam_selesai, gambar, biaya, senin, selasa, rabu, kamis, jumat, sabtu, minggu
		FROM {$this->table_program}
		ORDER BY id_program ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readActive() {
		$query = "SELECT id_program, nama, deskripsi, jam_mulai, jam_selesai, gambar, biaya, senin, selasa, rabu, kamis, jumat, sabtu, minggu
		FROM {$this->table_program}
		ORDER BY id_program ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT id_program, nama, deskripsi, jam_mulai, jam_selesai, gambar, biaya, senin, selasa, rabu, kamis, jumat, sabtu, minggu
		FROM {$this->table_program}
		WHERE id_program=:id_program LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_program', $this->id_program);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_program = $row['id_program'];
		$this->nama = $row['nama'];
		$this->deskripsi = $row['deskripsi'];
		$this->jam_mulai = $row['jam_mulai'];
		$this->jam_selesai = $row['jam_selesai'];
		$this->gambar = $row['gambar'];
		$this->biaya = $row['biaya'];
		$this->senin = $row['senin'];
		$this->selasa = $row['selasa'];
		$this->rabu = $row['rabu'];
		$this->kamis = $row['kamis'];
		$this->jumat = $row['jumat'];
		$this->sabtu = $row['sabtu'];
		$this->minggu = $row['minggu'];
	}

	function update() {
		$query = "UPDATE {$this->table_program}
			SET
                id_program = :id_program,
				nama = :nama,
                deskripsi = :deskripsi,
                jam_mulai = :jam_mulai,
				jam_selesai = :jam_selesai,
				gambar = :gambar,
				biaya = :biaya,
				senin = :senin,
				selasa = :selasa,
				rabu = :rabu,
				kamis = :kamis,
				jumat = :jumat,
				sabtu = :sabtu,
				minggu = :minggu
			WHERE
				id_program = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_program', $this->id_program);
		$stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':deskripsi', $this->deskripsi);
        $stmt->bindParam(':jam_mulai', $this->jam_mulai);
        $stmt->bindParam(':jam_selesai', $this->jam_selesai);
		$stmt->bindParam(':gambar', $this->gambar);
		$stmt->bindParam(':biaya', $this->biaya);
		$stmt->bindParam(':senin', $this->senin);
		$stmt->bindParam(':selasa', $this->selasa);
		$stmt->bindParam(':rabu', $this->rabu);
		$stmt->bindParam(':kamis', $this->kamis);
		$stmt->bindParam(':jumat', $this->jumat);
		$stmt->bindParam(':sabtu', $this->sabtu);
		$stmt->bindParam(':minggu', $this->minggu);
        $stmt->bindParam(':id', $this->id_program);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_program} WHERE id_program = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_program);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

}
