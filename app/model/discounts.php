<?php
require_once 'connection.php';

class DiscountModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllDiscount()
    {
        $sql = "SELECT * FROM discounts ORDER BY Dvalue ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getDiscountById($Did)
    {
        $sql = "SELECT * FROM discounts WHERE Did = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $Did);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }
    
    public function countAllDiscount()
    {
        $sql = "SELECT COUNT(*) AS total FROM discounts";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
    public function countDiscount()
    {
        $sql = "SELECT COUNT(*) AS total FROM discounts";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
    public function getDiscountPagination($start, $itemsPage)
    {
        $sql = "SELECT * FROM discounts ORDER BY Did ASC LIMIT ?, ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $start, $itemsPage);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function searchDiscount($name)
    {
        $sql = "SELECT * FROM discounts WHERE Dpercentage LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $param = "%$name%";
        $stmt->bind_param("s", $param);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getByIdDiscount($id)
    {
        $sql = "SELECT count(*) as count FROM discounts as S
                INNER JOIN discounts_hours as SH ON SH.Sid = S.Sid
                where SH.Sid = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    
    public function createDiscount($percentage, $value, $description)
    {
        $sql = "INSERT INTO discounts (Dpercentage, Dvalue, Ddescription, Dstatus, DdateCreated) VALUES (?, ?, ?, 1, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("dds", $percentage, $value, $description);
        $response = $stmt->execute();
        return $response ? true : false;
    }
    
    public function uniqueName($name)
    {
        $sql = "SELECT COUNT(*) AS count FROM discounts WHERE Dpercentage = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] == 1;
    }
    
    public function updateDiscount($id, $Dpercentage, $Ddescription, $status)
    {
        $sql = "UPDATE discounts SET Dpercentage=?, Ddescription=?, Dstatus=?, DdateUpdated=NOW() WHERE Did=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssii", $Dpercentage,  $Ddescription, $status, $id);
        $response = $stmt->execute();
        return $response ? true : false;
    }
    
    public function deleteDiscount($id)
    {
        $sql = "DELETE FROM discounts WHERE Did=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $response = $stmt->execute();
        return $response ? true : false;
    }
    
}
