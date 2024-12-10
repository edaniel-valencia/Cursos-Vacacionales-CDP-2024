<?php
require_once 'connection.php';

class RoleModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllRoles()
    {
        $sql = "SELECT * FROM roles";
        $response =  $this->conn->query($sql);
    
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }
    
    public function getCountAllRoles()
    {
        $sql = "SELECT COUNT(*) as count FROM roles";
        $response =  $this->conn->query($sql);
        if ($response) {
            $row = $response->fetch_assoc();
            return $row['count'];
        } else {
            return 0;
        }
    }
    
    public function getCountAllRolesC()
    {
        $sql = "SELECT COUNT(*) as count FROM roles WHERE Rid = 6";
        $response =  $this->conn->query($sql);
        if ($response) {
            $row = $response->fetch_assoc();
            return $row['count'];
        } else {
            return 0;
        }
    }
    
    public function getByIdRole($id)
    {
        $sql = "SELECT COUNT(*) as count FROM roles as R
        INNER JOIN users_and_roles as UR
        ON R.Rid = UR.Rid
        where R.Rid = ?";
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
    
    // INICIO DE PAGINACION
    
    public function countRole()
    {
        $sql = "SELECT COUNT(*) AS total FROM roles";
        $result = $this->conn->query($sql);
    
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0; // Devuelve 0 si no se pueden obtener resultados
        }
    }
    
    public function getRolePagination($start, $itemPage)
    {
        $sql = "SELECT * FROM roles ORDER BY Rid ASC LIMIT ?, ?";
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
    
    public function searchRole($name)
    {
        $sql = "SELECT * FROM roles WHERE Rname LIKE ?";
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
    
    // FIN DE PAGINACION
    
    public function createRoles($name)
    {
        $sql = "INSERT INTO roles (Rname,  Rstatus, RdateCreated) VALUES (?,  1, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }
    
    public function uniqueName($name)
    {
        $sql = "SELECT COUNT(*) AS count FROM roles WHERE Rname = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['count'] == 1;
    }
    
    public function updateRole($id, $name, $status)
    {
        $sql = "UPDATE roles SET Rname=?, Rstatus=? WHERE Rid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sii", $name, $status, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }
    
    public function deleteRole($id)
    {
        $sql = "DELETE FROM roles WHERE Rid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }
    
    public function updateStatusRole($id, $status)
    {
        $sql = "UPDATE roles SET Rstatus=? WHERE Rid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $status, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }
    
}
