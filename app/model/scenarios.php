<?php
require_once 'connection.php';

class SceneryModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllScenery()
    {
        $sql = "SELECT * FROM scenarios ORDER BY Ename ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function countAllScenery()
    {
        $sql = "SELECT COUNT(*) AS total FROM scenarios";
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

    public function countScenery()
    {
        $sql = "SELECT COUNT(*) AS total FROM scenarios";
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

    public function getSceneryPagination($start, $itemsPage)
    {
        $sql = "SELECT * FROM scenarios ORDER BY Eid ASC LIMIT ?, ?";
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

    public function searchScenery($name)
    {
        $name = "%$name%";
        $sql = "SELECT * FROM scenarios WHERE Ename LIKE ?";
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


    public function getByIdScenery($id)
    {
        $sql = "SELECT count(*) as count FROM scenarios as E
            INNER JOIN courses as C ON C.Eid = E.Eid
            WHERE C.Eid = ?";
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

    public function createScenery($name)
    {
        $query = "INSERT INTO scenarios (Ename,  Estatus, EdateCreated) 
            VALUES (?, 1, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $name );
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function uniqueName($name)
    {
        $sql = "SELECT COUNT(*) AS count FROM scenarios WHERE Ename = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['count'] == 1;
    }

    public function updateScenery($id, $name, $status)
    {
        $query = "UPDATE scenarios SET Ename=?, Estatus=?, EdateUpdated=NOW() WHERE Eid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $name,  $status, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function updateSceneryOutName($id, $name,  $status)
    {
        $query = "UPDATE scenarios SET Ename=?, Estatus=?, EdateUpdated=NOW() WHERE Eid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sii", $name, $status, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function deleteScenery($id)
    {
        $query = "DELETE FROM scenarios WHERE Eid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }
}
