<?php

$Uname     = $_SESSION['Uname'];
$Ulastname = $_SESSION['Ulastname'];

include 'consultation-pagination.php';

$invoiceController = new InvoiceController();
$paymentStatus = $invoiceController->getAllPaymentStatus();

// $moduleController   = new ModuleController();
// $module = $moduleController->getAllModule();

$consultationController = new ConsultationController();
$module = $consultationController->getAllModule();
$sport = $consultationController->getAllSport();



?>

<div class="iq-navbar-header" style="margin-top: 8%;">
    <div class="iq-header-img">
        <img src="./../assets/image/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
    </div>
</div>
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="container-fluid iq-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flex-wrap d-flex justify-content-between align-items-center">
                            <div class="form-group">
                                <h2 class="card-title">Reporte para el seguro</h2>
                            </div>

                            <div class="row">
                                <div class="form-group d-flex col-lg-12">
                                    <div class="d-flex">
                                        <div class=" ">
                                            <a class="text-center btn btn-primary  rounded-pill" href="consultation-module">
                                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                            </a>
                                            <?php if (isset($_GET['moduleSure']) && !empty($_GET['moduleSure'])) {
                                                $moduleId = $_GET['moduleSure'];
                                            ?>

                                                <?php if (in_array('button-excel-module', $rutas)) : ?>
                                                    <a class="text-center btn btn-success rounded-pill" target="_blank" href="./view/page/report/excel-consultation-sure.php?moduleId=<?php echo $moduleId . '&Uname=' . $Uname . '&Ulastname=' . $Ulastname; ?>">
                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                    </a>
                                                <?php endif; ?>

                                            <?php } ?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="d-flex justify-content-center">
                                    <div class="row">

                                        <div class="form-group d-flex col-md-12">
                                            <form class="d-flex" method="GET">
                                                <div class="input-group">
                                                    <div class="row ">
                                                        <div class="d-flex col-md-9">
                                                            <select name="moduleSure" id="moduleSure" class="form-control rounded-pill" required>
                                                                <option value="">Selecciona un módulo</option>
                                                                <?php foreach ($module as $Mrow) { ?>
                                                                    <option value="<?php echo $Mrow["Mid"]; ?>" <?php if (isset($_GET['module']) && $_GET['module'] == $Mrow["Mid"]) echo 'selected'; ?>>
                                                                        <?php echo $Mrow["Mname"] . ' DEL AÑO ' . $Mrow["Myear"]; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                        <div class="d-flex col-md-1">

                                                            <button type="submit" class="btn btn-primary rounded-pill">
                                                                <i class="fa fa-search" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>


                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="d-flex justify-content-center">
                                    <div id="new-section">
                                        <h5 class="text-center">
                                            <?php if (in_array('button-excel-module-sport-hour-value', $rutas)) : ?>
                                                <b id="new-total-value"></b><br>
                                            <?php endif; ?>
                                            <b id="new-total-inscription"> </b> inscripciones
                                        </h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" role="grid" width="100%" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombres Completos</th>
                            <th>Cédula</th>
                            <th>Fecha de Nacimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $Count = 0;
                        foreach ($consultation as $row) {


                            $Count = $Count + 1;
                        ?>
                            <tr>
                                <td>
                                    <div class=" align-items-center">
                                        <h6><?php echo $row["Iid"] ?></h6>
                                    </div>
                                </td>
                                <td>
                                    <div class=" align-items-center">
                                        <h6><?php echo $row["Uname"] . ' ' . $row['Ulastname'] ?></h6>

                                    </div>
                                </td>
                                <td>
                                    <div class=" align-items-center">
                                        <h6><?php echo $row["Ucredential"] ?></h6>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    $birthdate = $row['Ubirthdate']; // Supongamos que $birthdate = '2012-07-16';
                                    $date = new DateTime($birthdate);
                                    $formattedDate = $date->format('d-m-Y');
                                    // echo $formattedDate; // Esto imprimirá '16-07-2012'
                                    ?>
                                    <div class=" align-items-center">
                                        <h6><?php echo $formattedDate ?></h6>
                                    </div>
                                </td>


                            </tr>
                        <?php  }

                        ?>

                    </tbody>
                </table>

                <?php
                if (empty($consultation)) {
                    if (isset($name)) {
                        $message = "No se encontraron resultados";
                    } else {
                        $message = "<b>Error 404</b>, no existen registros";
                    }
                }
                if (isset($message)) : ?>
                    <center>
                        <img src="./../assets/image/icons/3D-not-found.webp" class="text-center justify-content-between align-items-center" width="25%">
                    </center>
                    <p class=" text-center"><?php echo $message; ?> </p>
                <?php endif; ?>

                <?php if (isset($totalPage)) { ?>

                    <!-- Controles de paginación -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1) : ?>
                                <li class="page-item"><a class="page-link" href="?pagination=<?php echo ($page - 1); ?>">Anterior</a></li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                                <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>"><a class="page-link" href="?pagination=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endfor; ?>

                            <?php if ($page < $totalPage) : ?>
                                <li class="page-item"><a class="page-link" href="?pagination=<?php echo ($page + 1); ?>">Siguiente</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php } ?>


                <center>
                    <h5><b id="total-inscription"><?php echo $Count; ?></b> inscripciones </h5>
                </center>
            </div>
        </div>
    </div>
</div>




<script>
    // Esperar a que el DOM esté completamente cargado
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener el valor del primer elemento
        var totalValue = document.getElementById("total-value").innerText;

        // Asignar el valor al segundo elemento
        document.getElementById("new-total-value").innerText = totalValue;
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var totalInscription = document.getElementById("total-inscription").innerText;
        document.getElementById("new-total-inscription").innerText = totalInscription;
    });
</script>