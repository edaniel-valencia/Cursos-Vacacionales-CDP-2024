<?php
require_once 'connection.php';

class InvoiceModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllInvoice()
    {
        $sql = "SELECT * FROM invoice_data";
        $response =  $this->conn->query($sql);

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function onlineRangerDateonllline($Dstart, $Dend)
    {
        $sql = "SELECT  DISTINCT
        U.Uid, U.Uname,  U.Ulastname, M.Myear, U.Ubirthdate,  U.Uwhatsapp,  U.Ucredential,  U.Uemail,  U.Usize,  U.Ublood,  U.Ugender,  U.Ucity,
        I.Iid,
        I.IdateCreated,
        M.Mname,
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
            WHERE I.ITid = 1 AND
           
              DATE(I.IdateCreated) BETWEEN '$Dstart' AND '$Dend'                    
                   
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function onlineRangerDate($Dstart, $Dend, $userId)
    {
        $sql = "SELECT  DISTINCT
        U.Uid, U.Uname,  U.Ulastname, M.Myear, U.Ubirthdate,  U.Uwhatsapp,  U.Ucredential,  U.Uemail,  U.Usize,  U.Ublood,  U.Ugender,  U.Ucity,
        I.Iid,
        M.Mname,
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
            WHERE I.ITid = 1 and
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


    public function generalRangerDate($Dstart, $Dend, $Module)
    {
        $sql = "SELECT  DISTINCT *
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
            WHERE 
             M.Mid = $Module  AND
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

    public function onlineRangerAccountantData($Dstart, $Dend)
    {
        $sql = "SELECT  DISTINCT
        U.Uid, U.Uname,  U.Ulastname, M.Myear, U.Ubirthdate,  U.Uwhatsapp,  U.Ucredential,  U.Uemail,  U.Usize,  U.Ublood,  U.Ugender,  U.Ucity,
        I.Iid,
        M.Mname,
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


    public function onlineRangerDatePresencial($Dstart, $Dend)
    {
        $sql = "SELECT  DISTINCT
        U.Uid, U.Uname,  U.Ulastname, M.Myear, U.Ubirthdate,  U.Uwhatsapp,  U.Ucredential,  U.Uemail,  U.Usize,  U.Ublood,  U.Ugender,  U.Ucity,
        I.Iid,
        M.Mname,
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
            WHERE I.ITid = 2 
             AND  DATE(I.IdateCreated) BETWEEN '$Dstart' AND '$Dend'                    
                
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }


    public function getCountAllInvoice()
    {
        $sql = "SELECT COUNT(*) as count FROM invoice_data";
        $response =  $this->conn->query($sql);
        if ($response) {
            $row = $response->fetch_assoc();
            return $row['count'];
        } else {
            return 0;
        }
    }

    public function getInvoiceDataId($Uid)
    {
        $sql = "SELECT * FROM invoice_data as ID
        INNER JOIN users as U ON ID.Uid = U.Uid
            WHERE ID.Uid = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $Uid);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getInvoiceDataIdUserPOS($Uid)
    {
        $sql = "SELECT * FROM invoice_data as ID
        INNER JOIN users as U ON ID.Uid = U.Uid
            WHERE ID.Uid = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $Uid);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }
    public function getByIdInvoice($id)
    {
        $sql = "SELECT COUNT(*) as count FROM invoice_data as R
        INNER JOIN users_and_Invoice as UR
        ON R.Rid = UR.Rid
        where R.Rid = ?";
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

    public function createInvoiceOnline($Uid, $Cid, $QHid, $banco, $number, $date, $nameTypeImage)
    {
        $sql = "INSERT INTO invoice (Uid, Cid, Did, QHid, PTid, ITid, KDid, Ibanco, Ivoucher, Ivoucher_number, Idate, PSid, IdateCreated) 
        VALUES (?, ?, 1, ?, 1, 1, 1, ?, ?, ?, ?, 2, NOW())";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("iiissss", $Uid, $Cid, $QHid, $banco, $nameTypeImage, $number, $date);

        $response = $stmt->execute();
        $stmt->close();

        return $response ? true : false;
    }


    public function uniqueInvoice($Uid, $Cid, $QHid)
    {
        $sql = "SELECT COUNT(*) AS count FROM invoice WHERE Uid = ? AND Cid = ? AND QHid = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $Uid, $Cid, $QHid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row['count'] == 1;
    }


    public function createInvoicePOS($Uid, $Cid, $Did, $QHid, $PTid, $UCid, $banco, $number, $date, $routeNameImage)
    {
        $sql = "INSERT INTO invoice (Uid, Cid, Did, QHid, PTid, ITid, KDid, UCid, Ibanco, Ivoucher, Ivoucher_number, Idate, PSid, IdateCreated) 
        VALUES (?, ?, ?, ?, ?, 2, 1, ?, ?, ?, ?, ?, 2, NOW())";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("iiiiiissss", $Uid, $Cid, $Did, $QHid, $PTid, $UCid, $banco, $routeNameImage, $number, $date);

        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function createInvoicePOSMoney($Uid, $Cid, $Did, $QHid, $PTid, $UCid, $defaultImage)
    {
        $sql = "INSERT INTO invoice (Uid, Cid, Did, QHid, PTid, ITid, KDid, UCid, PSid, Ivoucher, IdateCreated) 
        VALUES (?, ?, ?, ?, ?, 2, 1, ?, 3, ?, NOW())";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("iiiiiis", $Uid, $Cid, $Did, $QHid, $PTid, $UCid, $defaultImage);

        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }



    public function updateInvoice($id, $name, $lastname, $email, $ruc, $phone, $canton)
    {
        $sql = "UPDATE invoice_data SET IDname=?, IDlastname=?,  IDruc=?, IDemail=?, IDphone=?, IDcanton=? WHERE IDid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi",  $name, $lastname, $ruc, $email,  $phone, $canton, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }



    public function updateStockCourseMenos($QHid)
    {
        $sql = "UPDATE quota_hour SET  QHquota = QHquota - 1 WHERE QHid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $QHid);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function updateStockCourseMas($QHid)
    {
        $sql = "UPDATE quota_hour SET  QHquota = QHquota + 1 WHERE QHid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $QHid);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function createInvoiceDataOnline($id, $name, $lastname, $email, $ruc, $phone, $canton)
    {
        $sql = "INSERT INTO invoice_data (Uid, IDname, IDlastname, IDruc, IDemail, IDphone, IDcanton, IDdateCreated) 
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);

        // Asegúrate de que los tipos de datos coinciden con los tipos de columnas en la base de datos
        // Aquí se usa 'i' para INT y 's' para STRING
        $stmt->bind_param("issssss", $id, $name, $lastname, $email, $ruc, $phone, $canton);

        $response = $stmt->execute();
        $stmt->close();

        return $response ? true : false;
    }


    public function updateInvoiceOnline($id, $name, $lastname, $email, $ruc, $phone, $canton)
    {
        $sql = "UPDATE invoice_data SET IDname=?, IDlastname=?,  IDruc=?, IDemail=?, IDphone=?, IDcanton=? WHERE IDid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi",  $name, $lastname, $ruc, $email,  $phone, $canton, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function updateInvoicePOS($id, $name, $lastname, $email, $ruc, $phone, $canton)
    {
        $sql = "UPDATE invoice_data SET IDname=?, IDlastname=?,  IDruc=?, IDemail=?, IDphone=?, IDcanton=? WHERE IDid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi",  $name, $lastname, $ruc, $email,  $phone, $canton, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function updateInvoiceLPOS($id, $name, $lastname, $email, $ruc, $phone, $canton)
    {
        $sql = "UPDATE invoice_data SET IDname=?, IDlastname=?,  IDruc=?, IDemail=?, IDphone=?, IDcanton=? WHERE IDid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi",  $name, $lastname, $ruc, $email,  $phone, $canton, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }



    public function createInvoiceDataPOS($id, $name, $lastname, $email, $ruc, $phone, $canton)
    {
        $sql = "INSERT INTO invoice_data (Uid, IDname, IDlastname, IDruc, IDemail, IDphone, IDcanton, IDdateCreated) 
        VALUES (?, ?, ?, ?, ?, ?, ?,  NOW())";
        $stmt = $this->conn->prepare($sql);

        // Asegúrate de que los tipos de datos coinciden con los tipos de columnas en la base de datos
        // Aquí se usa 'i' para INT y 's' para STRING
        $stmt->bind_param("issssss", $id, $name, $lastname, $email, $ruc, $phone, $canton);

        $response = $stmt->execute();
        $stmt->close();

        return $response ? true : false;
    }



    public function updateInvoiceDataPOS($id, $name, $lastname, $email, $ruc, $phone, $canton)
    {
        $sql = "UPDATE invoice_data SET IDname=?, IDlastname=?,  IDruc=?, IDemail=?, IDphone=?, IDcanton=? WHERE Uid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi",  $name, $lastname, $ruc, $email,  $phone, $canton, $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }


    public function deleteInvoiceData($id)
    {
        $sql = "DELETE FROM invoice_data WHERE Rid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }

    public function deleteInvoice($id)
    {
        $sql = "DELETE FROM invoice WHERE Iid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }


    public function updateInvoiceVoucherId($Iid, $routeNameImage)
    {
        $sql = "UPDATE invoice SET Ivoucher = ? WHERE Iid = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $routeNameImage, $Iid);
        $success = $stmt->execute();

        return $success;
    }

    public function updateInvoiceQuotaHourId($Iid, $QHid)
    {
        $sql = "UPDATE invoice SET QHid = ? WHERE Iid = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $QHid, $Iid);
        $success = $stmt->execute();

        return $success;
    }

    public function updateInvoiceDiscountId($Iid, $Did)
    {
        $sql = "UPDATE invoice SET Did = ? WHERE Iid = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $Did, $Iid);
        $success = $stmt->execute();

        return $success;
    }

    public function getQuotaHourId($Iid, $QHid)
    {
        $sql = "SELECT * FROM invoice WHERE Iid = ? AND  QHid = ? ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $Iid, $QHid);
        $success = $stmt->execute();

        return $success;
    }


    public function getInvoiceQuotaHour($Iid, $Cid, $QHid)
    {
        $sql = "SELECT * FROM invoice WHERE Iid = ? AND  Cid = ?  AND  QHid = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $Cid, $QHid, $Iid);
        $success = $stmt->execute();

        return $success;
    }

    public function updateInvoiceQuotaHour($Iid, $Cid, $QHid)
    {
        $sql = "UPDATE invoice SET Cid = ?, QHid = ? WHERE Iid = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $Cid, $QHid, $Iid);
        $success = $stmt->execute();

        return $success;
    }




    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getMyCourseOnlineById($invoiceId)
    {
        // Prepara la consulta SQL con marcadores de posición
        $sql = "SELECT *
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
            WHERE I.Iid = ?
            ORDER BY C.CdateCreated ASC";

        // Prepara la declaración
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            // Vincula el parámetro
            mysqli_stmt_bind_param($stmt, "i", $invoiceId);

            // Ejecuta la declaración
            mysqli_stmt_execute($stmt);

            // Obtiene el resultado
            $result = mysqli_stmt_get_result($stmt);

            // Verifica si hay resultados
            if ($result) {
                $userData = mysqli_fetch_assoc($result);
                mysqli_free_result($result);
                mysqli_stmt_close($stmt);
                return $userData;
            } else {
                // Cierra la declaración en caso de error
                mysqli_stmt_close($stmt);
                return null;
            }
        } else {
            // Devuelve null si la preparación falla
            return null;
        }
    }


    public function getCourseByPerson($invoiceId)
    {
        $sql = "SELECT * FROM invoice AS I 
            INNER JOIN users AS U ON I.UCid = U.Uid
            INNER JOIN courses AS C ON I.Cid = C.Cid
            WHERE I.Iid = ?
            ORDER BY C.CdateCreated ASC";

        if ($stmt = mysqli_prepare($this->conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $invoiceId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $userData = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            mysqli_stmt_close($stmt);
            return $userData;
        } else {
            return null;
        }
    }



    public function getAllMyCourse($userId)
    {

        $sql = "SELECT DISTINCT *   FROM invoice AS I
        INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
            WHERE I.Uid = '$userId'

        GROUP BY I.Iid ORDER BY I.IdateCreated DESC
        
";
        $response =  $this->conn->query($sql);

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function countAllCourse()
    {
        $sql = "SELECT count(*) FROM courses";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        }
    }
    public function countAllMyCourse()
    {
        $sql = "SELECT count(*) FROM invoice";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        }
    }


    public function countMyCourse()
    {
        $sql = "SELECT count(*) FROM invoice";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function countMyCourseUser($userId)
    {
        $sql = "SELECT count(*) FROM invoice WHERE Uid = $userId";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        }
    }



    public function getMyCoursePagination($start, $itemsPage)
    {
        $sql = "SELECT * FROM invoice ORDER BY Iid ASC LIMIT $start, $itemsPage";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function searchMyCourse($search)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT DISTINCT *  FROM invoice AS I
        INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
            WHERE 
                    S.Sname  LIKE '%$search%' OR 
                    M.Mname  LIKE '%$search%'  
                    
                    GROUP BY I.Iid ORDER BY S.Sname ASC
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }
    public function searchMyCourseUser($search, $userId)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT DISTINCT *  FROM invoice AS I
        INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
            WHERE 
                  ( S.Sname  LIKE '%$search%' OR 
                    M.Mname  LIKE '%$search%'  ) AND I.Uid = $userId
                    
                    GROUP BY I.Iid ORDER BY S.Sname ASC
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }


    public function searchMyCourseAvailable($search)
    {
        $sql = "SELECT *  FROM invoice AS I
        INNER JOIN users                AS U  ON I.Uid  = U.Uid
        INNER JOIN invoice_data         AS ID ON I.Uid  = ID.Uid
        INNER JOIN courses              AS C  ON I.Cid  = C.Cid
        INNER JOIN sports               AS S  ON C.Sid  = S.Sid
        INNER JOIN modules              AS M  ON C.Mid  = M.Mid
        INNER JOIN course_info          AS CI ON C.Cid  = CI.Cid
        INNER JOIN discounts            AS D  ON I.Did  = D.Did
        INNER JOIN quota_hour           AS QH ON I.QHid = QH.QHid
        INNER JOIN scenarios            AS E  ON QH.Eid = E.Eid
        INNER JOIN payment_types        AS PT ON I.PTid = PT.PTid
        INNER JOIN inscription_types    AS IT ON I.ITid = IT.ITid
        INNER JOIN payment_status       AS PS ON I.PSid = PS.PSid
        INNER JOIN kit_delivery         AS KD ON I.KDid = KD.KDid
                WHERE 
                    S.Sname  LIKE '%$search%' OR 
                    M.Mname  LIKE '%$search%'  
                    
                    GROUP BY I.Iid ORDER BY S.Sname ASC
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }



    ///////////////////////////////////////////////
    ///////////// payment types

    public function getPaymentType()
    {
        $sql = "SELECT * FROM payment_types";
        $response =  $this->conn->query($sql);

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    //////////////////////////////////////////////////////////////////

    public function countInvoiceOnline()
    {
        $sql = "SELECT count(*) FROM invoice WHERE ITid = 1";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function searchInvoiceOnline($search)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT 
        U.Uid, U.Uname,  U.Ulastname,   U.Ucredential, 
        I.Iid,
        M.Mname, M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did,
        M.Mid,
        CI.CIprice,
        K.Kid,
        S.Sid,
        E.Eid, E.Ename,
        ID.IDname, ID.IDruc
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
        WHERE I.ITid = 1 AND (
               
                 I.Iid  LIKE '%$search%' OR 
                 U.Uname  LIKE '%$search%' OR 
                 U.Ulastname  LIKE '%$search%' OR 
                 S.Sname  LIKE '%$search%' OR
                 U.Ucredential  LIKE '%$search%' 
                  
                )
                GROUP BY I.Iid ORDER BY I.IdateCreated ASC
                ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }
    public function searchInvoiceGeneral($search)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT 
        U.Uid, U.Uname,  U.Ulastname,   U.Ucredential, 
        I.Iid,
        M.Mname, M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did,
        M.Mid,
        CI.CIprice,
        K.Kid,
        S.Sid,
        E.Eid, E.Ename,
        ID.IDname, ID.IDruc
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
               
                 I.Iid  LIKE '%$search%' OR 
                 U.Uname  LIKE '%$search%' OR 
                 U.Ulastname  LIKE '%$search%' OR 
                 S.Sname  LIKE '%$search%' OR
                 U.Ucredential  LIKE '%$search%' 
                  
                
                GROUP BY I.Iid ORDER BY I.IdateCreated ASC
                ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }



    public function getAllInvoiceOnline()
    {
        $sql = "SELECT 
        U.Uid, U.Uname,  U.Ulastname,   U.Ucredential, 
        I.Iid,
        M.Mname, M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did, D.Dvalue,
        M.Mid,
        CI.CIprice,
        K.Kid,
        S.Sid,
        E.Eid, E.Ename,
        ID.IDname, ID.IDruc
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
          WHERE I.ITid = 1
        GROUP BY I.Iid ORDER BY I.IdateCreated DESC ";
        $response =  $this->conn->query($sql);

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function moduloMyRegisterGenerales($Modulo)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT  DISTINCT *
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
            WHERE 
             M.Mid = $Modulo                    
                    -- GROUP BY I.Iid ORDER BY I.IdateCreated DESC
                    ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function getAllInvoiceGenerales()
    {
        $sql = "SELECT 
        U.Uid, U.Uname,  U.Ulastname,   U.Ucredential, 
        I.Iid,
        M.Mname, M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did, D.Dvalue,
        M.Mid,
        CI.CIprice,
        K.Kid,
        S.Sid,
        E.Eid, E.Ename,
        ID.IDname, ID.IDruc
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
          
        GROUP BY I.Iid ORDER BY I.IdateCreated DESC ";
        $response =  $this->conn->query($sql);

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }



    public function countInvoicePerson()
    {
        $sql = "SELECT count(*) FROM invoice WHERE ITid = 2";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function searchInvoicePerson($search)
    {
        // $sql = "SELECT C.*, S.*, QH.*, E.*  FROM invoice AS I
        $sql = "SELECT 
        U.Uid, U.Uname,  U.Ulastname,   U.Ucredential, 
        I.Iid,
        M.Mname, M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did, D.Dvalue,
        M.Mid,
        CI.CIprice,
        K.Kid,
        S.Sid,
        E.Eid, E.Ename,
        ID.IDname, ID.IDruc
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
        WHERE I.ITid = 2 AND (
               
                 I.Iid  LIKE '%$search%' OR 
                 U.Uname  LIKE '%$search%' OR 
                 U.Ulastname  LIKE '%$search%' OR 
                 S.Sname  LIKE '%$search%' OR
                 U.Ucredential  LIKE '%$search%' 
                )
                GROUP BY I.Iid ORDER BY I.IdateCreated ASC
                ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }



    public function getAllInvoicePerson()
    {
        $sql = "SELECT 
        U.Uid, U.Uname,  U.Ulastname,   U.Ucredential, 
        I.Iid,
        M.Mname, M.Myear,
        S.Sname,
        PS.PSid,
        C.Cid,
        D.Did, D.Dvalue,
        M.Mid,
        CI.CIprice,
        K.Kid,
        S.Sid,
        E.Eid, E.Ename,
        ID.IDname, ID.IDruc
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
          WHERE I.ITid = 2
        GROUP BY I.Iid ORDER BY I.IdateCreated DESC ";
        $response =  $this->conn->query($sql);

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    /////////////////////////////////////////////////////////////////

    public function getAllPaymentStatus()
    {
        $sql = "SELECT * FROM payment_status";
        $response =  $this->conn->query($sql);

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function invoiceUpdateStatusId($Iid, $PSid, $INVN)
    {
        $sql = "UPDATE invoice SET PSid=?, InewVoucherNumber=? WHERE Iid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isi", $PSid, $INVN, $Iid); // Orden corregido: PSid, INVN, Iid
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }



    public function invoiceUpdateStatusPersonId($Iid, $PSid, $INVN)
    {

        $sql = "UPDATE invoice SET PSid=?, InewVoucherNumber=? WHERE Iid=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isi", $PSid, $INVN, $Iid); // Orden corregido: PSid, INVN, Iid
        $response = $stmt->execute();
        $stmt->close();
        return $response ? true : false;
    }
}
