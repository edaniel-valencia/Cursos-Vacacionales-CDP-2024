<?php
require_once 'connection.php';

class PosModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

 

    public function countMyCourseByIdPOS($userId)
    {
        $sql = "SELECT count(*) FROM invoice  WHERE Uid = $userId ";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function getAllMyCourseByIdPOS($userId)
    {

        $sql = "SELECT  
        U.Uid, U.Uname,  U.Ulastname,  U.Ubirthdate,  U.Uwhatsapp,  U.Ucredential,  U.Uemail,  U.Usize,  U.Ublood,  U.Ugender,  U.Ucity,
        I.Iid,
        M.Mname, M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did,
        M.Mid,
        K.Kid,
        S.Sid  FROM invoice AS I 
        INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN kits                 AS K  ON C.Kid  = K.Kid
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
        WHERE I.UCid = $userId
        GROUP BY I.Iid ORDER BY I.IdateCreated DESC
        
";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function searchMyCourseByIdPOS($search, $userId)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  
        U.Uid, U.Uname,  U.Ulastname,  U.Ubirthdate,  U.Uwhatsapp,  U.Ucredential,  U.Uemail,  U.Usize,  U.Ublood,  U.Ugender,  U.Ucity,
        I.Iid,
        M.Mname,   M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did,
        M.Mid,
        K.Kid,
        S.Sid  FROM invoice AS I 
        INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN kits                 AS K  ON C.Kid  = K.Kid
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
            WHERE 
                    (S.Sname  LIKE '%$search%' OR Uname  LIKE '%$search%'  OR Ulastname  LIKE '%$search%' OR Ucredential  LIKE '%$search%'  ) 
                    AND I.UCid = $userId
                    
                    GROUP BY I.Iid ORDER BY I.IdateCreated DESC
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function dateStartEndMyRegisterByIdPOS($Dstart, $Dend, $userId)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  DISTINCT
        U.Uid, U.Uname,  U.Ulastname,  U.Ubirthdate,  U.Uwhatsapp,  U.Ucredential,  U.Uemail,  U.Usize,  U.Ublood,  U.Ugender,  U.Ucity,
        I.Iid,
        M.Mname, M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did,
        M.Mid,
        K.Kid,
        S.Sid  FROM invoice AS I 
        INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN kits                 AS K  ON C.Kid  = K.Kid
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
            WHERE 
             I.UCid = $userId  AND  DATE(I.IdateCreated) BETWEEN '$Dstart' AND '$Dend'                    
                    -- GROUP BY I.Iid ORDER BY I.IdateCreated DESC
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }
   
   
    public function moduloMyRegisterByIdPOS($Modulo, $userId)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  DISTINCT
         U.Uid, U.Uname,  U.Ulastname,  U.Ubirthdate,  U.Uwhatsapp,  U.Ucredential,  U.Uemail,  U.Usize,  U.Ublood,  U.Ugender,  U.Ucity,
        I.UCid,
        M.Mname, M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did,
        M.Mid,
        K.Kid,
        S.Sid   FROM invoice AS I 
         INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN kits                 AS K  ON C.Kid  = K.Kid
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
        WHERE 
             I.UCid = $userId  AND  M.Mid = '$Modulo'                   
                    -- GROUP BY I.Iid ORDER BY I.IdateCreated DESC
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }



    
    public function dateStartEndMyRegisterPOS($Dstart, $Dend, $userId)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  DISTINCT *  FROM invoice AS I 
        INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN kits                 AS K  ON C.Kid  = K.Kid
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
            WHERE 
             I.UCid = $userId  AND  DATE(I.IdateCreated) BETWEEN '$Dstart' AND '$Dend'                    
                    -- GROUP BY I.Iid ORDER BY I.IdateCreated DESC
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }


    public function dateStartEndAccoutantPOS($Dstart, $Dend, $Modulo)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  DISTINCT *  FROM invoice AS I 
        INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN kits                 AS K  ON C.Kid  = K.Kid
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
            WHERE M.Mid = $Modulo AND
                 DATE(I.IdateCreated) BETWEEN '$Dstart' AND '$Dend'                    
                    -- GROUP BY I.Iid ORDER BY I.IdateCreated DESC
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }
   
    public function moduleMyRegisterPOS($Mname)
    {
        $sql = "SELECT DISTINCT *  FROM invoice AS I 
        INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN kits                 AS K  ON C.Kid  = K.Kid
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
            WHERE 
              C.Mid = $Mname";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }
   
    
    public function userPOS($userId)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  DISTINCT * FROM users WHERE Uid = $userId";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); 
        }
    }




    /////////////////////////////////////////

    ////  ALL INSCRIPTION


    public function countRegisterPOS()
    {
        $sql = "SELECT count(*) FROM invoice";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function getAllRegisterPOS()
    {

        $sql = "SELECT  
        U.Uid, U.Uname,  U.Ulastname,  U.Ubirthdate,  U.Uwhatsapp,  U.Ucredential,  U.Uemail,  U.Usize,  U.Ublood,  U.Ugender,  U.Ucity,
        I.Iid,
        M.Mname, M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did,
        M.Mid,
        K.Kid,
        S.Sid  FROM invoice AS I 
        INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN kits                 AS K  ON C.Kid  = K.Kid
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
       
        GROUP BY I.Iid ORDER BY I.IdateCreated DESC
        
";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function searchRegisterPOS($search)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  
        U.Uid, U.Uname,  U.Ulastname,  U.Ubirthdate,  U.Uwhatsapp,  U.Ucredential,  U.Uemail,  U.Usize,  U.Ublood,  U.Ugender,  U.Ucity,
        I.Iid,
        M.Mname, M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did,
        M.Mid,
        K.Kid,
        S.Sid  FROM invoice AS I 
        INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN kits                 AS K  ON C.Kid  = K.Kid
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
            WHERE 
                    (S.Sname  LIKE '%$search%' OR Uname  LIKE '%$search%'  OR Ulastname  LIKE '%$search%' OR Ucredential  LIKE '%$search%' OR Iid  LIKE '%$search%'  ) 
              
                    
                    GROUP BY I.Iid ORDER BY I.IdateCreated DESC
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function dateStartEndRegisterPOS($Dstart, $Dend)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  DISTINCT
        U.Uid, U.Uname,  U.Ulastname,  U.Ubirthdate,  U.Uwhatsapp,  U.Ucredential,  U.Uemail,  U.Usize,  U.Ublood,  U.Ugender,  U.Ucity,
        I.Iid,
        M.Mname, M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did,
        M.Mid,
        K.Kid,
        S.Sid  FROM invoice AS I 
        INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN kits                 AS K  ON C.Kid  = K.Kid
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
            WHERE 
            DATE(I.IdateCreated) BETWEEN '$Dstart' AND '$Dend'                    
                    -- GROUP BY I.Iid ORDER BY I.IdateCreated DESC
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }
   
   
    public function moduloRegisterPOS($Modulo)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  DISTINCT
         U.Uid, U.Uname,  U.Ulastname,  U.Ubirthdate,  U.Uwhatsapp,  U.Ucredential,  U.Uemail,  U.Usize,  U.Ublood,  U.Ugender,  U.Ucity,
        I.UCid,
        M.Mname, M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did,
        M.Mid,
        K.Kid,
        S.Sid   FROM invoice AS I 
         INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN kits                 AS K  ON C.Kid  = K.Kid
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
        WHERE 
              M.Mid = '$Modulo'                   
                    -- GROUP BY I.Iid ORDER BY I.IdateCreated DESC
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }



   
}
