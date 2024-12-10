
<!-- TITLE START -->
<?php
$discountController = new DiscountController();
$discountController->createDiscount();
$discountController->updateDiscount();
$discountController->deleteDiscount();
include 'discount-validation.php';
include 'discount-pagination.php';
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
                                <h2 class="card-title">Lista de Descuentos</h2>
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
                                    <a class="text-center btn btn-primary" data-bs-toggle="modal" data-bs-target="#discount-add">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        <span>Agregar</span>
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
                            <th>N°</th>
                            <th>Descuentos disponibles</th>
                            <th>Valor</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $modal_counter = 0;
                        foreach ($discount as $row) {
                        ?>
                            <tr>
                                <td style="width: 3%;">
                                    <div class="d-flex align-items-center">
                                        <h6><?php echo $row["Did"] ?></h6>
                                    </div>
                                </td>
                               
                                <td>
                                    <div class="d-flex align-items-center">
                                        <h6><?php echo $row["Dpercentage"]. ' % de ' .$row["Ddescription"] ?></h6>
                                    </div>
                                </td>
                                <td style="width: 10%;">
                                    <div class="d-flex align-items-center">
                                        <h6><?php echo $row["Dvalue"] ?></h6>
                                    </div>
                                </td>
                                <td style="width: 10%;">
                                    <div class="d-flex align-items-center">
                                        <?php
                                        $statusController = new StatusController();
                                        $status = $statusController->getStatus();
                                        foreach ($status as $sts) {
                                            if ($sts["Scodigo"] == $row["Dstatus"]) {
                                        ?>
                                                <h6><span class="badge bg-<?php echo $sts['Scolor'] ?>"><?php echo $sts['Sname'] ?></span></h6>
                                        <?php }
                                        } ?>
                                    </div>
                                </td>
                                <td style="width: 10%;">
                                    <?php include 'discount-modal.php';  ?>
                                </td>
                            </tr>
                        <?php  }  ?>
                    </tbody>
                </table>

                <?php
                if (empty($discount)) {
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

<div class="modal fade" id="discount-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Asignación de nuevos Descuentos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="formCreate">
                    <div class="card-body">
                        <div class="new-user-info">
                            <div class="row">
                                
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="percentage" name="percentage" placeholder="TSoftec" data-bs-toggle="tooltip" title="Agregar Descuentos que no se repitan" required oninput="validateFormCreate()">
                                        <label for="percentage">Descuentos</label>
                                    </div>
                                   
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="description" name="description" placeholder="TSoftec" data-bs-toggle="tooltip" title="Agregar Descuentos que no se repitan" required oninput="validateFormCreate()">
                                        <label for="description">Descripción</label>
                                    </div>
                                   
                                    <div class="form-group text-center col-md-12">
                                        <button type="submit" class="btn btn-primary" id="submit-discount-add" name="submit-discount-add" disabled>
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>