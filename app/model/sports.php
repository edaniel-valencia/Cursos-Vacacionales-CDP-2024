<?php
require_once 'connection.php';

class SportModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllSport()
    {
        $sql = "SELECT * FROM sports";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function countAllSport()
    {
        $sql = "SELECT count(*) FROM sports";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count(*)'];
        } else {
            return 0;
        }
    }

    public function countSport()
    {
        $sql = "SELECT COUNT(*) AS total FROM sports";
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

    public function getSportPagination($start, $itemsPage)
    {
        $sql = "SELECT * FROM sports ORDER BY Sid ASC LIMIT ?, ?";
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

    public function searchSport($name)
    {
        $sql = "SELECT * FROM sports WHERE Sname LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $param = "%$name%";
        $stmt->bind_param("s", $param);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getByIdSport($id)
    {
        $sql = "SELECT count(*) as count FROM sports AS S INNER JOIN sports_hours AS SH ON SH.Sid = S.Sid WHERE SH.Sid = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'];
        } else {
            return 0;
        }
    }

    public function createSport($name, $description, $image)
    {
        $sql = "INSERT INTO sports (Sname, Sdescription, Simage, Sstatus, SdateCreated) VALUES (?, ?, ?, 1, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $name, $description, $image);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function uniqueName($name)
    {
        $sql = "SELECT COUNT(*) AS count FROM sports WHERE Sname = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['count'] == 1;
    }

    public function updateSport($id, $name, $description, $image, $status)
    {
        $sql = "UPDATE sports SET Sname=?, Sdescription=?, Sstatus=?, Simage=?, SdateUpdated=NOW() WHERE Sid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssisi", $name, $description, $status, $image, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function updateSportOutName($id, $description, $image, $status)
    {
        $sql = "UPDATE sports SET Sdescription=?, Sstatus=?, Simage=?, SdateUpdated=NOW() WHERE Sid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sisi", $description, $status, $image, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function deleteSport($id)
    {
        $sql = "DELETE FROM sports WHERE Sid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }
}
