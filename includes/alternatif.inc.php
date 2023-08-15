<?php
class Alternatif
{
	private $conn;
	private $table_name = "data_alternatif";

	public $id;
	public $nip;
	public $nama;
	public $tempat_lahir;
	public $tanggal_lahir;
	public $kelamin;
	public $alamat;
	public $email;
	public $pendidikan;
	public $hasil_akhir;
	public $skor_alternatif;

	public $periode;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	function insert()
	{
		$query = "INSERT INTO {$this->table_name} VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?,0)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->bindParam(2, $this->nip);
		$stmt->bindParam(3, $this->nama);
		$stmt->bindParam(4, $this->tempat_lahir);
		$stmt->bindParam(5, $this->tanggal_lahir);
		$stmt->bindParam(6, $this->kelamin);
		$stmt->bindParam(7, $this->alamat);
		$stmt->bindParam(8, $this->email);
		$stmt->bindParam(9, $this->pendidikan);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll()
	{
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_alternatif ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readByFilter()
	{
		$query = "SELECT * FROM {$this->table_name} a JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif WHERE b.keterangan='B'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function countByFilter()
	{
		$query = "SELECT * FROM {$this->table_name} a JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif WHERE b.keterangan='B' ";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readAllWithNilai()
	{
		$query = "SELECT *, b.nilai, b.keterangan
				FROM {$this->table_name} a
					JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif
				WHERE a.id_alternatif IN (SELECT id_alternatif FROM nilai_awal)
				ORDER BY a.id_alternatif";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readByRank()
	{
		$query = "SELECT *
				FROM {$this->table_name} a
					JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif
				WHERE b.keterangan='B'
					AND b.periode=?
				ORDER BY hasil_akhir DESC
				LIMIT 0,5";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->periode);
		$stmt->execute();

		return $stmt;
	}

	function countAll()
	{
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_alternatif ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readOne()
	{
		$query = "SELECT * FROM {$this->table_name} WHERE id_alternatif=? LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row["id_alternatif"];
		$this->nip = $row["nip"];
		$this->nama = $row["nama"];
		$this->tempat_lahir = $row["tempat_lahir"];
		$this->tanggal_lahir = $row["tanggal_lahir"];
		$this->kelamin = $row["kelamin"];
		$this->alamat = $row["alamat"];
		$this->email = $row["email"];
		$this->pendidikan = $row["pendidikan"];
		$this->hasil_akhir = $row["hasil_akhir"];
		// $this->skor_alternatif = $row['skor_alternatif'];
	}

	function readOneByNik()
	{
		$query = "SELECT * FROM {$this->table_name} WHERE nip=? LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->nip);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row["id_alternatif"];
		$this->nip = $row["nip"];
		$this->nama = $row["nama"];
		$this->tempat_lahir = $row["tempat_lahir"];
		$this->tanggal_lahir = $row["tanggal_lahir"];
		$this->kelamin = $row["kelamin"];
		$this->alamat = $row["alamat"];
		$this->email = $row["email"];
		$this->pendidikan = $row["pendidikan"];
		$this->hasil_akhir = $row["hasil_akhir"];
		// $this->skor_alternatif = $row['skor_alternatif'];
	}

	function readSatu($a)
	{
		$query = "SELECT * FROM {$this->table_name} WHERE id_alternatif='$a' LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function getNewID()
	{
		$query = "SELECT MAX(id_alternatif) AS code FROM {$this->table_name}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], 'A', 3);
		} else {
			return $this->genCode($nomor_terakhir, 'A', 3);
		}
	}

	function genCode($latest, $key, $chars = 0)
	{
		$new = intval(substr($latest, strlen($key))) + 1;
		$numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
		return $key . $numb;
	}

	function genNextCode($start, $key, $chars = 0)
	{
		$new = str_pad($start, $chars, "0", STR_PAD_LEFT);
		return $key . $new;
	}

	function update()
	{
		$query = "UPDATE {$this->table_name}
				SET
					nip = :nip,
					nama = :nama,
					tempat_lahir = :tempat_lahir,
					tanggal_lahir = :tanggal_lahir,
					kelamin = :kelamin,
					alamat = :alamat,
					email = :email,
					pendidikan = :pendidikan
				WHERE
					id_alternatif = :id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nip', $this->nip);
		$stmt->bindParam(':nama', $this->nama);
		$stmt->bindParam(':tempat_lahir', $this->tempat_lahir);
		$stmt->bindParam(':tanggal_lahir', $this->tanggal_lahir);
		$stmt->bindParam(':kelamin', $this->kelamin);
		$stmt->bindParam(':alamat', $this->alamat);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':pendidikan', $this->pendidikan);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete()
	{
		$query = "DELETE FROM {$this->table_name} WHERE id_alternatif = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function hapusell($ax)
	{
		$query = "DELETE FROM {$this->table_name} WHERE id_alternatif in $ax";
		$stmt = $this->conn->prepare($query);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
