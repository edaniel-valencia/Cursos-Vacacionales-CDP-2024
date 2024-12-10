<?php
require_once 'connection.php';

class HomeModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getCountAllUsers()
    {
        $sql = "SELECT count(*) AS total     FROM users AS U
        INNER JOIN users_and_roles AS UAR 
            ON U.Uid = UAR.Uid
        INNER JOIN roles AS R
            ON R.Rid = UAR.Rid 
            WHERE R.Rid = 6";
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
    public function getCountByUsers($Uid)
    {
        $sql = "SELECT count(*) AS total FROM invoice WHERE UCid = $Uid";
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

    public function getCountInvoice()
    {
        $sql = "SELECT count(*) AS total FROM invoice";
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

    public function getCountAllInvoiceProfits()
    {
        $sql = "SELECT DISTINCT 
            COUNT(DISTINCT I.Iid) AS InvoiceCount, 
            ROUND(SUM(CI.CIprice - (CI.CIprice * D.Dvalue)), 2) AS TotalAmount,
            M.Mid
        FROM 
            invoice AS I
        INNER JOIN users             AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data      AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses           AS C  ON I.Cid  = C.Cid
        INNER JOIN sports            AS S  ON C.Sid  = S.Sid
        INNER JOIN modules           AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info       AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts         AS D  ON I.Did  = D.Did
        INNER JOIN kits              AS K  ON C.Kid  = K.Kid
        INNER JOIN quota_hour        AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios         AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types     AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status    AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery      AS KD ON I.KDid = KD.KDid
        group by M.Mid
         ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $invoices = [];
    
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $invoices[] = [
                    'Mid' => $row['Mid'],
                    'InvoiceCount' => $row['InvoiceCount'],
                    'TotalAmount' => $row['TotalAmount']
                ];
            }
        }
    
        return $invoices;
    }

    public function getCountAllInvoice()
{
    $sql = "SELECT DISTINCT C.Mid, count(*) AS total FROM invoice AS I INNER JOIN courses AS C ON I.Cid = C.Cid
            GROUP BY C.Mid";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();
    $invoices = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $invoices[] = [
                'Mid' => $row['Mid'],
                'total' => $row['total']
            ];
        }
    }

    return $invoices;
}


    public function getGroupBySport()
    {
        $sql = "SELECT S.Sname AS SportName, COUNT(DISTINCT I.Iid) AS TotalInscriptions 
                FROM invoice AS I
                INNER JOIN courses AS C ON I.Cid = C.Cid
                INNER JOIN sports AS S ON C.Sid = S.Sid
                GROUP BY S.Sname
                ORDER BY S.Sname asc";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return [];
        }
    }

    public function getGroupByModule()
    {
        $sql = "SELECT  M.Mname AS ModuleName, COUNT(DISTINCT I.Iid) AS TotalInscriptions 
                FROM invoice AS I
                INNER JOIN courses AS C ON I.Cid = C.Cid
                INNER JOIN modules AS M ON C.Mid = M.Mid
                GROUP BY M.Mname
                ORDER BY M.Mname asc";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return []; // Devuelve un array vacío si no hay resultados
        }
    }

    public function getGroupByDayAndSport()
    {
        $sql = "SELECT S.Sname AS SportName, COUNT(I.Iid) AS TotalInscriptions 
            FROM invoice AS I
            INNER JOIN courses AS C ON I.Cid = C.Cid
            INNER JOIN sports AS S ON C.Sid = S.Sid
            WHERE DATE(I.IdateCreated) = CURDATE() 
            GROUP BY S.Sname
            ORDER BY S.Sname ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return [];
        }
    }


    public function getInscriptionsByModuleAndType() {
        $sql = "SELECT IT.ITname, M.Mname AS ModuleName, COUNT(DISTINCT I.Iid) AS TotalInscriptions 
                FROM invoice AS I
                INNER JOIN courses AS C ON I.Cid = C.Cid
                INNER JOIN modules AS M ON C.Mid = M.Mid
                INNER JOIN inscription_types AS IT ON IT.ITid = I.ITid
                GROUP BY IT.ITname, M.Mname
                ORDER BY IT.ITname asc";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return []; // Devuelve un array vacío si no hay resultados
        }
    }

    public function getInscriptionsBySportAndModuleAndTendence() {
        $sql = "SELECT S.Sname, M.Mname AS ModuleName, COUNT(DISTINCT I.Iid) AS TotalInscriptions 
                FROM invoice AS I
                INNER JOIN courses AS C ON I.Cid = C.Cid
                INNER JOIN sports AS S ON C.Sid = S.Sid
                INNER JOIN modules AS M ON C.Mid = M.Mid
                GROUP BY S.Sname, M.Mname
                ORDER BY S.Sname asc";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return []; // Devuelve un array vacío si no hay resultados
        }
    }
}
