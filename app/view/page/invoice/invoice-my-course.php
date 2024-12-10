<?php
$statusController = new StatusController();
$status = $statusController->getStatus();
$statusPay = $statusController->getStatusPay();
include 'invoice-validation.php';
include 'invoice-pagination.php';
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
                                <div class="form-group col-md-8">
                                    <form class="d-flex" method="GET">
                                        <div class="input-group ">
                                            <input type="text" class="form-control" name="search" id="search" placeholder="Buscar...">
                                            <button type="submit" id="submit-btn-add" class="btn btn-primary">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="form-group col-md-4">
                                    <a class="text-center btn btn-primary " href="course-available">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        <span>Cursos</span>
                                    </a>
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
                            <th>Referencia</th>
                            <!-- <th>Precio</th> -->
                            <th>Deporte</th>
                            <th>Módulo</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $modal_counter = 1;
                        foreach ($mycourses as $row) {
                        ?>
                            <tr>
                                <td style="width: 3%;">
                                    <div class="d-flex align-items-center">
                                        <h6><?php echo 'TSE-CDP-CV-'.$row["Iid"].'-'.$row['Myear'] ?></h6>
                                    </div>
                                </td>
                                <td style="width: 5%;">
                                    <div class="d-flex align-items-center">
                                        <h6><?php echo $row["Sname"] ?></h6>
                                    </div>
                                </td>
                               
                                <td>
                                    <div class="d-flex align-items-center">
                                        <h6><?php echo $row["Mname"] ?></h6>
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
                                        <h6><a type="button" href="invoice-my-course-detail?invoiceId=<?php echo $row['Iid'] . '&courseId=' . $row['Cid'] . '&userId=' . $row['Uid']. '&status=' . $row['PSid'] ?>" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a></h6></a></h6>
                                    </div>
                                </td>
                            </tr>
                        <?php  }  ?>
                    </tbody>
                </table>

                <?php
                if (empty($mycourses)) {
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

                        <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>"><a class="page-link" href="?pagination=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPage) : ?>
                            <li class="page-item"><a class="page-link" href="?pagination=<?php echo ($page + 1); ?>">Siguiente</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>