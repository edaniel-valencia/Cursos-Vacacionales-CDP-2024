<?php


class InvoiceController
{

    private $model;
    public function __construct()
    {

        $this->model = new InvoiceModel(ConnectionDB::getInstance());
    }


    public function onlineRangerDateonllline($Dstart, $Dend)
    {
        $searchCourse = $this->model->onlineRangerDateonllline($Dstart, $Dend);
        return $searchCourse;
    }
    function NumberUniqueVoucher($quatitlyVoucher)
    {
        $numberVouchers = range(1, $quatitlyVoucher);
        shuffle($numberVouchers);
        return $numberVouchers;
    }


    public function onlineRangerDate($Dstart, $Dend, $userId)
    {
        $searchCourse = $this->model->onlineRangerDate($Dstart, $Dend, $userId);
        return $searchCourse;
    }

    public function onlineRangerAccountantData($Dstart, $Dend,)
    {
        $searchCourse = $this->model->onlineRangerAccountantData($Dstart, $Dend);
        return $searchCourse;
    }
    public function generalRangerDate($Dstart, $Dend, $Modulo)
    {
        $searchCourse = $this->model->generalRangerDate($Dstart, $Dend, $Modulo);
        return $searchCourse;
    }

    public function onlineRangerDatePresencial($Dstart, $Dend)
    {
        $searchCourse = $this->model->onlineRangerDatePresencial($Dstart, $Dend);
        return $searchCourse;
    }

    public function ViewInvoice()
    {
        $response = $this->model->getAllInvoice();
        return $response;
    }


    public function getCountAllInvoice()
    {
        $response = $this->model->getCountAllInvoice();
        return $response;
    }

    public function getInvoiceDataId($userId, $qhsId, $courseId)
    {
        $response = $this->model->getInvoiceDataId($userId);

        if (empty($response)) {
            echo '<script>window.location.href = "invoice-add?quota-hour-scenery=' . $qhsId . '&course-id=' . $courseId . '";</script>';
        } else {
            return $response;
        }
    }

    public function getInvoiceDataIdUser($userId)
    {
        $response = $this->model->getInvoiceDataId($userId);

        if (empty($response)) {
            echo '<script>window.location.href = "invoice-add";</script>';
        } else {
            return $response;
        }
    }

    public function getInvoiceDataIdUserPOS($userId)
    {
        $response = $this->model->getInvoiceDataIdUserPOS($userId);

        if (empty($response)) {
            echo '<script>window.location.href = "invoice-add-pos";</script>';
        } else {
            return $response;
        }
    }

    public function getInvoiceDataIdPOS($userId,  $courseId, $quota_hourId, $discountId)
    {
        $response = $this->model->getInvoiceDataId($userId);

        if (empty($response)) {
            echo '<script>window.location.href = "invoice-add-pos?userId=' . $userId . '&courseId=' . $courseId . '&quota_hourId=' . $quota_hourId . '&discountId=' . $discountId . '";</script>';
        } else {
            return $response;
        }
    }


    public function createInvoiceOnline()
    {
        if (isset($_POST["submit-course-pay"])) {

            $NumberVoucher = include './class/random_voucher.php'; // Ajusta la ruta según la ubicación de tu archivo randow.php

            $Uid = $_POST['Uid'];
            $Cid = $_POST['Cid'];
            $QHid = $_POST['QHSid'];
            $banco = $_POST['banco_pay'];
            $number = $_POST['number_pay'];
            $date = $_POST['date_pay'];
            $defaultImage = "default.png";

            if ($this->model->uniqueInvoice($Uid, $Cid, $QHid)) {
                echo '<script src="./alert/diplicateInvoice.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                echo '<script> setTimeout(function(){ window.location = "course-available"; }, 1000); </script>';


                return;
            }

            if (!empty($_FILES['imagen']['name'])) {
                $nameTypeImage = $_FILES['imagen']['name'];
                $routeNameImage = 'TSE-CDP-COMP-' . $NumberVoucher . '-' . $nameTypeImage;
                $routeImage = $_FILES['imagen']['tmp_name'];
                $directory = "./../assets/image/system/voucher/";
                $routeDestination = $directory . 'TSE-CDP-COMP-' . $NumberVoucher . '-' . $nameTypeImage;
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                if (move_uploaded_file($routeImage, $routeDestination)) {
                    $nameRoute = $routeDestination;
                    $nameRoute;
                } else {
                    echo '<script src="./alert/registerError.js"></script>';
                }
            } else {
                $routeNameImage = $defaultImage;
            }

            $invoice = $this->model->createInvoiceOnline($Uid, $Cid, $QHid, $banco, $number, $date, $routeNameImage);
            if ($invoice) {
                $this->model->updateStockCourseMenos($QHid);
                echo '<script src="./alert/registerSuccess.js"></script>';
                echo '<script> setTimeout(function(){ window.location = "invoice-my-course"; }, 1000); </script>';
                return $invoice;
            } else {
                echo '<script src="./alert/registerError.js"></script>';
            }
        }
    }

