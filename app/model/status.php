<?php
require_once 'connection.php';

class StatusModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getStatus()
    {
        $sql = "SELECT * FROM status";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }
    public function getStatusPay()
    {
        $sql = "SELECT * FROM payment_status";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }
    
}
