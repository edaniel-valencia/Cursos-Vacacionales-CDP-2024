<?php
class ModuleController
{
    private $model;
    public function __construct()
    {
        $this->model = new ModuleModel(ConnectionDB::getInstance());
    }

    public function getAllModule()
    {
        $response = $this->model->getAllModule();
        return $response;
    }

    public function getModulePagination($inicio, $itemsPorPagina)
    {
        return $this->model->getModulePagination($inicio, $itemsPorPagina);
    }

    public function countModule()
    {
        return $this->model->countModule();
    }

    public function searchModule($name)
    {
        $searchModule = $this->model->searchModule($name);
        return $searchModule;
    }

    public function countAllModule()
    {
        $response = $this->model->countAllModule();
        if (!empty($response)) {
            foreach ($response as $row) {
                return $row['count(*)'];
            }
        }
    }

    public function createModule()
    {
        if (isset($_POST["submit-module-add"])) {
            echo "<script>function keepFormModule(){document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';}</script>";

            $name = $_POST['name'];
            $description = $_POST['description'];
            $Fstart = $_POST['Fstart'];
            $Fend = $_POST['Fend'];
            $FIstart = $_POST['FIstart'];
            $FIend = $_POST['FIend'];
            $defaultImage = "default.png";
            if (!empty($_FILES['imagen']['name'])) {
                $nameTypeImage = $_FILES['imagen']['name'];
                $routeImage = $_FILES['imagen']['tmp_name'];
                $directory = "./../assets/image/system/module/";
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
            // $countModule = $this->model->uniqueName($name);
            // if ($countModule) {
            //     echo '<script src="./alert/duplicateRegister.js"></script>';
            //     echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormModule(); });</script>';
            //     return;
            // }
            $response = $this->model->createModule($name,  $description, $nameTypeImage, $Fstart, $Fend, $FIstart, $FIend);
            if ($response) {
                echo '<script src="./alert/registerSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormModule(); });</script>';
            } else {
                echo '<script src="./alert/registerError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormModule(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "module-list"; }, 1000); </script>';
        }
    }

    public function updateModule()
    {
        if (isset($_POST["submit-module-update"])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $pagina = $_POST['pagina'];
            $Fstart = $_POST['Fstart'];
            $Fend = $_POST['Fend'];

            $FIstart = $_POST['FIstart'];
            $FIend = $_POST['FIend'];
            
            $description = $_POST['description'];
            $status = $_POST['status'];
            $defaultImage = "default.png";
            if (!empty($_FILES['imagen']['name'])) {
                $nameTypeImage = $_FILES['imagen']['name'];
                $routeImage = $_FILES['imagen']['tmp_name'];
                $directory = "./../assets/image/system/module/";
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
            $responseModule = $this->model->getAllModule();

            foreach ($responseModule as  $row) {
                if ($row['Mimage'] === $nameTypeImage) {
                    $updateModule = $this->model->updateModuleOutName($id, $name, $description, $Fstart, $Fend, $FIstart, $FIend, $status);
                    if ($updateModule) {
                        echo '<script src="./alert/updateSuccess.js"></script>';
                        echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormModule(); });</script>';
                    } else {
                        echo '<script src="./alert/updateError.js"></script>';
                        echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormModule(); });</script>';
                    }
                    echo '<script> setTimeout(function(){ window.location = "module-list"; }, 1000); </script>';
                    return;
                }
            }
            $updateModule = $this->model->updateModule($id, $name, $description, $nameTypeImage, $Fstart, $Fend, $FIstart, $FIend, $status);
            if ($updateModule) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormModule(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormModule(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "module-list"; }, 1000); </script>';
        }
    }

    public function deleteModule()
    {
        if (isset($_POST["submit-module-delete"])) {
            $id = $_POST['id'];
            $countModule = $this->model->getByIdModule($id);
            if ($countModule > 0) {
                echo '<script src="./alert/deleteErrorRelation.js"></script>';
            } else {
                $deletedModule = $this->model->deleteModule($id);
                if ($deletedModule) {
                    echo '<script src="./alert/deleteSuccess.js"></script>';
                } else {
                    echo '<script src="./alert/deleteError.js"></script>';
                }
                echo '<script> setTimeout(function(){ window.location = "module-list"; }, 2000); </script>';
            }
        }
    }
}
