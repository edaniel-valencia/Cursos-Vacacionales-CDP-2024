<?php
class SportController
{
    private $model;
    public function __construct()
    {
        $this->model = new SportModel(ConnectionDB::getInstance());
    }

    public function getAllSport()
    {
        $response = $this->model->getAllSport();
        return $response;
    }

    public function getSportPagination($inicio, $itemsPorPagina)
    {
        return $this->model->getSportPagination($inicio, $itemsPorPagina);
    }

    public function countSport()
    {
        return $this->model->countSport();
    }

    public function searchSport($name)
    {
        $searchSport = $this->model->searchSport($name);
        return $searchSport;
    }
    
    public function countAllSport()
    {
        $response = $this->model->countAllSport();
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }

    public function createSport()
    {
        if (isset($_POST["submit-sport-add"])) {
            echo "<script>function keepFormSport(){document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';}</script>";

            $name = $_POST['name'];
            $description = $_POST['description'];
            $defaultImage = "sport.png";
            if (!empty($_FILES['imagen']['name'])) {
                $nameTypeImage = $_FILES['imagen']['name'];
                $routeImage = $_FILES['imagen']['tmp_name'];
                $directory = "./../assets/image/system/Sport/";
                $routeDestination = $directory . $nameTypeImage;
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                if (move_uploaded_file($routeImage, $routeDestination)) {
                    $nameRoute = $routeDestination;
                    echo $nameRoute;
                } else {
                    echo '<script src="./alert/registerError.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                }
            } else {
                $nameTypeImage = $defaultImage;
            }
            $countSport = $this->model->uniqueName($name);
            if ($countSport) {
                echo '<script src="./alert/duplicateRegister.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormSport(); });</script>';
                return;
            }
            $Sport = $this->model->createSport($name,  $description, $nameTypeImage);
            if ($Sport) {
                echo '<script src="./alert/registerSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormSport(); });</script>';
            } else {
                echo '<script src="./alert/registerError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormSport(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "sport-list"; }, 1000); </script>';
        }
    }

    public function updateSport()
    {
        if (isset($_POST["submit-sport-update"])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $pagina = $_POST['pagina'];
            $description = $_POST['description'];
            $status = $_POST['status'];

            if (!empty($_FILES['imagen']['name'])) {
                $nameTypeImage = $_FILES['imagen']['name'];
                $routeImage = $_FILES['imagen']['tmp_name'];
                $directory = "./../assets/image/system/Sport/";
                $routeDestination = $directory . $nameTypeImage;
                if (move_uploaded_file($routeImage, $routeDestination)) {
                    $nameRoute = $routeDestination;
                } else {
                    echo '<script src="./alert/updateError.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormSport(); });</script>';
                    exit();
                }
            } else {
                $nameTypeImage = $_POST['current_image'];
            }

            $responseSport = $this->model->getAllSport();

            foreach ($responseSport as  $row) {
                if ($row['Sname'] === $name) {
                    $updateSport = $this->model->updateSportOutName($id, $description, $nameTypeImage, $status);
                    if ($updateSport) {
                        echo '<script src="./alert/updateSuccess.js"></script>';
                        echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormSport(); });</script>';
                    } else {
                        echo '<script src="./alert/updateError.js"></script>';
                        echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormSport(); });</script>';
                    }
                    echo '<script> setTimeout(function(){ window.location = "sport-list"; }, 1000); </script>';
                    return;
                }
                
            }
            $updateSport = $this->model->updateSport($id, $name, $description, $nameTypeImage, $status);
            if ($updateSport) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormSport(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormSport(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "sport-list"; }, 1000); </script>';
        }
    }

    public function deleteSport()
    {
        if (isset($_POST["submit-sport-delete"])) {
            $id = $_POST['id'];
            $countSport = $this->model->getByIdSport($id);
            if ($countSport > 0) {
                echo '<script src="./alert/deleteErrorRelation.js"></script>';
            } else {
                $deletedSport = $this->model->deleteSport($id);
                if ($deletedSport) {
                    echo '<script src="./alert/deleteSuccess.js"></script>';
                } else {
                    echo '<script src="./alert/deleteError.js"></script>';
                }
                echo '<script> setTimeout(function(){ window.location = "sport-list"; }, 2000); </script>';
            }
        }
    }
}
