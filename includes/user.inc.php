<?php
class User
{
    private $conn;
    private $table_name = "user";

    public $id;
    public $lvl;
    public $nl;
    public $un;
    public $pw;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function insert()
    {
        $query = "INSERT INTO " . $this->table_name . " VALUES(NULL, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->nl);
        $stmt->bindParam(2, $this->lvl);
        $stmt->bindParam(3, $this->un);
        $stmt->bindParam(4, $this->pw);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_user ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // used when filling up the update product form
    function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_user=? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id_user'];
        $this->nl = $row['nama_lengkap'];
        $this->lvl = $row['level'];
        $this->un = $row['username'];
        $this->pw = $row['password'];
    }

    // update the product
    function update()
    {
        $query = "UPDATE " . $this->table_name . "
				SET
					nama_lengkap = :nm,
					level = :lvl,
					username = :un,
					password = :ps
				WHERE
					id_user = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nm', $this->nl);
        $stmt->bindParam(':lvl', $this->lvl);
        $stmt->bindParam(':un', $this->un);
        $stmt->bindParam(':ps', $this->pw);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // delete the product
    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_user = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function countAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_user ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function hapusell($ax)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_user in $ax";
        $stmt = $this->conn->prepare($query);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
