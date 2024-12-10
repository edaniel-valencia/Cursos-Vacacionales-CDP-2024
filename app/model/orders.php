<?php
require_once 'connection.php';

class OrderModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllOrder()
    {
        $sql = "SELECT * FROM Orders ORDER BY KdateCreated DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }


    public function getByIdOrder($id)
    {
        $sql = "SELECT count(*) as count FROM Orders as K
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

    public function createOrder($name)
    {
        $query = "INSERT INTO Orders (Kname,  Kstatus, KdateCreated) 
            VALUES (?, 1, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $name );
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function updateOrder($id, $name, $status)
    {
        $query = "UPDATE Orders SET Kname=?, Kstatus=?, KdateUpdated=NOW() WHERE Kid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $name,  $status, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

  
    public function deleteOrder($id)
    {
        $query = "DELETE FROM Orders WHERE Kid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }
}
