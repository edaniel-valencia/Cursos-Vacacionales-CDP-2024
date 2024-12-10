<?php
class OrderController
{
    private $model;
    public function __construct()
    {
        $this->model = new OrderModel(ConnectionDB::getInstance());
    }

    public function getAllOrder()
    {
        $response = $this->model->getAllOrder();
        return $response;
    }

    public function createOrder()
    {
        if (isset($_POST["submit-Order-add"])) {
            echo "<script>function keepFormOrder(){document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';}</script>";

            $name = $_POST['name'];
           
            $response = $this->model->createOrder($name);
            if ($response) {
                echo '<script src="./alert/registerSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormOrder(); });</script>';
            } else {
                echo '<script src="./alert/registerError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormOrder(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "Order-list"; }, 1000); </script>';
        }
    }

    public function updateOrder()
    {
        if (isset($_POST["submit-Order-update"])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $pagina = $_POST['pagina'];
          
            $status = $_POST['status'];
          
           
            $updateOrder = $this->model->updateOrder($id, $name, $status);
            if ($updateOrder) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormOrder(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormOrder(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "Order-list?pagination=' . $pagina . '"; }, 1000); </script>';
        }
    }

    public function deleteOrder()
    {
        if (isset($_POST["submit-Order-delete"])) {
            $id = $_POST['id'];
            $countOrder = $this->model->getByIdOrder($id);
            if ($countOrder > 0) {
                echo '<script src="./alert/deleteErrorRelation.js"></script>';
            } else {
                $deletedOrder = $this->model->deleteOrder($id);
                if ($deletedOrder) {
                    echo '<script src="./alert/deleteSuccess.js"></script>';
                } else {
                    echo '<script src="./alert/deleteError.js"></script>';
                }
                echo '<script> setTimeout(function(){ window.location = "Order-list"; }, 2000); </script>';
            }
        }
    }
}
