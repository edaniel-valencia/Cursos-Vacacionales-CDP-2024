<?php
require_once 'connection.php';

class SpyModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function countMyCourseByIdSpy($userId)
    {
        $sql = "SELECT count(*) FROM invoice  WHERE Uid = $userId ";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        }
    }   
}
