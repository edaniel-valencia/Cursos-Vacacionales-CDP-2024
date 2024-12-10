<?php
// archivo de conexión a la base de datos (connection.php)

class ConnectionDB {
    
    private static $conn = null;

    public static function getInstance() {
        if (self::$conn === null) {
            self::$conn = new mysqli('localhost', 'netcric1_cdp', 'netcric1_cdp', 'netcric1_cdp');
            if (self::$conn->connect_errno) {
                die("Connection failed: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }
}

?>
