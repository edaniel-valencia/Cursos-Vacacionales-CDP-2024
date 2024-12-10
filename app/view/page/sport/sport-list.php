
<!-- TITLE START -->
<?php
$sportController = new SportController();
$sportController->createSport();
$sportController->updateSport();
$sportController->deleteSport();
include 'sport-validation.php';
include 'sport-pagination.php';
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
                                <h2 class="card-title">Lista de deportes</h2>
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
                                    <a class="text-center btn btn-primary " data-bs-toggle="modal" data-bs-target="#sport-add">
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
                            <th>Imagen</th>
                            <th>Deporte</th>
                            <th>C. Costos</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $modal_counter = 0;
                        foreach ($sport as $row) {
                            $imageName =  $row["Simage"]
                        ?>
                            <tr>
                                <td style="width: 5%;">
                                    <div class="d-flex align-items-center">
                                        <h6><?php echo $row["Sid"] ?></h6>
                                    </div>
                                </td>
                                <td style="width: 10%;">
                                    <div class="d-flex align-items-center">
                                        <?php if ($imageName != null) { ?>
                                            <img src="<?php echo '../assets/image/system/sport/' . $imageName ?>" class="theme-color-default-img img-fluid avatar avatar-50 avatar">
                                        <?php    } else { ?>
                                            <img src="./../assets/image/system/sport/sport.jpg" class="theme-color-default-img img-fluid avatar avatar-50 avatar-">
                                        <?php    } ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <h6><?php echo $row["Sname"] ?></h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <h6><?php echo $row["Scostos"] ?></h6>
                                    </div>
                                </td>
                                <td style="width: 10%;">
                                    <div class="d-flex align-items-center">
                                        <?php
                                        $statusController = new StatusController();
                                        $status = $statusController->getStatus();
                                        foreach ($status as $sts) {
                                            if ($sts["Scodigo"] == $row["Sstatus"]) {
                                        ?>
                                                <h6><span class="badge bg-<?php echo $sts['Scolor'] ?>"><?php echo $sts['Sname'] ?></span></h6>
                                        <?php }
                                        } ?>
                                    </div>
                                </td>
                                <td style="width: 10%;">
                                    <?php include 'sport-modal.php';  ?>
                                </td>
                            </tr>
                        <?php  }  ?>
                    </tbody>
                </table>

                <?php
                if (empty($sport)) {
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

<div class="modal fade" id="sport-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Asignación de nueva deporte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="new-user-info">
                            <div class="row">
                                <div class="form-group text-center  col-md-4">
                                    <div class="profile-img-edit position-relative">
                                        <img src="./../assets/image/avatars/01.png" alt="avatar" id="img" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload').click()" width="100%">
                                        <input id="file-upload" class="file-upload" type="file" name="imagen" id="imagen" accept="image/*" style="display: none;" onchange="fileImage()">
                                    </div>
                                    <div class="img-extension ">
                                        <div class="d-inline-block align-items-center">
                                            <span>Solo imagen:</span>
                                            <a href="javascript:void();">.jpg</a>
                                            <a href="javascript:void();">.png</a>
                                            <a href="javascript:void();">.jpeg</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-8 ">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="name" name="name" data-bs-toggle="tooltip" title="Agregar deportes que no se repitan" required oninput="validateFormCreateSport()">
                                        <label for="name">Nombre de la  deporte</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <!-- <input type="text" class="form-control" id="name" name="name" data-bs-toggle="tooltip" title="Agregar deportes que no se repitan" required oninput="validateFormCreatesport()"> -->
                                        <textarea rows="4" cols="20" class="form-control" id="description" name="description" required oninput="validateFormCreateSport()"></textarea>
                                        <label for="description">Descripción de la  deporte</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary" id="submit-sport-add" name="submit-sport-add" disabled>
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