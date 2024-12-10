<?php
class PermissionController
{
    private $model;
    public function __construct()
    {
        $this->model = new PermissionModel(ConnectionDB::getInstance());
    }

    public function ViewPermissions()
    {
        $response = $this->model->getAllPermissions();
        return $response;
    }

    public function getPermissionsPagination($start, $itemPage)
    {
        $getPermissionsPagination = $this->model->getPermissionsPagination($start, $itemPage);
        return $getPermissionsPagination;
    }

    public function countPermissions()
    {
        $countPermissions = $this->model->countPermissions();
        return $countPermissions;
    }

    public function searchPermissions($name)
    {
        $searchPermissions = $this->model->searchPermissions($name);
        return $searchPermissions;
    }

    public function createPermission()
    {
        if (isset($_POST["submit-permission-add"])) {
            echo "<script>function keepFormCRol(){document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';}</script>";

            $name = $_POST['name'];

            if ($this->model->uniqueName($name)) {
                echo '<script src="./alert/duplicateRole.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
                return;
            }
            $createPermission = $this->model->createPermission($name);
            if ($createPermission) {
                echo '<script src="./alert/registerSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/registerError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "permission-list"; }, 1000); </script>';
            return $createPermission;
        }
    }

    public function updatePermission()
    {
        if (isset($_POST["submit-permission-update"])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $status = $_POST['status'];
            $page = isset($_POST['pagina']) ? $_POST['pagina'] : null;

            $updatePermission = $this->model->updatePermission($id, $name, $status);
            if ($updatePermission) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormURol(); });</script>';
                if ($page > 1) {
                    echo '<script> setTimeout(function(){ window.location = "permission-list?pagination=' . $page . '"; }, 1000); </script>';
                } else {
                    echo '<script> setTimeout(function(){ window.location = "permission-list"; }, 1000); </script>';
                }
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormURol(); });</script>';
            }
           
        }
    }

    public function deletePermission()
    {
        if (isset($_POST["submit-permission-delete"])) {
            $id = $_POST['id'];
            $getByIdPermission = $this->model->getByIdPermission($id);
            if ($getByIdPermission > 0) {
                echo '<script src="./alert/deleteErrorRelation.js"></script>';
            } else {
                $deletedPermission = $this->model->deletePermission($id);

                if ($deletedPermission) {
                    echo '<script src="./alert/deleteSuccess.js"></script>';
                } else {
                    echo '<script src="./alert/deleteError.js"></script>';
                }
                echo '<script> setTimeout(function(){ window.location = "permission-list"; }, 1000); </script>';

                return $deletedPermission;
            }
        }
    }
}
