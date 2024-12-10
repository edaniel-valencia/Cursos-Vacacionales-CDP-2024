<!-- TITLE START -->
<?php

$posController = new PosController();


$moduleController   = new ModuleController();
$module = $moduleController->getAllModule();

$statusController = new StatusController();
$status = $statusController->getStatus();
$statusPay = $statusController->getStatusPay();

// var_dump($statusPay);
include 'pos-pagination.php';
?>

<div class="iq-navbar-header" style="margin-top: 10%;">
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
                                <h2 class="card-title">Mis cursos</h2>
                            </div>
                            <div class="row">
                                <div class="form-group d-flex col-lg-12">
                                    <div class="d-flex">
                                        <div class=" ">
                                            <a class="text-center btn btn-info  rounded-pill" href="pos-my-register">
                                                <i class="fa fa-list" aria-hidden="true"></i>
                                            </a>
                                            <?php if (isset($_GET['Dstart']) && isset($_GET['Dend']) && !empty($_GET['Dstart']) && !empty($_GET['Dend'])) { ?>
                                                <a class="text-center btn btn-success rounded-pill" href="./view/page/report/excel-pos-my-register-date.php?Dstart=<?php echo $_GET['Dstart'] . '&Dend=' . $_GET['Dend'] . '&userId=' . $userId; ?>">
                                                    <i class="fa fa-download" aria-hidden="true"></i>

                                                </a>
                                            <?php } ?>

                                            <?php if (isset($_GET['module']) && !empty($_GET['module'])) { ?>
                                                <a class="text-center btn btn-success rounded-pill" href="./view/page/report/excel-pos-my-register-module.php?Mname=<?php echo $_GET['module'] . '&userId=' . $userId; ?>">
                                                    <i class="fa fa-download" aria-hidden="true"></i>

                                                </a>
                                            <?php } ?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <form class="d-flex" method="GET" id="autoSubmitForm">
                                        <div class="input-group">
                                            <select name="module" id="module" class="form-control" required onchange="document.getElementById('autoSubmitForm').submit();">
                                                <option value="">Módulos...</option>
                                                <?php foreach ($module as $Mrow) { ?>
                                                    <option value="<?php echo $Mrow["Mid"]; ?>" <?php if (isset($_GET['module']) && $_GET['module'] == $Mrow["Mid"]) echo 'selected'; ?>>
                                                        <?php echo $Mrow["Mname"] . ' - ' . $Mrow["Mdescription"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </form>
                                </div>

                                <div class="form-group d-flex col-md-5">
                                    <form class="d-flex" method="GET">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="Dstart" id="Dstart" required value="<?php echo isset($_GET['Dstart']) ? $_GET['Dstart'] : ''; ?>" placeholder="Buscar...">
                                            <input type="date" class="form-control" name="Dend" id="Dend" required value="<?php echo isset($_GET['Dend']) ? $_GET['Dend'] : ''; ?>" placeholder="Buscar...">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>


                                <div class="form-group col-md-4">
                                    <form class="d-flex" method="GET">
                                        <div class="input-group ">
                                            <input type="text" class="form-control" name="search" required id="search" placeholder="Buscar...">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </form>
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
                            <th>N°</th>
                            <th>Deportista</th>
                            <th>Curso & Módulo</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($myregister as $row) {
                        ?>
                            <tr>
                                <td style="width: 3%;">
                                    <div class="d-flex align-items-center">
                                        <h6><?php echo $row["Iid"] ?></h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="media-support-info">
                                            <h6><?php echo $row["Uname"] . ' ' . $row['Ulastname'] ?></h6>
                                            <p class="mb-0 text-gray"><?php echo $row["Ucredential"] ?></p>
                                        </div>
                                    </div>
                                </td>
                             

                                <td style="width: 5%;">
                                    <div class="d-flex align-items-center">
                                    <div class="media-support-info">
                                            <h6><?php echo $row["Sname"] ?></h6>
                                            <p class="mb-0 text-gray"><?php echo $row["Mname"].'-'.$row['Myear'] ?></p>
                                        </div>
                                    </div>
                                </td>

                                <td style="width: 5%;">
                                    <div class="d-flex align-items-center">
                                        <?php
                                        foreach ($statusPay as $sts) {
                                            
                                            if ($sts["PSid"] == $row["PSid"]) {
                                        ?>
                                                <h6><span class="badge bg-<?php echo $sts['PScolor'] ?>"><?php echo $sts['PSname'] ?></span></h6>
                                        <?php }
                                        } ?>
                                    </div>
                                </td>
                                <td style="width: 10%;">
                                    <div class="align-items-center">
                                        <h6><a type="button" href="pos-my-register-detail?invoiceId=<?php echo $row['Iid'] . '&discountId=' . $row['Did'] . '&courseId=' . $row['Cid'] . '&userId=' . $row['Uid'] ?>" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a></h6></a></h6>
                                    </div>
                                </td>
                            </tr>
                        <?php  }
                        ?>
                    </tbody>
                </table>

                <?php
                if (empty($myregister)) {
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



               
                    <!-- Controles de paginación -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1) : ?>
                                <li class="page-item"><a class="page-link" href="?pagination=<?php echo ($page - 1); ?>">Anterior</a></li>
                            <?php endif; ?>

                            <?php
                            if ($totalPage <= 10) {
                                for ($i = 1; $i <= $totalPage; $i++) : ?>
                                    <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>"><a class="page-link" href="?pagination=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php endfor;
                            } else {
                                if ($page <= 4) {
                                    for ($i = 1; $i <= 5; $i++) : ?>
                                        <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>"><a class="page-link" href="?pagination=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php endfor; ?>
                                    <li class="page-item"><span class="page-link">...</span></li>
                                    <li class="page-item"><a class="page-link" href="?pagination=<?php echo $totalPage; ?>"><?php echo $totalPage; ?></a></li>
                                <?php } elseif ($page > 4 && $page < $totalPage - 3) { ?>
                                    <li class="page-item"><a class="page-link" href="?pagination=1">1</a></li>
                                    <li class="page-item"><span class="page-link">...</span></li>
                                    <?php for ($i = $page - 1; $i <= $page + 1; $i++) : ?>
                                        <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>"><a class="page-link" href="?pagination=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php endfor; ?>
                                    <li class="page-item"><span class="page-link">...</span></li>
                                    <li class="page-item"><a class="page-link" href="?pagination=<?php echo $totalPage; ?>"><?php echo $totalPage; ?></a></li>
                                <?php } else { ?>
                                    <li class="page-item"><a class="page-link" href="?pagination=1">1</a></li>
                                    <li class="page-item"><span class="page-link">...</span></li>
                                    <?php for ($i = $totalPage - 4; $i <= $totalPage; $i++) : ?>
                                        <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>"><a class="page-link" href="?pagination=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endfor;
                                }
                            }
                            ?>

                            <?php if ($page < $totalPage) : ?>
                                <li class="page-item"><a class="page-link" href="?pagination=<?php echo ($page + 1); ?>">Siguiente</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
            </div>
        </div>
    </div>
</div>