<?php
class KitController
{
    private $model;
    public function __construct()
    {
        $this->model = new KitModel(ConnectionDB::getInstance());
    }

    public function getAllKit()
    {
        $response = $this->model->getAllKit();
        return $response;
    }

    public function getKitPagination($inicio, $itemsPorPagina)
    {
        return $this->model->getKitPagination($inicio, $itemsPorPagina);
    }

    public function countKit()
    {
        return $this->model->countKit();
    }

    public function searchKit($name)
    {
        $searchKit = $this->model->searchKit($name);
        return $searchKit;
    }

    public function countAllKit()
    {
        $response = $this->model->countAllKit();
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }

    public function createKit()
    {
        if (isset($_POST["submit-kit-add"])) {
            echo "<script>function keepFormKit(){document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';}</script>";

            $name = $_POST['name'];
           
            $response = $this->model->createKit($name);
            if ($response) {
                echo '<script src="./alert/registerSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormKit(); });</script>';
            } else {
                echo '<script src="./alert/registerError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormKit(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "kit-list"; }, 1000); </script>';
        }
    }

    public function updateKit()
    {
        if (isset($_POST["submit-kit-update"])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $pagina = $_POST['pagina'];
          
            $status = $_POST['status'];
          
           
            $updateKit = $this->model->updateKit($id, $name, $status);
            if ($updateKit) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormKit(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormKit(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "kit-list"; }, 1000); </script>';
        }
    }

    public function deleteKit()
    {
        if (isset($_POST["submit-kit-delete"])) {
            $id = $_POST['id'];
            $countKit = $this->model->getByIdKit($id);
            if ($countKit > 0) {
                echo '<script src="./alert/deleteErrorRelation.js"></script>';
            } else {
                $deletedKit = $this->model->deleteKit($id);
                if ($deletedKit) {
                    echo '<script src="./alert/deleteSuccess.js"></script>';
                } else {
                    echo '<script src="./alert/deleteError.js"></script>';
                }
                echo '<script> setTimeout(function(){ window.location = "kit-list"; }, 2000); </script>';
            }
        }
    }
}
