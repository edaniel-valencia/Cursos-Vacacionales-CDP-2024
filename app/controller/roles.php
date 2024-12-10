<?php
class RoleController
{
    private $model;
    public function __construct()
    {
        $this->model = new RoleModel(ConnectionDB::getInstance());
    }

    public function ViewRoles()
    {
        $response = $this->model->getAllRoles();
        return $response;
    }

    public function getCountAllRoles()
    {
        $response = $this->model->getCountAllRoles();
        return $response;

    }

    public function getCountAllRolesC()
    {
        $response = $this->model->getCountAllRolesC();
        return $response;

    }

    // INICIO DE PAGINACION

    public function getRolePagination($start, $itemPage)
    {
        $getRolePagination = $this->model->getRolePagination($start, $itemPage);
        return $getRolePagination;
    }

    public function countRole()
    {
        $countRole = $this->model->countRole();
        return $countRole;
    }

    public function searchRole($name)
    {
        $searchRole = $this->model->searchRole($name);
        return $searchRole;
    }


    // FIN DE PAGINACION
    public function createRoles()
    {
        if (isset($_POST["submit-role-add"])) {
            echo "<script>function keepFormCRol(){document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';}</script>";

            $name = $_POST['name'];

            if ($this->model->uniqueName($name)) {
                echo '<script src="./alert/duplicateRole.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
                return;
            }
            $role = $this->model->createRoles($name);
            if ($role) {
                echo '<script src="./alert/registerSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/registerError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "role-list"; }, 1000); </script>';
            return $role;
        }
    }

    public function updateRole()
    {
        if (isset($_POST["submit-role-update"])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $status = $_POST['status'];
            echo "<script>function keepFormCRol(){document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';}</script>";

            $updateRole = $this->model->updateRole($id, $name, $status);
            if ($updateRole) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "role-list"; }, 1000); </script>';
        }
    }

    public function deleteRole()
    {
        if (isset($_POST["submit-role-delete"])) {
            $id = $_POST['Rid'];
            $getByIdRole = $this->model->getByIdRole($id);
            if ($getByIdRole > 0) {
                echo '<script src="./alert/deleteErrorRelation.js"></script>';
            } else {
                $deletedRole = $this->model->deleteRole($id);
                if ($deletedRole) {
                    echo '<script src="./alert/deleteSuccess.js"></script>';
                } else {
                    echo '<script src="./alert/deleteError.js"></script>';
                }
                echo '<script> setTimeout(function(){ window.location = "role-list"; }, 1500); </script>';
                return $deletedRole;
            }
        }
    }

    public function updateStatusRole()
    {
        if (isset($_POST["role-update"])) {
            $id = $_POST['id'];
            $status = $_POST['Ustatus'];
            echo "<script>function keepFormUpdateRole(){document.getElementById('Ustatus').value = '" . htmlspecialchars($_POST['Ustatus'], ENT_QUOTES) . "';}</script>";

            $updateRole = $this->model->updateStatusRole($id, $status);
            if ($updateRole) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUpdateRole(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUpdateRole(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "role-list"; }, 1000); </script>';
            return $updateRole;
        }
    }
}
