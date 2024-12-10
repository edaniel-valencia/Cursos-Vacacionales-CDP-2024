<?php
require_once 'connection.php';

class CourseModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllCourse()
    {
        $sql = "SELECT  *  FROM courses AS C 
        INNER JOIN modules      AS M  ON C.Mid = M.Mid 
        INNER JOIN sports       AS S  ON C.Sid = S.Sid 
        INNER JOIN kits         AS K  ON C.Kid = K.Kid
              JOIN course_info  AS CI ON C.Cid = CI.Cid
              JOIN quota_hour   AS QH ON C.Cid = QH.Cid
              JOIN scenarios    AS E  ON QH.Eid = E.Eid

        GROUP BY C.Cid order by C.CdateCreated DESC
        ";
        $response =  mysqli_query($this->conn, $sql);;

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }
    public function getAllMyCourse()
    {
        $sql = "SELECT  *  FROM courses AS C 
        INNER JOIN modules      AS M  ON C.Mid = M.Mid 
        INNER JOIN sports       AS S  ON C.Sid = S.Sid 
        INNER JOIN kits         AS K  ON C.Kid = K.Kid
              JOIN course_info  AS CI ON C.Cid = CI.Cid
              JOIN quota_hour   AS QH ON C.Cid = QH.Cid
              JOIN scenarios    AS E  ON QH.Eid = E.Eid

        GROUP BY C.Cid order by S.Sname ASC
        
        ";
        $response =  mysqli_query($this->conn, $sql);;

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }
    
    public function getAllCoursePOS()
    {
        $sql = "SELECT  *  FROM courses AS C 
            INNER JOIN modules      AS M  ON C.Mid = M.Mid 
            INNER JOIN sports       AS S  ON C.Sid = S.Sid 
            INNER JOIN kits         AS K  ON C.Kid = K.Kid
                JOIN course_info  AS CI ON C.Cid = CI.Cid
                JOIN quota_hour   AS QH ON C.Cid = QH.Cid
                JOIN scenarios    AS E  ON QH.Eid = E.Eid

            WHERE C.Cstatus = 1  and S.Sstatus = 1 and M.Mstatus = 1  AND QH.QHstatus = 2 AND QH.QHquota > 0
            order by S.Sname ASC
        ";
        $response =  mysqli_query($this->conn, $sql);;

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }
   
   
    public function getAllCoursePOSTSE()
    {
        $sql = "SELECT  *  FROM courses AS C 
            INNER JOIN modules      AS M  ON C.Mid = M.Mid 
            INNER JOIN sports       AS S  ON C.Sid = S.Sid 
            INNER JOIN kits         AS K  ON C.Kid = K.Kid
                JOIN course_info  AS CI ON C.Cid = CI.Cid
                JOIN quota_hour   AS QH ON C.Cid = QH.Cid
                JOIN scenarios    AS E  ON QH.Eid = E.Eid

            WHERE S.Sstatus = 1 and M.Mstatus = 1  AND QH.QHstatus = 2 AND QH.QHquota > 0
            order by M.Mname, S.Sname ASC
        ";
        $response =  mysqli_query($this->conn, $sql);;

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getAllCourseTSE()
    {
        $sql = "SELECT  *  FROM courses AS C 
            INNER JOIN modules      AS M  ON C.Mid = M.Mid 
            INNER JOIN sports       AS S  ON C.Sid = S.Sid 
            INNER JOIN kits         AS K  ON C.Kid = K.Kid
                JOIN course_info  AS CI ON C.Cid = CI.Cid
                JOIN quota_hour   AS QH ON C.Cid = QH.Cid
                JOIN scenarios    AS E  ON QH.Eid = E.Eid

            WHERE S.Sstatus = 1 and M.Mstatus = 1  AND QH.QHstatus = 2 AND QH.QHquota > 0
            order by M.Mname, S.Sname ASC
        ";
        $response =  mysqli_query($this->conn, $sql);;

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getAllCourseAvailable()
    {
        $sql = "SELECT DISTINCT C.*, M.*, S.*, QH.*, CI.*, K.*, E.*  FROM courses AS C 
        INNER JOIN modules      AS M  ON C.Mid = M.Mid 
        INNER JOIN sports       AS S  ON C.Sid = S.Sid 
        INNER JOIN kits         AS K  ON C.Kid = K.Kid
              JOIN course_info  AS CI ON C.Cid = CI.Cid
              JOIN quota_hour   AS QH ON C.Cid = QH.Cid
              JOIN scenarios    AS E  ON QH.Eid = E.Eid
              WHERE C.Cstatus = 1 AND M.Mstatus = 1 AND S.Sstatus = 1 AND QH.QHstatus = 2 AND
        
               CURDATE() BETWEEN M.MIstart AND M.MIend  AND QH.QHquota > 0

              GROUP BY C.Cid order by S.Sname ASC
        
        ";
        $response =  mysqli_query($this->conn, $sql);;

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getCourseById($courseId)
    {
        $sql = "SELECT  C.*, M.*, S.*, QH.*, CI.*, K.*, E.*  FROM courses AS C 
        INNER JOIN modules      AS M  ON C.Mid = M.Mid 
        INNER JOIN sports       AS S  ON C.Sid = S.Sid 
        INNER JOIN kits         AS K  ON C.Kid = K.Kid
              JOIN course_info  AS CI ON C.Cid = CI.Cid
              JOIN quota_hour   AS QH ON C.Cid = QH.Cid
              JOIN scenarios    AS E  ON QH.Eid = E.Eid

        WHERE C.Cid= $courseId   ORDER BY C.CdateCreated asc
        ";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            $userData = mysqli_fetch_assoc($response);
            mysqli_free_result($response);
            return $userData;
        } else {

            return null;
        }
    }

    public function getCourseByIdUpdate($courseId)
    {
        $sql = "SELECT  C.*, M.*, S.*, QH.*, CI.*, K.*, E.*  FROM courses AS C 
        INNER JOIN modules      AS M  ON C.Mid = M.Mid 
        INNER JOIN sports       AS S  ON C.Sid = S.Sid 
        INNER JOIN kits         AS K  ON C.Kid = K.Kid
              JOIN course_info  AS CI ON C.Cid = CI.Cid
              JOIN quota_hour   AS QH ON C.Cid = QH.Cid
              JOIN scenarios    AS E  ON QH.Eid = E.Eid

        WHERE C.Cid= $courseId 
        ";
        $response =  mysqli_query($this->conn, $sql);;

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getCourseQHEById($qhsId, $courseId)
    {
        // SQL con parámetros preparados
        $sql = "SELECT * 
            FROM courses AS C 
            INNER JOIN modules AS M ON C.Mid = M.Mid 
            INNER JOIN sports AS S ON C.Sid = S.Sid 
            INNER JOIN kits AS K ON C.Kid = K.Kid
            JOIN course_info AS CI ON C.Cid = CI.Cid
            INNER JOIN quota_hour AS QH ON C.Cid = QH.Cid
            JOIN scenarios AS E ON QH.Eid = E.Eid
            WHERE QH.QHid = ? AND C.Cid = ?";

        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("ii", $qhsId, $courseId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                return array();
            }
            $stmt->close();
        } else {
            die("Error en la preparación de la consulta: " . $this->conn->error);
        }
    }

    public function getCourseByIdQH($courseId)
    {
        $sql = "SELECT *  FROM quota_hour AS QH 
            JOIN scenarios AS E ON QH.Eid = E.Eid
        WHERE Cid = $courseId AND QH.QHquota > 0 AND QH.QHstatus = 2";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getCourseByIdQHTSE($courseId)
    {
        $sql = "SELECT *  FROM quota_hour AS QH 
            JOIN scenarios AS E ON QH.Eid = E.Eid
        WHERE Cid = $courseId AND QH.QHquota >= 0 AND QH.QHstatus = 2";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }
    public function getInvoiceCourseByIdQH($Cid)
    {
        $sql = "SELECT * FROM quota_hour AS QH 
            INNER JOIN courses AS C ON C.Cid = QH.Cid
            INNER JOIN scenarios AS E ON E.Eid = QH.Eid
        WHERE C.Cid = $Cid";
        $response =  mysqli_query($this->conn, $sql);;
        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getByIdHour($Cid)
    {
        $sql = "SELECT  *  FROM courses AS C 
              JOIN hours  AS H ON C.Cid = H.Cid
        WHERE H.Cid = $Cid;
        
        ";
        $response =  mysqli_query($this->conn, $sql);;

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getAllCourseSport()
    {
        $sql = "SELECT *  FROM courses AS C 
        INNER JOIN modules      AS M  ON C.Mid = M.Mid 
        INNER JOIN sports       AS S  ON C.Sid = S.Sid 
        INNER JOIN kits         AS K  ON C.Kid = K.Kid
              JOIN course_info  AS CI ON C.Cid = CI.Cid
              JOIN quota_hour   AS QH ON C.Cid = QH.Cid
              JOIN scenarios    AS E  ON QH.Eid = E.Eid

     
        WHERE C.Cstatus = 1 AND M.Mstatus = 1 AND S.Sstatus = 1 AND
        
        CURDATE() BETWEEN M.MIstart AND M.MIend
        
            GROUP BY S.Sname ORDER BY  S.Sname  ASC";
        $response =  mysqli_query($this->conn, $sql);;

        if ($response) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getCourseQuotaHour()
    {
        $sql = "SELECT * FROM quota_hour";
        $response =  mysqli_query($this->conn, $sql);;
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

    public function countCourse()
    {
        $sql = "SELECT COUNT(*) AS total FROM courses";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['total'];
        } else {
            return 0; // Devuelve 0 si no se pueden obtener resultados
        }
    }
    public function countCourseAvailable()
    {
        $sql = "SELECT COUNT(*) AS total FROM courses  WHERE Cstatus = 1 ";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['total'];
        } else {
            return 0; // Devuelve 0 si no se pueden obtener resultados
        }
    }

    public function getCoursePagination($start, $itemsPage)
    {
        $sql = "SELECT * FROM courses ORDER BY Cid ASC LIMIT $start, $itemsPage";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }

    public function searchCourse($search)
    {

        $sql = "SELECT DISTINCT C.*, M.*, S.*, QH.*, CI.*, K.*, E.*  FROM courses AS C 
        INNER JOIN modules      AS M  ON C.Mid = M.Mid 
        INNER JOIN sports       AS S  ON C.Sid = S.Sid 
        INNER JOIN kits         AS K  ON C.Kid = K.Kid
              JOIN course_info  AS CI ON C.Cid = CI.Cid
              JOIN quota_hour   AS QH ON C.Cid = QH.Cid
              JOIN scenarios    AS E  ON QH.Eid = E.Eid
                    WHERE 
                        S.Sname  LIKE '%$search%' OR 
                        M.Mname  LIKE '%$search%'  
                        
                       GROUP BY C.Cid order by C.CdateCreated DESC ;
                        ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }


    public function searchCourseAvailable($search)
    {
        $sql = "SELECT  C.*, M.*, S.*, QH.*, CI.*, K.*, E.*  FROM courses AS C 
        INNER JOIN modules      AS M  ON C.Mid = M.Mid 
        INNER JOIN sports       AS S  ON C.Sid = S.Sid 
        INNER JOIN kits         AS K  ON C.Kid = K.Kid
              JOIN course_info  AS CI ON C.Cid = CI.Cid
              JOIN quota_hour   AS QH ON C.Cid = QH.Cid
              JOIN scenarios    AS E  ON QH.Eid = E.Eid 

                    WHERE 
                        S.Sname  LIKE '%$search%' AND
        
        C.Cstatus = 1 AND M.Mstatus = 1 AND S.Sstatus = 1 AND QH.QHstatus = 2 AND
        
               CURDATE() BETWEEN M.MIstart AND M.MIend  AND QH.QHquota > 0

              GROUP BY C.Cid order by S.Sname ASC
                        ";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Devuelve un array vacío si no hay resultados
        }
    }



    public function getByIdCourse($id)
    {
        $sql = "SELECT count(*) as count  FROM courses as C
        INNER JOIN quota_hour as QH ON QH.Cid = C.Cid
        where QH.Cid  =   $id";
        $response = mysqli_query($this->conn, $sql);
        if ($response) {
            $row = mysqli_fetch_assoc($response);
            return $row['count'];
        }
        return 0;
    }



    public function createCourse($Mid, $Eid, $Sid,  $price, $quota, $nameTypeImage, $start, $end, $kit, $description)
    {
        $sqlCourse = "INSERT INTO courses (Mid, Sid, Kid, Cstatus, CdateCreated) VALUES ('$Mid', '$Sid',   $kit,  1, NOW())";
        $courses = $this->conn->query($sqlCourse);

        if ($courses) {

            $sqlCourseS = "SELECT * FROM courses ORDER BY Cid DESC LIMIT 1";
            $course = $this->conn->query($sqlCourseS);

            if ($course) {

                $row = $course->fetch_assoc();
                $Cid = $row['Cid'];
                $sqlHour = "INSERT INTO quota_hour (Cid, Eid, QHquota, QHstart, QHend,  QHdateCreated) 
                                            VALUES ($Cid, $Eid, '$quota', '$start', '$end', NOW())";
                $hour = $this->conn->query($sqlHour);
                $sqlCourseInfo = "INSERT INTO course_info (Cid, CIprice, CIimage,  CIdescription, CIdateCreated) VALUES ($Cid, $price, '$nameTypeImage', '$description', NOW())";
                $courseInfo = $this->conn->query($sqlCourseInfo);

                return $courseInfo && $hour;
            } else {
                return false; // If the SELECT query fails
            }
        } else {
            return false; // If the INSERT query fails
        }
    }

    public function uniqueCourse($Mid, $Sid)
    {
        $sql = "SELECT COUNT(*) AS count FROM 
        courses WHERE Mid = $Mid AND Sid = $Sid";
        $response = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($response);
        return $row['count'] == 1;
    }


    public function updateCourse($Cid, $Mid, $Sid,  $Kid,  $status)
    {
        $query = "UPDATE courses SET Mid = '$Mid', Sid = '$Sid',  Kid = '$Kid', Cstatus = '$status', CdateUpdated = NOW() WHERE Cid = '$Cid'";
        $response = $this->conn->query($query);
        return $response ? true : false;
    }

    public function updateCourseInfoWithImage($Cid, $price, $nameTypeImage, $description)
    {
        $query = "UPDATE course_info SET  CIprice = '$price', CIimage = '$nameTypeImage', CIdescription = '$description',  CIdateUpdated = NOW() WHERE Cid = '$Cid'";
        $response = $this->conn->query($query);
        return $response ? true : false;
    }

    public function updateCourseInfoOutImage($Cid, $price, $description)
    {
        $query = "UPDATE course_info SET CIprice='$price',  CIdescription='$description',  CIdateUpdated=NOW() WHERE Cid=$Cid";
        $response = $this->conn->query($query);
        return $response ? true : false;
    }

    public function createCourseQuotaHour($Cid, $Eid,  $quota, $start, $end)
    {
        $sqlQuotaHour = "INSERT INTO quota_hour (Cid, Eid, QHquota, QHstart, QHend,  QHdateCreated) VALUES ($Cid, $Eid, $quota, '$start', '$end', NOW())";
        $response = $this->conn->query($sqlQuotaHour);
        return $response ? true : false;
    }

    public function updateCourseQuotaHour($id, $start, $end, $quota, $Eid,  $QHstatus)
    {
        $query = "UPDATE quota_hour SET Eid ='$Eid', QHstart ='$start', QHend='$end', QHquota='$quota', QHstatus='$QHstatus', QHdateUpdated=NOW() WHERE QHid=$id";
        $response = $this->conn->query($query);
        return $response ? true : false;
    }
    public function updateDeleteCourseStatus($id)
    {
        $query = "UPDATE courses SET Cstatus= 0, CdateUpdated=NOW() WHERE Cid=$id";
        $response = $this->conn->query($query);
        return $response ? true : false;
    }

    public function deleteCourseQuotaHour($id)
    {
        $query = "DELETE FROM quota_hour WHERE QHid=$id";
        $response = $this->conn->query($query);
        return $response ? true : false;
    }

    public function deleteCourseAllQuotaHour($id)
    {
        $query = "DELETE FROM quota_hour WHERE Cid=$id";
        $response = $this->conn->query($query);
        return $response ? true : false;
    }

    public function deleteCourseInfo($id)
    {
        $query = "DELETE FROM course_info WHERE Cid=$id"; // Corregido el nombre de la tabla
        $response = $this->conn->query($query);
        return $response ? true : false;
    }

    public function deleteCourse($id)
    {
        $query = "DELETE FROM courses WHERE Cid=$id";
        $response = $this->conn->query($query);
        return $response ? true : false;
    }
}
