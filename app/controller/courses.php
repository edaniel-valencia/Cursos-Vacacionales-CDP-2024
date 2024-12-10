<?php
class CourseController
{
    private $model;
    public function __construct()
    {
        $this->model = new CourseModel(ConnectionDB::getInstance());
    }

    public function getAllCourse()
    {
        $response = $this->model->getAllCourse();
        return $response;
    }

    public function getAllCoursePOS()
    {
        $response = $this->model->getAllCoursePOS();
        return $response;
    }

    public function getAllCourseTSE()
    {
        $response = $this->model->getAllCourseTSE();
        return $response;
    }

    public function getAllCoursePOSTSE()
    {
        $response = $this->model->getAllCoursePOSTSE();
        return $response;
    }

    public function getAllCourseAvailable()
    {
        $response = $this->model->getAllCourseAvailable();
        return $response;
    }

    public function getAllCourseSport()
    {
        $response = $this->model->getAllCourseSport();
        return $response;
    }

    public function getCourseById($courseId)
    {
        $course = $this->model->getCourseById($courseId);
        return $course;
    }
    public function getCourseQHEById($qhsId, $courseId)
    {
        return $this->model->getCourseQHEById($qhsId, $courseId);
    }
    public function getCourseByIdQH($courseId)
    {
        $course = $this->model->getCourseByIdQH($courseId);
        return $course;
    }
    public function getCourseByIdQHTSE($courseId)
    {
        $course = $this->model->getCourseByIdQHTSE($courseId);
        return $course;
    }

    public function getInvoiceCourseByIdQH($courseId)
    {
        $course = $this->model->getInvoiceCourseByIdQH($courseId);
        return $course;
    }

    public function getCourseQuotaHour()
    {
        $response = $this->model->getCourseQuotaHour();
        return $response;
    }

    public function getCoursePagination($inicio, $itemsPorPagina)
    {
        return $this->model->getCoursePagination($inicio, $itemsPorPagina);
    }

    public function countCourse()
    {
        return $this->model->countCourse();
    }

    public function countCourseAvailable()
    {
        return $this->model->countCourseAvailable();
    }

    public function searchCourse($name)
    {
        $searchCourse = $this->model->searchCourse($name);
        return $searchCourse;
    }
    public function searchCourseAvailable($name)
    {
        $searchCourseAvailable = $this->model->searchCourseAvailable($name);
        return $searchCourseAvailable;
    }

    public function countAllCourse()
    {
        $response = $this->model->countAllCourse();
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }

