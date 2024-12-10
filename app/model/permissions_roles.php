<?php
require_once 'connection.php';

class PermissionRoleModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllPermissionsRoles()
    {
        $sql = "SELECT DISTINCT P.Pname, R.Rname, R.Rid, P.Pid,  P.Pstatus, R.Rstatus
            FROM permissions AS P
            INNER JOIN roles_permissions AS RP ON P.Pid = RP.Pid
            INNER JOIN roles AS R ON RP.Rid = R.Rid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function getRolesAndPermissions()
    {
        $query = "SELECT P.Pname, R.Rname, R.Rid, P.Pid, RP.Rid as RoleId, RP.Pid as PermisoId, RP.*,  P.Pstatus, R.Rstatus 
                  FROM permissions AS P 
                  INNER JOIN roles_permissions AS RP ON P.Pid = RP.Pid 
                  INNER JOIN roles AS R ON RP.Rid = R.Rid
                  WHERE RP.RPstatus = ?";

        $stmt = $this->conn->prepare($query);
        $status = 1; // El valor de RPstatus que deseas buscar
        $stmt->bind_param("i", $status);
        $stmt->execute();
        $result = $stmt->get_result();

        $rolesAndPermissions = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $permiso = [
                    'Pname' => $row['Pname'],
                    'Pid' => $row['Pid'],
                    'Pstatus' => $row['Pstatus'],
                    'Rname' => $row['Rname'],
                    'Rid' => $row['Rid'],
                    'Rstatus' => $row['Rstatus'],
                    'Rid' => $row['Rid'],
                    'RPstatus' => $row['RPstatus']
                ];

                // Utiliza el campo correcto para indexar la matriz
                $index = isset($row['RoleId']) ? $row['RoleId'] : $row['Rid'];

                if (!isset($rolesAndPermissions[$index])) {
                    $rolesAndPermissions[$index] = [
                        'Rid' => $index, // Asegúrate de que el índice contenga el atributo Rid
                        'Pname' => $row['Pname'],
                        'Pid' => $row['Pid'],
                        'Pstatus' => $row['Pstatus'],
                        'Rname' => $row['Rname'],
                        'Rstatus' => $row['Rstatus'],
                        'RPstatus' => $row['RPstatus'],
                        'Permisos' => []
                    ];
                }

                $rolesAndPermissions[$index]['Permisos'][] = $permiso;
            }
        }

        return $rolesAndPermissions;
    }


    public function updatePermission($rid, $pid, $valor)
    {
        $sql = "SELECT COUNT(*) AS count FROM roles_permissions WHERE (Rid = ? AND Pid = ?) AND (RPStatus = 1 OR RPStatus = 0)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $rid, $pid);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count > 0) {
            $query = "UPDATE roles_permissions SET RPstatus = ?, RPdateUpdated = NOW() WHERE Rid = ? AND Pid = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("iii", $valor, $rid, $pid);
        } else {
            $query = "INSERT INTO roles_permissions (Rid, Pid, RPstatus, RPdateUpdated) VALUES (?, ?, ?, NOW())";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("iii", $rid, $pid, $valor);
        }

        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function procesarPermisos($permisos)
    {
        foreach ($permisos as $pid => $roles) {
            foreach ($roles as $rid => $valor) {
                $checked = isset($valor) ? 1 : 0;
                $sql = "INSERT INTO roles_permissions (Rid, Pid, RPdateCreated, RPdateUpdated) VALUES (?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE RPdateUpdated = CURRENT_TIMESTAMP";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("ii", $rid, $pid);
                $stmt->execute();
                $stmt->close();
            }
        }
        return true;
    }


    public function createPermissionRole($name)
    {
        $query = "INSERT INTO permissions (Pname, Pstatus, PdateCreated) VALUES (?, 1, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $name);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }


    public function uniqueName($name)
    {
        $sql = "SELECT COUNT(*) AS count FROM permissions WHERE Pname = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['count'] == 1;
    }
    public function updatePermissionRole($id, $name)
    {
        $query = "UPDATE permissions SET Pname = ? WHERE Pid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $name, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function deletePermissionRole($id)
    {
        $query = "DELETE FROM permissions WHERE Pid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }
    // public function updateStatusPermission($id, $status)
    // {
    //     $query = "UPDATE permissions SET Rstauts='$status' WHERE Pid=$id ";
    //     $response = $this->conn->query($query);
    //     return $response ? true : false;
    // }
}
