<?php
require_once 'connection.php';

class UserModel
{

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllUsers()
    {
        $sql = "SELECT U.*, R.* FROM users AS U
        INNER JOIN users_and_roles AS UAR 
            ON U.Uid = UAR.Uid
        INNER JOIN roles AS R
            ON R.Rid = UAR.Rid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }
    public function getAllUsersPOS()
    {
        $sql = "SELECT U.*, R.* FROM users AS U
        INNER JOIN users_and_roles AS UAR 
            ON U.Uid = UAR.Uid
        INNER JOIN roles AS R
            ON R.Rid = UAR.Rid 
            WHERE R.Rid = 6";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function getCountAllUsers()
    {
        $sql = "SELECT count(*) AS total FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0; // Devuelve 0 si no se pueden obtener resultados
        }
    }
    

    // public function getCountAllRoles()
    // {
    //     $sql = "SELECT count(*) FROM roles";
    //     $response =  mysqli_query($this->conn, $sql);;
    //     if ($response) {
    //         return $response->fetch_all(MYSQLI_ASSOC);
    //     }
    // }


    public function getByIdUserRole($id)
    {
        $sql = "SELECT COUNT(*) as count FROM users AS U
        INNER JOIN users_and_roles AS UAR   ON U.Uid = UAR.Uid
        INNER JOIN roles AS R               ON R.Rid = UAR.Rid
    WHERE U.Uid = ?";
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

    public function getUserById($userId)
    {
        $sql = "SELECT U.*, R.* FROM users AS U
        INNER JOIN users_and_roles AS UAR 
            ON U.Uid = UAR.Uid
        INNER JOIN roles AS R
            ON R.Rid = UAR.Rid
    WHERE U.Uid = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            $result->close();
            return $userData;
        } else {
            return null;
        }
    }
    public function getDataUserId($userId)
    {
        $sql = "SELECT U.*, R.* FROM users AS U
        INNER JOIN users_and_roles AS UAR 
            ON U.Uid = UAR.Uid
        INNER JOIN roles AS R
            ON R.Rid = UAR.Rid
    WHERE U.Uid = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            $result->close();
            return $userData;
        } else {
            return null;
        }
    }

    public function countUser()
    {
        $sql = "SELECT COUNT(*) AS total FROM users";
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


    public function countUserPOS()
    {
        $sql = "SELECT COUNT(*) AS total FROM 
        users AS U
        INNER JOIN users_and_roles AS UR ON U.Uid = UR.Uid
        INNER JOIN roles AS R ON R.Rid = UR.Rid 
    WHERE R.Rid = 6 ";
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

    public function getUserPagination($start, $itemsPage)
    {
        $sql = "SELECT * FROM users ORDER BY Uid ASC LIMIT ?, ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $start, $itemsPage);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function searchUser($search)
    {
        $searchTerm = "%$search%";
        $sql = "SELECT U.*, R.* FROM 
            users AS U
            INNER JOIN users_and_roles AS UR ON U.Uid = UR.Uid
            INNER JOIN roles AS R ON R.Rid = UR.Rid 
        WHERE U.Uname LIKE ? OR U.Ucredential LIKE ? OR U.Ulastname LIKE ? OR U.Uemail LIKE ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();
    
        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }
    

    public function searchUserPOS($search)
    {
        $searchTerm = "%$search%";
        $sql = "SELECT U.*, R.* FROM 
            users AS U
            INNER JOIN users_and_roles AS UR ON U.Uid = UR.Uid
            INNER JOIN roles AS R ON R.Rid = UR.Rid 
        WHERE U.Uname LIKE ? OR U.Ucredential LIKE ? OR U.Ulastname LIKE ? OR U.Uemail LIKE ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }



    public function createUsers(
        $name,
        $lastname,
        $credential,
        $birthdate,
        $gender,
        $city,
        $address,
        $nickname,
        $email,
        $passwordHash,
        $whatsapp,
        $facebook,
        $tiktok,
        $nameImage,
        $size,
        $blood
    ) {
        $query = "INSERT INTO users 
        (Uname, Ulastname, Ucredential, Ubirthdate, Ugender, Ucity, Uaddress, Unickname, Uemail, Upassword, Uwhatsapp, Ufacebook, Utiktok, Uimage, Usize, Ublood, Ustatus, UdateCreated) VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssssssssssss", $name, $lastname, $credential, $birthdate, $gender, $city, $address, $nickname, $email, $passwordHash, $whatsapp, $facebook, $tiktok, $nameImage, $size, $blood);
        $response = $stmt->execute();
        $userId = $stmt->insert_id;
        $stmt->close();
        return $response ? $userId : false;
    }

    public function createUsersPOS(
        $name,
        $lastname,
        $credential,
        $birthdate,
        $gender,
        $city,
        $address,
        $email,
        $passwordHash,
        $whatsapp,
        $nameImage,
        $size,
        $blood
    ) {
        $query = "INSERT INTO users 
        (Uname, Ulastname, Ucredential, Ubirthdate, Ugender, Ucity, Uaddress, Uemail, Upassword, Uwhatsapp, Uimage, Usize, Ublood, Ustatus, UdateCreated) VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssssssssss", $name, $lastname, $credential, $birthdate, $gender, $city, $address, $email, $passwordHash, $whatsapp, $nameImage, $size, $blood);
        $response = $stmt->execute();
        $userId = $stmt->insert_id;
        $stmt->close();
        return $response ? $userId : false;
    }

    public function addUserRole($Uid, $role)
    {
        $sql = "INSERT INTO users_and_roles (Uid, Rid) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $Uid, $role);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function uniqueEmail($email)
    {
        $sql = "SELECT COUNT(*) AS count FROM users WHERE Uemail = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['count'] == 1;
    }

    public function uniqueNickname($nickname)
    {
        $sql = "SELECT COUNT(*) AS count FROM users WHERE Unickname = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $nickname);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['count'] == 1;
    }

    public function uniqueCredential($credential)
    {
        $sql = "SELECT COUNT(*) AS count FROM users WHERE Ucredential = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $credential);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['count'] == 1;
    }

    public function chekEmail($email)
    {
        $sql = "SELECT * FROM users WHERE Uemail = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->num_rows == 1;
    }

    public function checkEmailPassword($email, $password)
    {
        $sql = "SELECT * FROM users WHERE Uemail = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['Upassword'])) {
                return $user;
            }
        }
        return false;
    }

    public function updateUserById($userId, $name, $lastname, $credential, $birthdate, $gender, $city, $address, $nickname, $email, $password, $whatsapp, $facebook, $tiktok, $size, $blood)
    {
        $sql = "UPDATE users SET Uname = ?, Ulastname = ?, Ucredential = ?, Ubirthdate = ?, Ugender = ?, Ucity = ?, Uaddress = ?, Unickname = ?, Uemail = ?, Upassword = ?, Uwhatsapp = ?, Ufacebook = ?, Utiktok = ?, Usize = ?, Ublood = ? WHERE Uid = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssssssssssi", $name, $lastname, $credential, $birthdate, $gender, $city, $address, $nickname, $email, $password, $whatsapp, $facebook, $tiktok, $size, $blood, $userId);
        $success = $stmt->execute();

        return $success;
    }

    public function updateUserRole($userId, $roleId)
    {
        $sql = "UPDATE users_and_roles SET Rid = ? WHERE Uid = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $roleId, $userId);
        $success = $stmt->execute();

        return $success;
    }

    public function deleteUsers($id)
    {
        $sql = "DELETE FROM users WHERE Uid = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();

        return $success;
    }

    public function updateUserStatus($id, $status)
    {
        $sql = "UPDATE users SET Ustatus = ? WHERE Uid = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $status, $id);
        $success = $stmt->execute();

        return $success;
    }

    public function updateUserKey($id, $passwordHash)
    {
        $sql = "UPDATE users SET Upassword = ? WHERE Uid = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $passwordHash, $id);
        $success = $stmt->execute();

        return $success;
    }

    public function updateUseImage($id, $nameTypeImage)
    {
        $sql = "UPDATE users SET Uimage = ? WHERE Uid = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $nameTypeImage, $id);
        $success = $stmt->execute();

        return $success;
    }

    public function updateUserInfo($Uid, $Uname, $Ulastname, $Ubirthdate, $Ugender, $Ucity, $Uaddress, $Uwhatsapp, $Ufacebook, $Utiktok, $size, $blood,)
    {
        $sql = "UPDATE users SET Uname = ?, Ulastname = ?, Ubirthdate = ?, Ugender = ?, Ucity = ?, Uaddress = ?, Uwhatsapp = ?, Ufacebook = ?, Utiktok = ?, Usize = ?, Ublood = ?  WHERE Uid = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssssssi", $Uname, $Ulastname, $Ubirthdate, $Ugender, $Ucity, $Uaddress, $Uwhatsapp, $Ufacebook, $Utiktok,  $size, $blood, $Uid);
        $success = $stmt->execute();

        return $success;
    }

    public function deleteUser($Uid)
    {
        $sql = "DELETE FROM users_and_roles WHERE Uid = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $Uid);
        $success = $stmt->execute();
        if ($success) {
            $sql = "DELETE FROM users WHERE Uid = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $Uid);
            $success = $stmt->execute();
        }
        return $success;
    }



    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    //////////////////////////////////////////////////// register


    public function updateUserInfoUsers($Uid, $Uname, $Ulastname, $Ubirthdate, $Ugender, $Ucity, $Uaddress,  $Uwhatsapp, $Ublood, $Usize)
    {
        $sql = "UPDATE users SET Uname = ?, Ulastname = ?,  Ubirthdate = ?, Ugender = ?, Ucity = ?, Uaddress = ?, Uwhatsapp = ? , Ublood = ? , Usize = ? WHERE Uid = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssssi", $Uname, $Ulastname, $Ubirthdate, $Ugender, $Ucity, $Uaddress, $Uwhatsapp,  $Ublood, $Usize, $Uid);
        $success = $stmt->execute();

        return $success;
    }

    public function uniqueWhatpsapp($whatsapp)
    {
        $sql = "SELECT COUNT(*) AS count FROM users WHERE Uwhatsapp = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $whatsapp);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['count'] == 1;
    }

    public function createRegisterUsers(
        $Uname,
        $Ulastname,
        $Ucredential,
        $Ubirthdate,
        $Ugender,
        $Uemail,
        $passwordHash,
        $Uwhatsapp
    ) {
        $query = "INSERT INTO users 
        ( Uname, Ulastname, Ucredential, Ubirthdate, Ugender, Uemail, Upassword, Uwhatsapp, Ustatus, UdateCreated) VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, 1, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssss", $Uname, $Ulastname, $Ucredential, $Ubirthdate, $Ugender, $Uemail, $passwordHash, $Uwhatsapp);
        $response = $stmt->execute();
        $userId = $stmt->insert_id;
        $stmt->close();
        return $response ? $userId : false;
    }
}
