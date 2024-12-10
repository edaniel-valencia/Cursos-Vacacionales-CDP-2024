<?php
class PermissionRoleController
{
    private $model;
    public function __construct()
    {
        $this->model = new PermissionRoleModel(ConnectionDB::getInstance());
    }

    // public function getAllRoles()
    // {
    //     $response = $this->model->getAllRoles();
    //     return $response;
    // }

    public function getAllPermissionsRoles()
    {
        $response = $this->model->getAllPermissionsRoles();
        return $response;
    }


    public function getRolesAndPermissions()
    {
        $rolesAndPermissions = $this->model->getRolesAndPermissions();
        return $rolesAndPermissions;
    }


    public function updatePermission($rid, $pid, $valor)
    {
        $updatePermission = $this->model->updatePermission($rid, $pid, $valor);
        if ($updatePermission) {
            // echo '<script src="./alert/registerSuccess.js"></script>'
            echo '<div class="bd-example">
                <div class="alert alert-solid alert-success rounded-0 alert-dismissible fade show " role="alert">
                    <span> Asignación del permiso al rol completada.</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>';
        } else {
            echo '<script src="./alert/registerError.js"></script>';
        }
        echo '<script> setTimeout(function(){ window.location = "permission-role"; }, 1500); </script>';
        return $updatePermission;
        // echo "Rid: $rid, Pid: $pid,  Valor: $valor";
    }


    public function procesarPermisos($permisos)
    {
        if (isset($_POST["permission-add"])) {
            $permisos = $_POST['permisos'];
            return $this->model->procesarPermisos($permisos);
        }
    }


    public function createPermissionRole()
    {
        if (isset($_POST["permission-add"])) {
            echo "<script>function keepFormCRol(){document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';}</script>";

            $name = $_POST['name'];

            if ($this->model->uniqueName($name)) {
                echo '<script src="./alert/duplicateRole.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
                return;
            }
            $createPermission = $this->model->createPermissionRole($name);
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

    public function updatePermissionRole()
    {
        if (isset($_POST["permission-update"])) {
            $id = $_POST['id'];
            $name = $_POST['Uname'];
            echo "<script>function keepFormCRol(){document.getElementById('Uname').value = '" . htmlspecialchars($_POST['Uname'], ENT_QUOTES) . "';}</script>";

            $updatePermission = $this->model->updatePermissionRole($id, $name);
            if ($updatePermission) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "permission-list"; }, 1000); </script>';
            return $updatePermission;
        }
    }

    public function deletePermissionRole()
    {
        if (isset($_POST["permission-delete"])) {
            $id = $_POST['id'];

            $deletedPermission = $this->model->deletePermissionRole($id);

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
