<?php
require_once 'connection.php';

class ModuleModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllModule()
    {
        $sql = "SELECT * FROM modules WHERE Myear = YEAR(NOW()) ORDER BY MdateCreated DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function countAllModule()
    {
        $sql = "SELECT COUNT(*) AS total FROM modules";
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

    public function countModule()
    {
        $sql = "SELECT COUNT(*) AS total FROM modules";
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

    public function getModulePagination($start, $itemsPage)
    {
        $sql = "SELECT * FROM modules ORDER BY Mid ASC LIMIT ?, ?";
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

    public function searchModule($name)
    {
        $name = "%$name%";
        $sql = "SELECT * FROM modules WHERE Mname LIKE ?";
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


    public function getByIdModule($id)
    {
        $sql = "SELECT count(*) as count FROM modules as S
            INNER JOIN courses as C ON C.Mid = S.Mid
            WHERE C.Mid = ?";
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

    public function createModule($name, $description, $image, $Fstart, $Fend, $FIstart, $FIend)
    {
        $query = "INSERT INTO modules (Mname, Mdescription, Mimage, Mstart, Mend, MIstart, MIend, Myear, Mstatus, MdateCreated) 
            VALUES (?, ?, ?, ?, ?,?,?, YEAR(NOW()), 1, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssss", $name, $description, $image, $Fstart, $Fend, $FIstart, $FIend);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function uniqueName($name)
    {
        $sql = "SELECT COUNT(*) AS count FROM modules WHERE Mname = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['count'] == 1;
    }

    public function updateModule($id, $name, $description, $image, $start, $end, $FIstart, $FIend, $status)
    {
        $query = "UPDATE modules SET Mname=?, Mdescription=?, Mimage=?, Mstart=?, Mend=?,  MIstart=?, MIend=?, Mstatus=?, MdateUpdated=NOW() WHERE Mid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssssi", $name, $description, $image, $start, $end, $FIstart, $FIend, $status, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function updateModuleOutName($id, $name, $description, $start, $end, $FIstart, $FIend, $status)
    {
        $query = "UPDATE modules SET Mname=?, Mdescription=?, Mstart=?, Mend=?,  MIstart=?, MIend=?, Mstatus=?, MdateUpdated=NOW() WHERE Mid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssii", $name, $description, $start, $end, $FIstart, $FIend, $status, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function deleteModule($id)
    {
        $query = "DELETE FROM modules WHERE Mid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }
}
