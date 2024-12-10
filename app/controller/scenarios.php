<?php
class SceneryController
{
    private $model;
    public function __construct()
    {
        $this->model = new SceneryModel(ConnectionDB::getInstance());
    }

    public function getAllScenery()
    {
        $response = $this->model->getAllScenery();
        return $response;
    }

    public function getSceneryPagination($inicio, $itemsPorPagina)
    {
        return $this->model->getSceneryPagination($inicio, $itemsPorPagina);
    }

    public function countScenery()
    {
        return $this->model->countScenery();
    }

    public function searchScenery($name)
    {
        $searchScenery = $this->model->searchScenery($name);
        return $searchScenery;
    }

    public function countAllScenery()
    {
        $response = $this->model->countAllScenery();
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }

    public function createScenery()
    {
        if (isset($_POST["submit-scenery-add"])) {
            echo "<script>function keepFormScenery(){document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';}</script>";

            $name = $_POST['name'];
           
            $response = $this->model->createScenery($name);
            if ($response) {
                echo '<script src="./alert/registerSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormScenery(); });</script>';
            } else {
                echo '<script src="./alert/registerError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormScenery(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "scenery-list"; }, 1000); </script>';
        }
    }

    public function updateScenery()
    {
        if (isset($_POST["submit-scenery-update"])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $pagina = $_POST['pagina'];
          
            $status = $_POST['status'];
          
           
            $updateScenery = $this->model->updateScenery($id, $name, $status);
            if ($updateScenery) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormScenery(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormScenery(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "scenery-list?pagination=' . $pagina . '"; }, 1000); </script>';
        }
    }

    public function deleteScenery()
    {
        if (isset($_POST["submit-scenery-delete"])) {
            $id = $_POST['id'];
            $countScenery = $this->model->getByIdScenery($id);
            if ($countScenery > 0) {
                echo '<script src="./alert/deleteErrorRelation.js"></script>';
            } else {
                $deletedScenery = $this->model->deleteScenery($id);
                if ($deletedScenery) {
                    echo '<script src="./alert/deleteSuccess.js"></script>';
                } else {
                    echo '<script src="./alert/deleteError.js"></script>';
                }
                echo '<script> setTimeout(function(){ window.location = "scenery-list"; }, 2000); </script>';
            }
        }
    }
}
