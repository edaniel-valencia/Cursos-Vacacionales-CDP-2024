<?php
require_once 'connection.php';

class KitModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllKit()
    {
        $sql = "SELECT * FROM kits ORDER BY KdateCreated DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function countAllKit()
    {
        $sql = "SELECT COUNT(*) AS total FROM kits";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }

    public function countKit()
    {
        $sql = "SELECT COUNT(*) AS total FROM kits";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }

    public function getKitPagination($start, $itemsPage)
    {
        $sql = "SELECT * FROM kits ORDER BY Kid ASC LIMIT ?, ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $start, $itemsPage);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function searchKit($name)
    {
        $name = "%$name%";
        $sql = "SELECT * FROM kits WHERE Kname LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }


    public function getByIdKit($id)
    {
        $sql = "SELECT count(*) as count FROM kits as K
            INNER JOIN courses as C ON C.Kid = K.Kid
            WHERE C.Kid = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'];
        }
        return 0;
    }

    public function createKit($name)
    {
        $query = "INSERT INTO kits (Kname,  Kstatus, KdateCreated) 
            VALUES (?, 1, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $name );
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function uniqueName($name)
    {
        $sql = "SELECT COUNT(*) AS count FROM kits WHERE Kname = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['count'] == 1;
    }

    public function updateKit($id, $name, $status)
    {
        $query = "UPDATE kits SET Kname=?, Kstatus=?, KdateUpdated=NOW() WHERE Kid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $name,  $status, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function updateKitOutName($id, $name,  $status)
    {
        $query = "UPDATE kits SET Kname=?, Kstatus=?, KdateUpdated=NOW() WHERE Kid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sii", $name, $status, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function deleteKit($id)
    {
        $query = "DELETE FROM kits WHERE Kid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }
}