    public function createCourse()
    {

        if (isset($_POST["submit-course-add"])) {

            $Mid = $_POST['module'];
            $Eid = $_POST['scenery'];
            $Sid = $_POST['sport'];
            $price = $_POST['price'];
            $quota = $_POST['quota'];
            $start = $_POST['start_time'];
            $end = $_POST['end_time'];
            $kit = $_POST['kit'];
            $description = $_POST['description'];
            $responseUniqueCourse = $this->model->uniqueCourse($Mid, $Sid);
            if ($responseUniqueCourse) {
                echo '<script src="./alert/duplicateRegister.js"></script>';
                echo '<script> setTimeout(function(){ window.location = "course-add"; }, 1500); </script>';

            } else {


                $defaultImage = "TSoftec.png";
                if (!empty($_FILES['imagen']['name'])) {
                    $nameTypeImage = $_FILES['imagen']['name'];
                    $routeImage = $_FILES['imagen']['tmp_name'];
                    $directory = "./../assets/image/system/course/";
                    $routeDestination = $directory . $nameTypeImage;
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    if (move_uploaded_file($routeImage, $routeDestination)) {
                        $nameRoute = $routeDestination;
                        echo $nameRoute;
                    } else {
                        echo '<script src="./alert/registerError.js"></script>';
                        echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormModule(); });</script>';
                    }
                } else {
                    $nameTypeImage = $defaultImage;
                }

                $response = $this->model->createCourse($Mid, $Eid, $Sid, $price, $quota, $nameTypeImage, $start, $end, $kit, $description);
                if ($response) {
                    echo '<script src="./alert/registerSuccess.js"></script>';
                    // echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCourse(); });</script>';
                } else {
                    echo '<script src="./alert/registerError.js"></script>';
                    // echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCourse(); });</script>';
                }
                echo '<script> setTimeout(function(){ window.location = "course-list"; }, 1000); </script>';
            }
        }
    }

    public function updateCourse()
    {
        if (isset($_POST["submit-course-update-info"])) {
            $Cid = $_POST['Cid'];
            $module = $_POST['module'];
            $sport = $_POST['sport'];
            $kit = $_POST['kit'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $status = $_POST['status'];

            if (!empty($_FILES['imagen']['name'])) {
                $nameTypeImage = $_FILES['imagen']['name'];
                $routeImage = $_FILES['imagen']['tmp_name'];
                $directory = "./../assets/image/system/course/";
                $routeDestination = $directory . $nameTypeImage;
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                if (move_uploaded_file($routeImage, $routeDestination)) {
                    $nameRoute = $routeDestination;
                    echo $nameRoute;
                }
            }
            $updateCourse = $this->model->updateCourse($Cid, $module,  $sport,  $kit, $status);
            if ($updateCourse) {
                if (isset($nameTypeImage)) {
                    $updateCourseInfo = $this->model->updateCourseInfoWithImage($Cid, $price, $nameTypeImage, $description);
                    if ($updateCourseInfo) {
                        echo '<script src="./alert/updateSuccess.js"></script>';
                        echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCourse(); });</script>';
                    } else {
                        echo '<script src="./alert/updateError.js"></script>';
                        echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCourse(); });</script>';
                    }
                    echo '<script> setTimeout(function(){ window.location = "course-detail?course-id=' . $Cid . '"; }, 1000); </script>';
                    return;
                } else {
                    $updateCourseInfoI = $this->model->updateCourseInfoOutImage($Cid, $price, $description);
                    if ($updateCourseInfoI) {
                        echo '<script src="./alert/updateSuccess.js"></script>';
                        echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCourse(); });</script>';
                    } else {
                        echo '<script src="./alert/updateError.js"></script>';
                        echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCourse(); });</script>';
                    }
                    echo '<script> setTimeout(function(){ window.location = "course-detail?course-id=' . $Cid . '"; }, 1000); </script>';
                    return;
                }
            }
        }
    }

    public function updateCourseQuotaHour()
    {
        if (isset($_POST["submit-course-update-quota-hour"])) {
            $id = $_POST['id'];
            $Cid = $_POST['Cid'];
            $quota = $_POST['quota'];
            $start = $_POST['start_time'];
            $end = $_POST['end_time'];
            $Eid = $_POST['scenery'];
            $QHstatus = $_POST['QHstatus'];


            $updateCourse = $this->model->updateCourseQuotaHour($id, $start, $end, $quota, $Eid, $QHstatus);
            if ($updateCourse) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCourse(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCourse(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "course-detail?course-id=' . $Cid . '"; }, 1000); </script>';
        }
    }
    public function createCourseQuotaHour()
    {
        if (isset($_POST["submit-course-add-quota-hour"])) {
            $id = $_POST['id'];
            $quota = $_POST['quota'];
            $start = $_POST['start_time'];
            $end = $_POST['end_time'];
            $Eid = $_POST['scenery'];


            $updateCourse = $this->model->createCourseQuotaHour($id, $Eid, $quota, $start, $end);
            if ($updateCourse) {
                echo '<script src="./alert/registerSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCourse(); });</script>';
            } else {
                echo '<script src="./alert/registerError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCourse(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "course-detail?course-id=' . $id . '"; }, 1000); </script>';
        }
    }

    public function deleteCourseQuotaHour()
    {
        if (isset($_POST["submit-course-delete-quota-hour"])) {

            $id = $_POST['id'];
            $Cid = $_POST['Cid'];
            $countCourse = $this->model->getByIdCourse($Cid);
            if ($countCourse >= 0 && $countCourse <= 1) {
                echo '<script src="./alert/deleteErrorRelation.js"></script>';
            } else {
                $updateCourse = $this->model->deleteCourseQuotaHour($id);
                if ($updateCourse) {
                    echo '<script src="./alert/deleteSuccess.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCourse(); });</script>';
                } else {
                    echo '<script src="./alert/deleteError.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCourse(); });</script>';
                }
                echo '<script> setTimeout(function(){ window.location = "course-detail?course-id=' . $Cid . '"; }, 1000); </script>';
            }
        }
    }

    public function updateDeleteCourseStatus()
    {
        if (isset($_POST["submit-course-delete"])) {
            $id = $_POST['id'];

            $countCourse = $this->model->getByIdCourse($id);
            if ($countCourse > 1) {
                echo '<script src="./alert/deleteErrorRelation.js"></script>';
            } else {

                $deletedCourse = $this->model->updateDeleteCourseStatus($id);
                if ($deletedCourse) {
                    echo '<script src="./alert/deleteSuccess.js"></script>';
                } else {
                    echo '<script src="./alert/deleteError.js"></script>';
                }
                echo '<script> setTimeout(function(){ window.location = "course-list"; }, 500); </script>';
            }
        }
    }
    public function deleteCourse()
    {
        if (isset($_POST["submit-course-delete"])) {
            $id = $_POST['id'];
            $QHCid = $_POST['QHid'];

            $countCourse = $this->model->getByIdCourse($id);
            if ($countCourse > 1) {
                echo '<script src="./alert/deleteErrorRelation.js"></script>';
            } else {
                $deleteCI = $this->model->deleteCourseInfo($id);
                if ($deleteCI) {
                    $deleteCQH = $this->model->deleteCourseQuotaHour($QHCid);
                    if ($deleteCQH) {
                        $deletedCourse = $this->model->deleteCourse($id);
                        if ($deletedCourse) {
                            echo '<script> setTimeout(function(){ window.location = "course-list"; }, 0); </script>';

                            echo '<script src="./alert/deleteSuccess.js"></script>';
                        } else {
                            echo '<script> setTimeout(function(){ window.location = "course-detail?course-id=' . $id . '"; }, 0); </script>';

                            echo '<script src="./alert/deleteError.js"></script>';
                        }
                    }
                }
            }
        }
    }
}
