<?php
class DiscountController
{
    private $model;
    public function __construct()
    {
        $this->model = new DiscountModel(ConnectionDB::getInstance());
    }

    public function getAllDiscount()
    {
        $response = $this->model->getAllDiscount();
        return $response;
    }
    public function getDiscountById($Did)
    {
        $response = $this->model->getDiscountById($Did);
        return $response;
    }

    public function getDiscountPagination($inicio, $itemsPorPagina)
    {
        return $this->model->getDiscountPagination($inicio, $itemsPorPagina);
    }

    public function countDiscount()
    {
        return $this->model->countDiscount();
    }

    public function searchDiscount($name)
    {
        $searchDiscount = $this->model->searchDiscount($name);
        return $searchDiscount;
    }
    
    public function countAllDiscount()
    {
        $response = $this->model->countAllDiscount();
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }

    public function createDiscount()
    {
        if (isset($_POST["submit-discount-add"])) {
            echo "<script>function keepFormDiscount(){document.getElementById('percentage').value = '" . htmlspecialchars($_POST['percentage'], ENT_QUOTES) . "';}</script>";

            $percentage = $_POST['percentage'];
            $value = $percentage / 100;
            $description = $_POST['description'];
                          
            $response = $this->model->createDiscount($percentage, $value, $description);
            if ($response) {
                echo '<script src="./alert/registerSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormDiscount(); });</script>';
            } else {
                echo '<script src="./alert/registerError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormDiscount(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "discount-list"; }, 1000); </script>';
        }
    }

    public function updateDiscount()
    {
        if (isset($_POST["submit-discount-update"])) {
            $id = $_POST['id'];
            $Dpercentage = $_POST['Dpercentage'];
            $Ddescription = $_POST['Ddescription'];
            $pagina = $_POST['pagina'];
            $status = $_POST['status'];
    
            $response = $this->model->updateDiscount($id, $Dpercentage, $Ddescription, $status);
            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormDiscount(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormDiscount(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "discount-list?pagination=' . $pagina . '"; }, 1000); </script>';
        }
    }

    public function deleteDiscount()
    {
        if (isset($_POST["submit-discount-delete"])) {
            $id = $_POST['id'];
            // $countDiscount = $this->model->getByIdDiscount($id);
            // if ($countDiscount > 0) {
            //     echo '<script src="./alert/deleteErrorRelation.js"></script>';
            // } else {
                $deletedDiscount = $this->model->deleteDiscount($id);
                if ($deletedDiscount) {
                    echo '<script src="./alert/deleteSuccess.js"></script>';
                } else {
                    echo '<script src="./alert/deleteError.js"></script>';
                }
                echo '<script> setTimeout(function(){ window.location = "discount-list"; }, 1000); </script>';
            }
        // }
    }
}