    public function updateInvoice()
    {
        if (isset($_POST["submit-invoice-data-update"])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $ruc = $_POST['ruc'];
            $phone = $_POST['phone'];
            $canton = $_POST['canton'];
            echo "<script>function keepFormCRol(){document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';}</script>";

            $updateInvoice = $this->model->updateInvoice($id, $name, $lastname, $email, $ruc, $phone, $canton);
            if ($updateInvoice) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "invoice-data"; }, 1000); </script>';
        }
    }

    public function updateInvoicePOS()
    {
        if (isset($_POST["submit-invoice-data-update"])) {
            $id = $_POST['id'];
            $userId = $_POST['userId'];
            $courseId = $_POST['courseId'];
            $quota_hourId = $_POST['quota_hourId'];
            $discountId = $_POST['discountId'];
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $ruc = $_POST['ruc'];
            $phone = $_POST['phone'];
            $canton = $_POST['canton'];
            echo "<script>function keepFormCRol(){document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';}</script>";

            $updateInvoice = $this->model->updateInvoicePOS($id, $name, $lastname, $email, $ruc, $phone, $canton);
            if ($updateInvoice) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "order-process-pos?userId=' . $userId . '&courseId=' . $courseId . '&quota_hourId=' . $quota_hourId . '&discountId=' . $discountId . '"; }, 1000); </script>';
        }
    }

    public function updateInvoiceLPOS()
    {
        if (isset($_POST["submit-invoice-data-update"])) {
            $id = $_POST['id'];
            $userId = $_POST['userId'];

            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $ruc = $_POST['ruc'];
            $phone = $_POST['phone'];
            $canton = $_POST['canton'];
            echo "<script>function keepFormCRol(){document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';}</script>";

            $updateInvoice = $this->model->updateInvoiceLPOS($id, $name, $lastname, $email, $ruc, $phone, $canton);
            if ($updateInvoice) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "invoice-data-pos-detail?userId=' . $userId . '"; }, 1000); </script>';
        }
    }



    public function createInvoiceDataOnline()
    {
        if (isset($_POST["submit-invoice-data-add"])) {

            $Uid = $_POST['id'];
            $QHid = $_POST['QHid'];
            $Cid = $_POST['Cid'];
            $IDname = $_POST['name'];
            $IDlastname = $_POST['lastname'];
            $IDruc = $_POST['ruc'];
            $IDemail = $_POST['email'];
            $IDphone = $_POST['phone'];
            $IDcanton = $_POST['canton'];

            $invoice = $this->model->createInvoiceDataOnline($Uid, $IDname, $IDlastname, $IDruc, $IDemail, $IDphone, $IDcanton);
            if ($invoice) {
                echo '<script src="./alert/registerSuccess.js"></script>';
            } else {
                echo '<script src="./alert/registerError.js"></script>';
            }
            echo '<script> setTimeout(function(){ window.location = "order-process?quota-hour-scenery=' . $QHid . '&course-id=' . $Cid . '"; }, 1000); </script>';
            return $invoice;
        }
    }

    public function updateInvoiceDataOnline()
    {
        if (isset($_POST["submit-invoice-data-update"])) {
            $IDid = $_POST['IDid'];
            $Uid = $_POST['id'];
            $IDname = $_POST['name'];
            $IDlastname = $_POST['lastname'];
            $IDruc = $_POST['ruc'];
            $IDemail = $_POST['email'];
            $IDphone = $_POST['phone'];
            $IDcanton = $_POST['canton'];
            echo "<script>function keepFormCRol(){document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';}</script>";

            $updateInvoice = $this->model->updateInvoiceOnline($Uid, $IDname, $IDlastname, $IDruc, $IDemail, $IDphone, $IDcanton);
            if ($updateInvoice) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "invoice-my-course"; }, 1000); </script>';
        }
    }




    public function createInvoiceDataPOS()
    {
        if (isset($_POST["submit-invoice-data-pos-add"])) {

            $Uid = $_POST['Uid'];
            $QHid = $_POST['QHid'];
            $Cid = $_POST['Cid'];
            $Did = $_POST['Did'];
            $IDname = $_POST['name'];
            $IDlastname = $_POST['lastname'];
            $IDruc = $_POST['ruc'];
            $IDemail = $_POST['email'];
            $IDphone = $_POST['phone'];
            $IDcanton = $_POST['canton'];

            $invoice = $this->model->createInvoiceDataPOS($Uid, $IDname, $IDlastname, $IDruc, $IDemail, $IDphone, $IDcanton);
            if ($invoice) {
                echo '<script src="./alert/registerSuccess.js"></script>';
            } else {
                echo '<script src="./alert/registerError.js"></script>';
            }
            echo '<script> setTimeout(function(){ window.location = "order-process-pos?userId=' . $Uid . '&courseId=' . $Cid . '&quota_hourId=' . $QHid . '&discountId=' . $Did . '"; }, 1000); </script>';
            return $invoice;
        }
    }


    public function createInvoicePOS()
    {
        if (isset($_POST["submit-course-pos-pay"])) {

            $NumberVoucher = include './class/random_voucher.php'; // Ajusta la ruta según la ubicación de tu archivo randow.php


            $Uid = $_POST['Uid'];
            $Cid = $_POST['Cid'];
            $QHid = $_POST['QHid'];
            $UCid = $_POST['UCid'];
            $Did = $_POST['Did'];
            $PTid = $_POST['PTid'];

            if ($this->model->uniqueInvoice($Uid, $Cid, $QHid)) {
                echo '<script src="./alert/diplicateInvoice.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                echo '<script> setTimeout(function(){ window.location = "pos-web"; }, 1000); </script>';

                return;
            }

            if (empty($_POST['banco_pay']) && empty($_POST['number_pay'])  && empty($_POST['date_pay'])) {
                $defaultImage = "default.png";

                $invoice = $this->model->createInvoicePOSMoney($Uid, $Cid, $Did, $QHid, $PTid, $UCid, $defaultImage);
                if ($invoice) {
                    $this->model->updateStockCourseMenos($QHid);
                    echo '<script src="./alert/registerSuccess.js"></script>';
                    echo '<script> setTimeout(function(){ window.location = "pos-my-register"; }, 1000); </script>';
                } else {
                    echo '<script src="./alert/registerError.js"></script>';
                }
            } else {
                $banco = $_POST['banco_pay'];
                $number = $_POST['number_pay'];
                $date = $_POST['date_pay'];
                $defaultImage = "default.png";
                if (!empty($_FILES['imagen']['name'])) {
                    $nameTypeImage = $_FILES['imagen']['name'];
                    $routeNameImage = 'TSE-CDP-COMP-' . $NumberVoucher . '-' . $nameTypeImage;
                    $routeImage = $_FILES['imagen']['tmp_name'];
                    $directory = "./../assets/image/system/voucher/";
                    $routeDestination = $directory . 'TSE-CDP-COMP-' . $NumberVoucher . '-' . $nameTypeImage;
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    if (move_uploaded_file($routeImage, $routeDestination)) {
                        $nameRoute = $routeDestination;
                        // echo $nameRoute;
                    } else {
                        echo '<script src="./alert/registerError.js"></script>';
                    }
                } else {
                    $routeNameImage = $defaultImage;
                }
                $invoice = $this->model->createInvoicePOS($Uid, $Cid, $Did, $QHid, $PTid, $UCid, $banco, $number, $date, $routeNameImage);
                if ($invoice) {
                    $this->model->updateStockCourseMenos($QHid);
                    echo '<script src="./alert/registerSuccess.js"></script>';
                } else {
                    echo '<script src="./alert/registerError.js"></script>';
                }
                echo '<script> setTimeout(function(){ window.location = "pos-my-register"; }, 1000); </script>';
                return $invoice;
            }
        }
    }



    public function deleteInvoice()
    {
        if (isset($_POST["submit-invoice-delete"])) {
            $Iid = $_POST['Iid'];
            $QHid = $_POST['QHid'];

            $deletedInvoice = $this->model->deleteInvoice($Iid);
            if ($deletedInvoice) {
                $this->model->updateStockCourseMas($QHid);

                echo '<script src="./alert/deleteSuccess.js"></script>';
            } else {
                echo '<script src="./alert/deleteError.js"></script>';
            }
            echo '<script> setTimeout(function(){ window.location = "pos-my-register"; }, 500); </script>';
            return $deletedInvoice;
        }
    }


    public function deleteInvoiceAll()
    {
        if (isset($_POST["submit-invoice-delete"])) {
            $Iid = $_POST['Iid'];
            $QHid = $_POST['QHid'];

            $deletedInvoice = $this->model->deleteInvoice($Iid);
            if ($deletedInvoice) {
                $this->model->updateStockCourseMas($QHid);

                echo '<script src="./alert/deleteSuccess.js"></script>';
            } else {
                echo '<script src="./alert/deleteError.js"></script>';
            }
            echo '<script> setTimeout(function(){ window.location = "pos-all-register"; }, 500); </script>';
            return $deletedInvoice;
        }
    }

    public function updateInvoiceVoucherId()
    {
        if (isset($_POST["submit-invoice-voucher-update"])) {

            $NumberVoucher = include './class/random_voucher.php'; // Ajusta la ruta según la ubicación de tu archivo randow.php

            $Iid = $_POST['Iid'];
            $Did = $_POST['Did'];
            $Cid = $_POST['Cid'];
            $Uid = $_POST['Uid'];

            if (!empty($_FILES['imagen']['name'])) {
                $nameTypeImage = $_FILES['imagen']['name'];
                $routeNameImage = 'TSE-CDP-COMP-' . $NumberVoucher . '-' . $nameTypeImage;
                $routeImage = $_FILES['imagen']['tmp_name'];
                $directory = "./../assets/image/system/voucher/";
                $routeDestination = $directory . 'TSE-CDP-COMP-' . $NumberVoucher . '-' . $nameTypeImage;
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                if (move_uploaded_file($routeImage, $routeDestination)) {
                    $nameRoute = $routeDestination;
                } else {
                    echo '<script src="./alert/registerError.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                }
            }


            $response = $this->model->updateInvoiceVoucherId($Iid, $routeNameImage);

            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "pos-all-register-detail?invoiceId=' . $Iid . '&discountId=' . $Did . '&courseId=' . $Cid . '&userId=' . $Uid . '"; }, 1000); </script>';

            return $response;
        }
    }
    
    public function updateInvoiceQuotaHourId()
    {
        if (isset($_POST["submit-invoice-quota-hour-update"])) {


            $Iid = $_POST['Iid'];
            $Did = $_POST['Did'];
            $Cid = $_POST['Cid'];
            $Uid = $_POST['Uid'];
            $QHid = $_POST['QHid'];
            $QHidA = $_POST['QHidA'];


            $getQuotaHourId = $this->model->getQuotaHourId($Iid, $QHid);


            if (!$getQuotaHourId) {
                echo '<script> setTimeout(function(){ window.location = "pos-all-register-detail?invoiceId=' . $Iid . '&discountId=' . $Did . '&courseId=' . $Cid . '&userId=' . $Uid . '"; }, 1000); </script>';
            } else {
                $response = $this->model->updateInvoiceQuotaHourId($Iid, $QHid);
                if ($response) {
                    $this->model->updateStockCourseMenos($QHidA);
                    $this->model->updateStockCourseMas($QHid);
                    echo '<script src="./alert/updateSuccess.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
                } else {
                    echo '<script src="./alert/updateError.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
                }
                echo '<script> setTimeout(function(){ window.location = "pos-all-register-detail?invoiceId=' . $Iid . '&discountId=' . $Did . '&courseId=' . $Cid . '&userId=' . $Uid . '"; }, 1000); </script>';
            }
        }
    }

    public function updateInvoiceQuotaHour()
    {
        if (isset($_POST["submit-invoice-update"])) {

            $Iid = $_POST['Iid'];
            $Cid = $_POST['Cid'];
            $Uid = $_POST['Uid'];
            $Did = $_POST['Did'];
            $QHid = $_POST['QHid'];     // El disminuye
            $QHidA = $_POST['QHidA'];   // El aumenta

            $getInvoiceQuotaHour = $this->model->getInvoiceQuotaHour($Iid, $Cid, $QHid);

            if (!$getInvoiceQuotaHour) {
                echo '<script> setTimeout(function(){ window.location = "pos-all-register-detail?invoiceId=' . $Iid . '&discountId=' . $Did . '&courseId=' . $Cid . '&userId=' . $Uid . '"; }, 1000); </script>';
            } else {
                $response = $this->model->updateInvoiceQuotaHour($Iid, $Cid, $QHid);
                if ($response) {
                    $this->model->updateStockCourseMenos($QHid);
                    $this->model->updateStockCourseMas($QHidA);
                    echo '<script src="./alert/updateSuccess.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
                } else {
                    echo '<script src="./alert/updateError.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
                }
                echo '<script> setTimeout(function(){ window.location = "pos-all-register-detail?invoiceId=' . $Iid . '&discountId=' . $Did . '&courseId=' . $Cid . '&userId=' . $Uid . '"; }, 1000); </script>';
            }
        }
    }

    public function updateInvoiceVoucherMyRegisterId()
    {
        if (isset($_POST["submit-invoice-voucher-update"])) {

            $NumberVoucher = include './class/random_voucher.php'; // Ajusta la ruta según la ubicación de tu archivo randow.php

            $Iid = $_POST['Iid'];
            $Did = $_POST['Did'];
            $Cid = $_POST['Cid'];
            $Uid = $_POST['Uid'];

            if (!empty($_FILES['imagen']['name'])) {
                $nameTypeImage = $_FILES['imagen']['name'];
                $routeNameImage = 'TSE-CDP-COMP-' . $NumberVoucher . '-' . $nameTypeImage;
                $routeImage = $_FILES['imagen']['tmp_name'];
                $directory = "./../assets/image/system/voucher/";
                $routeDestination = $directory . 'TSE-CDP-COMP-' . $NumberVoucher . '-' . $nameTypeImage;
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                if (move_uploaded_file($routeImage, $routeDestination)) {
                    $nameRoute = $routeDestination;
                } else {
                    echo '<script src="./alert/registerError.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                }
            }


            $response = $this->model->updateInvoiceVoucherId($Iid, $routeNameImage);

            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "pos-my-register-detail?invoiceId=' . $Iid . '&discountId=' . $Did . '&courseId=' . $Cid . '&userId=' . $Uid . '"; }, 1000); </script>';

            return $response;
        }
    }
    public function updateInvoiceQuotaHourMyRegisterId()
    {
        if (isset($_POST["submit-invoice-quota-hour-update"])) {


            $Iid = $_POST['Iid'];
            $Did = $_POST['Did'];
            $Cid = $_POST['Cid'];
            $Uid = $_POST['Uid'];
            $QHid = $_POST['QHid'];
            $QHidA = $_POST['QHidA'];


            $getQuotaHourId = $this->model->getQuotaHourId($Iid, $QHid);


            if (!$getQuotaHourId) {
                echo '<script> setTimeout(function(){ window.location = "pos-my-register-detail?invoiceId=' . $Iid . '&discountId=' . $Did . '&courseId=' . $Cid . '&userId=' . $Uid . '"; }, 1000); </script>';
            } else {
                $response = $this->model->updateInvoiceQuotaHourId($Iid, $QHid);
                if ($response) {
                    $this->model->updateStockCourseMenos($QHidA);
                    $this->model->updateStockCourseMas($QHid);
                    echo '<script src="./alert/updateSuccess.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
                } else {
                    echo '<script src="./alert/updateError.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
                }
                echo '<script> setTimeout(function(){ window.location = "pos-my-register-detail?invoiceId=' . $Iid . '&discountId=' . $Did . '&courseId=' . $Cid . '&userId=' . $Uid . '"; }, 1000); </script>';
            }
        }
    }



    public function updateInvoiceDiscountId()
    {
        if (isset($_POST["submit-invoice-discount-update"])) {


            $Iid = $_POST['Iid'];
            $Did = $_POST['Did'];
            $Cid = $_POST['Cid'];
            $Uid = $_POST['Uid'];

            $response = $this->model->updateInvoiceDiscountId($Iid, $Did);
            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> setTimeout(function(){ window.location = "pos-all-register-detail?invoiceId=' . $Iid . '&discountId=' . $Did . '&courseId=' . $Cid . '&userId=' . $Uid . '"; }, 1000); </script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
        }
    }


    /* PAGINACION  */


    public function getMyCourseOnlineById($invoiceId)
    {
        $response = $this->model->getMyCourseOnlineById($invoiceId);
        return $response;
    }


    public function getCourseByPerson($invoiceId)
    {
        $response = $this->model->getCourseByPerson($invoiceId);
        return $response;
    }


    public function getAllMyCourse($userId)
    {
        $response = $this->model->getAllMyCourse($userId);
        return $response;
    }



    public function getMyCourseById($courseId)
    {
        // return $this->model->getMyCourseById($courseId);

    }


    public function getMyCoursePagination($inicio, $itemsPorPagina)
    {
        return $this->model->getMyCoursePagination($inicio, $itemsPorPagina);
    }


    public function searchMyCourse($name)
    {
        $searchCourse = $this->model->searchMyCourse($name);
        return $searchCourse;
    }

    public function searchMyCourseUser($search, $userId)
    {
        $searchCourse = $this->model->searchMyCourseUser($search, $userId);
        return $searchCourse;
    }

    public function countAllMyCourse()
    {
        $response = $this->model->countAllMyCourse();
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }

    public function countMyCourse()
    {
        $response = $this->model->countMyCourse();
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }
    public function countMyCourseUser($userId)
    {
        $response = $this->model->countMyCourseUser($userId);
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }




    ////////////////////////////////////////// 
    /// POS INVOICE
    public function countMyCoursePOS()
    {
        $response = $this->model->countMyCourse();
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }



    ///////////////////////////////////////
    //////// PAYMENT TYPES


    public function getPaymentType()
    {
        $response = $this->model->getPaymentType();
        return $response;
    }








    ////////////////////////////////////////////////////////////







    /////////////////////////////////////////////////////////





    public function searchInvoiceOnline($name)
    {
        $searchCourse = $this->model->searchInvoiceOnline($name);
        return $searchCourse;
    }
    public function searchInvoiceGeneral($name)
    {
        $searchCourse = $this->model->searchInvoiceGeneral($name);
        return $searchCourse;
    }

    public function getAllInvoiceOnline()
    {
        $response = $this->model->getAllInvoiceOnline();
        return $response;
    }
    public function getAllInvoiceGenerales()
    {
        $response = $this->model->getAllInvoiceGenerales();
        return $response;
    }

    public function countInvoiceOnline()
    {
        $response = $this->model->countInvoiceOnline();
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }
    public function moduloMyRegisterGenerales($Modulo)
    {
        $searchCourse = $this->model->moduloMyRegisterGenerales($Modulo);
        return $searchCourse;
    }


    public function searchInvoicePerson($name)
    {
        $searchCourse = $this->model->searchInvoicePerson($name);
        return $searchCourse;
    }

    public function getAllInvoicePerson()
    {
        $response = $this->model->getAllInvoicePerson();
        return $response;
    }

    public function countInvoicePerson()
    {
        $response = $this->model->countInvoicePerson();
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }


    ////////////////////////////////////////////////////

    public function getAllPaymentStatus()
    {
        $response = $this->model->getAllPaymentStatus();
        return $response;
    }



    public function invoiceUpdateStatusId()
    {
        if (isset($_POST["invoice-online-status-update"])) {

            $Iid = $_POST['Iid'];
            $Did = $_POST['Did'];
            $Cid = $_POST['Cid'];
            $Uid = $_POST['Uid'];
            $PSid = $_POST['PSid'];
            $INVN = $_POST['INVN'];

            $response = $this->model->invoiceUpdateStatusId($Iid, $PSid, $INVN);

            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "inscription-online-detail?invoiceId=' . $Iid . '&discountId=' . $Did . '&courseId=' . $Cid . '&userId=' . $Uid . '"; }, 1000); </script>';

            return $response;
        }
    }

    public function invoiceUpdateStatusPersonId()
    {
        if (isset($_POST["invoice-person-status-update"])) {

            $Iid = $_POST['Iid'];
            $Did = $_POST['Did'];
            $Cid = $_POST['Cid'];
            $Uid = $_POST['Uid'];
            $PSid = $_POST['PSid'];
            $INVN = $_POST['INVN'];


            $response = $this->model->invoiceUpdateStatusPersonId($Iid, $PSid, $INVN);

            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "inscription-person-detail?invoiceId=' . $Iid . '&discountId=' . $Did . '&courseId=' . $Cid . '&userId=' . $Uid . '"; }, 1000); </script>';

            return $response;
        }
    }
}
