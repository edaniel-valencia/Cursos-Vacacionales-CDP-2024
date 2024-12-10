<?php
require_once 'connection.php';

class PermissionModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getAllPermissions()
    {
        $sql = "SELECT * FROM `permissions` ORDER BY Pid ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function countPermissions()
    {
        $sql = "SELECT COUNT(*) AS total FROM `permissions`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0; // Devuelve 0 si no se pueden obtener resultados
        }
    }

    public function getPermissionsPagination($start, $itemPage)
    {
        $sql = "SELECT * FROM `permissions` ORDER BY Pid ASC LIMIT ?, ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $start, $itemPage);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function searchPermissions($name)
    {
        $sql = "SELECT * FROM `permissions` WHERE Pname LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $param = "%$name%";
        $stmt->bind_param("s", $param);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }


    public function getByIdPermission($id)
    {
        // Consulta SQL con marcador de posición de parámetro
        $sql = "SELECT COUNT(*) FROM permissions as P
                INNER JOIN roles_permissions as RP ON P.Pid = RP.Pid	
                WHERE RP.Pid = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $data;
        } else {
            return false;
        }
    }

    public function createPermission($name)
    {
        $sql = "INSERT INTO permissions (Pname, Pstatus, PdateCreated) VALUES (?, 1, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $response = $stmt->execute();

        if ($response) {
            $sqlRid = "SELECT * FROM permissions ORDER BY Pid DESC LIMIT 1";
            $responseRid = $this->conn->query($sqlRid);
            if ($responseRid) {
                $row = $responseRid->fetch_assoc();
                $Pid = $row['Pid'];
                $Rid = $_SESSION['Rid'];
                $sqlInsert = "INSERT INTO roles_permissions (Rid, Pid, RPstatus, RPdateUpdated) VALUES (?, ?, 1, NOW())";
                $stmtInsert = $this->conn->prepare($sqlInsert);
                $stmtInsert->bind_param("ii", $Rid, $Pid);
                $responseInsert = $stmtInsert->execute();
                return $responseInsert;
            } else {
                return false; // Si la consulta SELECT falla
            }
        } else {
            return false; // Si la consulta INSERT falla
        }
    }

    public function uniqueName($name)
    {
        $sql = "SELECT COUNT(*) AS count FROM permissions WHERE Pname = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] == 1;
    }

    public function updatePermission($id, $name, $status)
    {
        $sql = "UPDATE permissions SET Pname=?, Pstatus=? WHERE Pid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sii", $name, $status, $id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function deletePermission($id)
    {
        $sql = "DELETE FROM permissions WHERE Pid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function updateStatusPermission($id, $status)
    {
        $sql = "UPDATE permissions SET Pstatus=? WHERE Pid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $status, $id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }
}
