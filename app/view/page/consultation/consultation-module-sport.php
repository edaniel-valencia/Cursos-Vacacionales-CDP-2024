<?php

$Uname     = $_SESSION['Uname'];
$Ulastname = $_SESSION['Ulastname'];

include 'consultation-pagination.php';

$invoiceController = new InvoiceController();
$paymentStatus = $invoiceController->getAllPaymentStatus();

$consultationController = new ConsultationController();
$sport = $consultationController->getAllSport();
$module = $consultationController->getAllModule();

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
                                <h2 class="card-title">Consultas & Reportes</h2>
                            </div>

                            <div class="row">
                                <div class="form-group d-flex col-lg-12">
                                    <div class="d-flex">
                                        <div class=" ">
                                            <a class="text-center btn btn-primary  rounded-pill" href="consultation-module-sport">
                                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                            </a>
                                            <?php if (
                                                isset($_GET['module']) && !empty($_GET['module']) && isset($_GET['sport']) && !empty($_GET['sport'])
                                            ) {
                                                $moduleId = $_GET['module'];
                                                $sportId  = $_GET['sport'];
                                            ?>
                                                <?php if (in_array('button-excel-module-sport', $rutas)) : ?>
                                                    <a class="text-center btn btn-success rounded-pill" target="_blank" href="./view/page/report/excel-consultation-module-sport.php?moduleId=<?php echo $moduleId . '&sportId=' . $sportId . '&Uname=' . $Uname . '&Ulastname=' . $Ulastname; ?>">
                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (in_array('button-excel-module-sport-value', $rutas)) : ?>
                                                    <a class="text-center btn btn-success rounded-pill" target="_blank" href="./view/page/report/excel-consultation-module-sport-value.php?moduleId=<?php echo $moduleId . '&sportId=' . $sportId . '&Uname=' . $Uname . '&Ulastname=' . $Ulastname; ?>">
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
                                                        <div class="d-flex col-md-6">
                                                            <select name="module" id="module" class="form-control rounded-pill" required>
                                                                <option value="">Selecciona un módulo</option>
                                                                <?php foreach ($module as $Mrow) { ?>
                                                                    <option value="<?php echo $Mrow["Mid"]; ?>" <?php if (isset($_GET['module']) && $_GET['module'] == $Mrow["Mid"]) echo 'selected'; ?>>
                                                                        <?php echo $Mrow["Mname"] . ' DEL AÑO ' . $Mrow["Myear"]; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="d-flex col-md-5">
                                                            <select name="sport" id="sport" class="form-control rounded-pill" required>
                                                                <option value="">Selecciona un deporte</option>
                                                                <?php foreach ($sport as $Srow) { ?>
                                                                    <option value="<?php echo $Srow["Sid"]; ?>" <?php if (isset($_GET['sport']) && $_GET['sport'] == $Srow["Sid"]) echo 'selected'; ?>>
                                                                        <?php echo $Srow["Sname"]; ?>
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

                            <!-- <div class="container">
                                <div class="d-flex justify-content-center">
                                    <div id="new-section">
                                        <h5 class="text-center">
                                            <?php if (in_array('button-excel-module-sport-hour-value', $rutas)) : ?>
                                                <b id="new-total-value"></b>  <br>
                                            <?php endif; ?>
                                           <b id="new-total-inscription"> </b> inscripciones
                                        </h5>
                                    </div>
                                </div>
                            </div> -->

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
                            <th>Deporte</th>
                            <th>Horario</th>
                            <th>Escenario</th>
                            <th>Inscripción</th>
                            <th>Cupos</th>
                            <th>Ganancias</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $TotalInscription = 0;
                        $Count = 0;

                        foreach ($consultation as $row) {
                            // $Discount = $row['Dvalue'] * $row['CIprice'];
                            // $Total = $row['CIprice'] - $Discount;
                            // $TotalInscription = $TotalInscription + $Total;
                            // $Count = $Count + 1;

                        ?>
                            <tr>
                                <td>
                                    <div class=" align-items-center">
                                    
                                        <div class="media-support-info">
                                            <h6><?php echo $row["Sname"]?></h6>
                                            <p class="mb-0 text-gray"><?php echo $row["Mname"] ?></p>
                                        </div>
                                    </div>
                                    </div>
                                </td>
                              
                                <td>
                                    <div class=" align-items-center">
                                            <h6><?php echo $row["QHstart"] . ' ' . $row['QHend'] ?></h6>
                                    </div>
                                </td>
                                
                                <td>
                                    <div class=" align-items-center">
                                        <h6><?php echo $row["Ename"] ?></h6>
                                    </div>
                                </td>
                                <td>
                                    <div class=" align-items-center">
                                        <h6><?php echo $row["Amount"] ?></h6>
                                    </div>
                                </td>
                                <td>
                                    <div class=" align-items-center">
                                        <h6><?php echo $row["QHquota"] ?></h6>
                                    </div>
                                </td>
                                <td>
                                    <div class=" align-items-center">
                                    <h6><?php echo number_format($row["Profits"], 2); ?></h6>
                                    </div>
                                </td>
                                <!-- <td>
                                    <div class=" align-items-center">
                                        <?php
                                        foreach ($paymentStatus as $sts) {
                                            if ($sts["PSid"] == $row["PSid"]) {
                                        ?>
                                                <h6><span class="badge bg-<?php echo $sts['PScolor'] ?>"><?php echo $sts['PSname'] ?></span></h6>
                                        <?php }
                                        } ?>
                                    </div>
                                </td> -->

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

                <!-- <center>
                    <h3><b id="total-value"><?php echo '$' . number_format($TotalInscription, 2); ?></b></h3>
                    <h5><b id="total-inscription"><?php echo $Count; ?></b> inscripciones </h5>
                </center> -->
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