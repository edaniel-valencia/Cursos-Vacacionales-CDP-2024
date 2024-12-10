<?php
require_once 'connection.php';

class AuthenticateModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

   
    public function validationEmail($email)
    {
        $sql = "SELECT * FROM users AS U 
            INNER JOIN users_and_roles AS UAR ON U.Uid = UAR.Uid 
            WHERE Uemail = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }



    public function updateLockScreen($passwordHash, $Uid)
    {
        // Consulta de actualización
        $sql = "UPDATE users SET Upassword = ? WHERE Uid = ? AND Ustatus = 1";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            error_log('Error preparing statement: ' . $this->conn->error);
            return false;
        }

        $stmt->bind_param("si", $passwordHash, $Uid);

        if ($stmt->execute() === false) {
            error_log('Error executing statement: ' . $stmt->error);
            $stmt->close();
            return false;
        }

        // Verificar si alguna fila fue afectada
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true; // La actualización fue exitosa
        } else {
            $stmt->close();
            return false; // No se actualizó ninguna fila
        }
    }



    public function checkEmail($email)
    {
        $sql = "SELECT * FROM users WHERE Uemail = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function loginHistory($email)
    {
        $sql = "SELECT Uid FROM users WHERE Uemail = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result && $result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            $Uid = $userData['Uid'];

            $query = "INSERT INTO login_history (Uid, LHloginTime) VALUES (?, NOW())";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $Uid);
            $responseLH = $stmt->execute();
            $stmt->close();

            return $responseLH ? true : false;
        }
    }

    public function signin($email, $password)
    {
        $sql = "SELECT 
                users.*,
                roles.*,
                subquery.RoleIds,
                subquery.Permissions,
                GROUP_CONCAT(DISTINCT roles.Rname) AS RoleNames,
                GROUP_CONCAT(DISTINCT roles.Rid) AS RoleId
                    FROM users
                    INNER JOIN (
                        SELECT 
                            users.Uid,
                            GROUP_CONCAT(DISTINCT roles.Rid) AS RoleIds, 
                            GROUP_CONCAT(DISTINCT permissions.Pname) AS Permissions
                        FROM 
                            users
                            LEFT JOIN users_and_roles ON users.Uid = users_and_roles.Uid 
                            LEFT JOIN roles ON users_and_roles.Rid = roles.Rid
                            LEFT JOIN roles_permissions ON roles.Rid = roles_permissions.Rid
                            LEFT JOIN permissions ON roles_permissions.Pid = permissions.Pid
                        WHERE 
                            users.Uemail = ?
                        GROUP BY users.Uid
                    ) AS subquery ON users.Uid = subquery.Uid
            LEFT JOIN users_and_roles ON users.Uid = users_and_roles.Uid
            LEFT JOIN roles ON users_and_roles.Rid = roles.Rid
            GROUP BY users.Uid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['Upassword'])) {
                return $user;
            }
        }
        return null; // Si no se encuentra el usuario o la contraseña es incorrecta
    }

    public function routesPermmisionsRole($permission_roleId)
    {
        $routes = array();
        $sql = "SELECT RP.Rid, RP.Rid, P.Pname, P.Pdescription
    FROM roles_permissions  AS RP
    JOIN permissions AS P ON RP.Pid = P.Pid 
    WHERE Rid = ? AND RP.RPstatus = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $permission_roleId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $routes[] = $row['Pname'];
                $routes[] = $row['Rid'];
            }
        }
        return $routes;
    }

    public function userIdRole($userId_role)
    {
        $sql = "SELECT  R.*
    FROM users AS U
    INNER JOIN users_and_roles AS UAR ON U.Uid = UAR.Uid
    INNER JOIN roles AS R ON R.Rid = UAR.Rid
    WHERE U.Uid = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId_role);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result) {
            // Verifica si se encontraron roles para el usuario
            if ($result->num_rows > 0) {
                $roleData = $result->fetch_all(MYSQLI_ASSOC);
                return $roleData;
            } else {
                // No se encontraron roles para el usuario
                return null;
            }
        } else {
            // Manejar el error de consulta
            echo "Error en la consulta: " . mysqli_error($this->conn);
            return null;
        }
    }

    public function getAllRoles()
    {
        $sql = "SELECT * FROM roles";
        $response =  mysqli_query($this->conn, $sql);;

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }
}
