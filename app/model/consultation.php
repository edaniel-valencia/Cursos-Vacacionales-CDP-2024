<?php
require_once 'connection.php';

class ConsultationModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function countRegisterConsultation()
    {
        $sql = "SELECT count(*) FROM invoice";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function getAllRegisterConsultation()
    {

        $sql = "SELECT  
       *  FROM invoice AS I 
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

    public function searchRegisterConsultation($search)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  
        *  FROM invoice AS I 
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
              
                    
                    GROUP BY I.Iid ORDER BY I.IdateCreated DESC
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function MSSERegisterConsultation($module, $sport, $start, $end)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  DISTINCT
        *
            FROM invoice AS I 
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
              M.Mid = '$module' AND S.Sid = '$sport' AND QH.QHstart = '$start' AND QH.QHend = '$end'
                            ORDER BY  U.Ulastname ASC ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function MSRegisterConsultation($module, $sport)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  DISTINCT
        *
            FROM invoice AS I 
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
              M.Mid = '$module' AND S.Sid = '$sport' 
              ORDER BY  E.Ename,   QH.QHstart ASC
              ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function MSRegisterConsultationByHour($module, $sport)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT DISTINCT 
          
            COUNT(I.Iid) AS Amount,
            QH.QHquota, 
            SUM(CI.CIprice -( CI.CIprice * D.Dvalue)) AS Profits,
              S.Sname,
            M.Mname,
            QH.QHstart,
            QH.QHend,
            E.Ename
        FROM 
            invoice AS I 
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
        M.Mid = '$module' AND S.Sid = '$sport' 
        GROUP BY 
            S.Sname, M.Mname, QH.QHstart, QH.QHend, E.Ename, QH.QHquota
        ORDER BY  
            E.Ename, QH.QHstart ASC";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function MRegisterConsultation($module)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT DISTINCT
            COUNT(DISTINCT I.Iid) AS Amount,
            QH.QHquota,
            SUM(CI.CIprice - (CI.CIprice * D.Dvalue)) AS Profits,
            S.Sname,
            M.Mname,
            E.Ename, 
            U.*, E.*, PS.*, QH.*

        FROM invoice AS I
        INNER JOIN users AS U ON I.Uid = U.Uid
        INNER JOIN invoice_data AS ID ON I.Uid = ID.Uid
        INNER JOIN courses AS C ON I.Cid = C.Cid
        INNER JOIN sports AS S ON C.Sid = S.Sid
        INNER JOIN modules AS M ON C.Mid = M.Mid
        INNER JOIN course_info AS CI ON C.Cid = CI.Cid
        INNER JOIN discounts AS D ON I.Did = D.Did
        INNER JOIN kits AS K ON C.Kid = K.Kid
        INNER JOIN quota_hour AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios AS E ON QH.Eid = E.Eid
        INNER JOIN payment_types AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery AS KD ON I.KDid = KD.KDid
        WHERE M.Mid = '$module'
        GROUP BY S.Sname
        ORDER BY S.Sname ASC";

        $result = mysqli_query($this->conn, $sql);

        // Verificar si la consulta tuvo éxito
        if (!$result) {
            die('Consulta fallida: ' . mysqli_error($this->conn));
        }

        // Verificar si hay resultados
        if (mysqli_num_rows($result) > 0) {
            // Fetch all results as an associative array
            $data = $result->fetch_all(MYSQLI_ASSOC);
            // print_r($data); // Puedes usar esto para depuración
            return $data;
        } else {
            // No hay resultados, devolver un array vacío
            return array();
        }
    }

    public function MRegisterConsultationMatriz($module)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT DISTINCT * FROM invoice AS I
        INNER JOIN users AS U ON I.Uid = U.Uid
        INNER JOIN invoice_data AS ID ON I.Uid = ID.Uid
        INNER JOIN courses AS C ON I.Cid = C.Cid
        INNER JOIN sports AS S ON C.Sid = S.Sid
        INNER JOIN modules AS M ON C.Mid = M.Mid
        INNER JOIN course_info AS CI ON C.Cid = CI.Cid
        INNER JOIN discounts AS D ON I.Did = D.Did
        INNER JOIN kits AS K ON C.Kid = K.Kid
        INNER JOIN quota_hour AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios AS E ON QH.Eid = E.Eid
        INNER JOIN payment_types AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery AS KD ON I.KDid = KD.KDid
        WHERE M.Mid = '$module'
        ORDER BY S.Sname ASC";

        $result = mysqli_query($this->conn, $sql);

        // Verificar si la consulta tuvo éxito
        if (!$result) {
            die('Consulta fallida: ' . mysqli_error($this->conn));
        }

        // Verificar si hay resultados
        if (mysqli_num_rows($result) > 0) {
            // Fetch all results as an associative array
            $data = $result->fetch_all(MYSQLI_ASSOC);
            // print_r($data); // Puedes usar esto para depuración
            return $data;
        } else {
            // No hay resultados, devolver un array vacío
            return array();
        }
    }

    public function MRegisterConsultationS($moduleSure)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  DISTINCT
        *
            FROM invoice AS I 
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
              M.Mid = '$moduleSure' 
                ORDER BY  U.Ulastname ASC";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function SRegisterConsultation($sport)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  DISTINCT
        *
            FROM invoice AS I 
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
              S.Sid = '$sport' 
                              ORDER BY  U.Ulastname, M.Mname ASC";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    /////////////////////////////////////////////////////////////  QUOTA HOUR

    public function getAllHourStart()
    {

        $sql = "SELECT DISTINCT QHstart
                    FROM quota_hour
                ORDER BY QHstart asc";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }
    public function getAllHourEnd()
    {

        $sql = "SELECT DISTINCT QHend
                    FROM quota_hour
                ORDER BY QHend asc";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getAllSport()
    {
        $sql = "SELECT DISTINCT S.Sname, S.Sid 
        FROM sports S
        INNER JOIN courses C ON C.Sid = S.Sid
        ORDER BY Sname asc";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getAllSportHourQuota()
    {
        $sql = "SELECT C.Cid, S.Sid, S.Sname, QH.QHstart, QH.QHend, E.Ename, QH.QHquota, QH.QHid FROM courses AS C 
        INNER JOIN modules      AS M  ON C.Mid = M.Mid 
        INNER JOIN sports       AS S  ON C.Sid = S.Sid 
              JOIN course_info  AS CI ON C.Cid = CI.Cid
              JOIN quota_hour   AS QH ON C.Cid = QH.Cid
              JOIN scenarios    AS E  ON QH.Eid = E.Eid

              WHERE C.Cstatus = 1 AND M.Mstatus = 1 AND S.Sstatus = 1;";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }
    public function getAllSportHourQuotaId($QHid)
    {
        $sql = "SELECT C.Cid, S.Sid, S.Sname, QH.QHstart, QH.QHend, E.Ename, QH.QHquota, QH.QHid FROM courses AS C 
        INNER JOIN modules      AS M  ON C.Mid = M.Mid 
        INNER JOIN sports       AS S  ON C.Sid = S.Sid 
              JOIN course_info  AS CI ON C.Cid = CI.Cid
              JOIN quota_hour   AS QH ON C.Cid = QH.Cid
              JOIN scenarios    AS E  ON QH.Eid = E.Eid

              WHERE C.Cstatus = 1 AND M.Mstatus = 1 AND S.Sstatus = 1 AND QH.QHid = $QHid;";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {



            return array();
        }
    }

    public function getAllModule()
    {
        $sql = "SELECT DISTINCT M.Mname, M.Mid, M.Myear
        FROM sports S
        INNER JOIN courses C ON C.Sid = S.Sid
        INNER JOIN modules M ON C.Mid = M.Mid
        ORDER BY Mname asc";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }


    ////////////////////////////////////// COURSE

    public function getAllCourseConsultant()
    {
        $sql = "SELECT  *  FROM courses AS C 
        INNER JOIN modules      AS M  ON C.Mid = M.Mid 
        INNER JOIN sports       AS S  ON C.Sid = S.Sid 
        INNER JOIN kits         AS K  ON C.Kid = K.Kid
              JOIN course_info  AS CI ON C.Cid = CI.Cid
              JOIN quota_hour   AS QH ON C.Cid = QH.Cid
              JOIN scenarios    AS E  ON QH.Eid = E.Eid

              WHERE C.Cstatus = 1 AND M.Mstatus = 1 AND S.Sstatus = 1 AND
        
        CURDATE() BETWEEN M.MIstart AND M.MIend AND QH.QHquota > 0

         order by S.Sname ASC ;
        
     
        ";
        $response =  mysqli_query($this->conn, $sql);;

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }


    public function MSHQRegisterConsultation($module, $sport, $QHid)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  DISTINCT
        *
            FROM invoice AS I 
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
              M.Mid = '$module' AND S.Sid = '$sport' AND QH.QHid = '$QHid'
                            ORDER BY  U.Ulastname ASC ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }
}
