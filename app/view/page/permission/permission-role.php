<?php
$permissionRoleController = new PermissionRoleController();
include 'permission-validation.php';
?>
<div class="iq-navbar-header" style="margin-top: 10%;">
    <div class="iq-header-img">
        <img src="./../assets/image/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
    </div>
</div>
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['pid']) && isset($_POST['rid']) && isset($_POST['valor'])) {
            $rid = $_POST['rid'];
            $pid = $_POST['pid'];
            $valor = $_POST['valor'];
            $permissionRoleController->updatePermission($rid, $pid,  $valor);
        }
    }
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between flex-wrap">
                    <div class="header-title">
                        <h4 class="card-title mb-0">Asignar permisos por roles</h4>
                    </div>
                    <div class="">
                        <a href="role-list" data-bs-toggle="tooltip" title="Agregar roles" class="text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            <span>Roles</span>
                        </a>
                        <a href="permission-list" data-bs-toggle="tooltip" title="Agregar permisos" class="text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            <span>Permisos</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="datatable" class="table  " role="grid" data-toggle="data-table" width="100%">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Permisos</th>
                                    <?php
                                    $permissionRoleController = new PermissionRoleController();
                                    $rolesAndPermissions = $permissionRoleController->getRolesAndPermissions();
                                    foreach ($rolesAndPermissions as $role) {
                                        echo "<th>{$role['Rname']}</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                $permisosUnicos = [];
                                foreach ($rolesAndPermissions as $RPInfo) {
                                    foreach ($RPInfo['Permisos'] as $permiso) {
                                        if (!in_array($permiso['Pname'], $permisosUnicos)) {
                                            $count++;
                                            echo "<tr>";
                                            echo "<td>{$count}</td>"; // Número de permiso
                                            echo "<td>{$permiso['Pname']}</td>"; // Nombre del permiso
                                            foreach ($rolesAndPermissions as $RPDetail) {
                                                $isChecked = in_array($permiso['Pname'], array_column($RPDetail['Permisos'], 'Pname'));
                                                $checked = $isChecked ? 'checked' : ''; // Estado del checkbox
                                                $checkboxDisabled = $permiso['RPstatus'] == 0 ? '' : ''; // Habilitar/deshabilitar el checkbox según RPstatus
                                                $checkboxTSoftec = $RPDetail['Rid'] == 5 ? 'disabled' : ''; // Bloquear el checkbox si Rid es igual a 5

                                                echo "
                                                <td class='text-center'>
                                                    <div class='form-check text-center form-switch'>
                                                        <input class='form-check-input permiso-checkbox text-center' type='checkbox' role='switch' 
                                                            data-pid='{$permiso['Pid']}' data-rid='{$RPDetail['Rid']}' 
                                                            value='1' $checked onclick='enviarDatos(this)' $checkboxDisabled $checkboxTSoftec>
                                                    </div>
                                                </td>";
                                            }
                                            echo "</tr>";
                                            $permisosUnicos[] = $permiso['Pname'];
                                        }
                                    }
                                }
                                ?>

                            </tbody>
                        </table>

                        <form id="hidden-form" method="POST">
                            <input type="hidden" id="form-rid" name="rid" value="">
                            <input type="hidden" id="form-pid" name="pid" value="">
                            <input type="hidden" id="form-valor" name="valor" value="">
                        </form>
                        <script>
                            function enviarDatos(checkbox) {
                                const rid = checkbox.getAttribute('data-rid');
                                const pid = checkbox.getAttribute('data-pid');
                                const valor = checkbox.checked ? 1 : 0;

                                document.getElementById('form-rid').value = rid;
                                document.getElementById('form-pid').value = pid;
                                document.getElementById('form-valor').value = valor;
                                document.getElementById('hidden-form').submit();
                            }
                        </script>


                    </div>
                </div>
            </div>
        </div>
    </div>