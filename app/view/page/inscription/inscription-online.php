<!-- TITLE START -->
<?php

$invoiceController = new InvoiceController();
$paymentStatus = $invoiceController->getAllPaymentStatus();
include 'inscription-online-pagination.php';

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
                                <h2 class="card-title">Cursos Online</h2>
                            </div>
                            <div class="row">
                                <div class="form-group d-flex col-lg-12">
                                    <div class="d-flex">
                                        <div class=" ">
                                            <a class="text-center btn btn-info  rounded-pill" href="inscription-online">
                                                <i class="fa fa-list" aria-hidden="true"></i>
                                            </a>




                                        </div>
                                    </div>
                                </div>
                            </div>
                           

                            <div class="row justify-content-end">

                            <div class="form-group d-flex col-md-6">
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
                                <div class="form-group col-md-5">
                                    <form class="d-flex" method="GET">
                                        <div class="input-group ">
                                            <input type="text" class="form-control" name="search" id="search" placeholder="Buscar...">
                                            <button type="submit" id="submit-btn-add" class="btn btn-primary">
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
        <div class="card-body" >
            <div class="table-responsive" >
                <table id="datatable" role="grid" width="100%" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <!-- <th>Banner</th> -->
                            <th>Deportista</th>
                            <th>Deportes & Modulo</th>
                           
                            <!-- <th>Desc.</th> -->
                            <!-- <th>Horario</th> -->
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $modal_counter = 1;

                        foreach ($invoiceOnline as $row) {

                        ?>
                            <tr>
                                <td >
                                    <div class="d-flex justify-content-center align-items-center centered-conten">
                                    <h6><?php echo $row["Iid"] ?></h6>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                    <div class="media-support-info">
                                        <h6><?php echo $row["Uname"] . ' ' . $row['Ulastname'] ?></h6>
                                        <p style="font-size:12px"><?php echo $row["Ucredential"] ?></p>
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="d-flex align-items-center">
                                <div class="media-support-info">
                                    <h6><?php echo $row["Sname"] ?></h6>
                                    <p style="font-size:12px"><?php echo $row["Mname"] ?></p>
                                    </div>
                                    </div>
                                </td>
                               
                               
                             

                                <td style="width: 5%;">
                                    <div class="d-flex align-items-center">
                                        <?php
                                        foreach ($paymentStatus as $sts) {
                                            if ($sts["PSid"] == $row["PSid"]) {
                                        ?>
                                                <h6><span class="badge bg-<?php echo $sts['PScolor'] ?>"><?php echo $sts['PSname'] ?></span></h6>
                                        <?php }
                                        } ?>
                                    </div>
                                </td>
                                <td style="width: 10%;">
                                    <div class="align-items-center">
                                        <h6><a type="button" href="inscription-online-detail?invoiceId=<?php echo $row['Iid'] . '&discountId=' . $row['Did']  . '&courseId=' . $row['Cid'] . '&userId=' . $row['Uid'] ?>" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a></h6></a></h6>
                                    </div>
                                </td>
                            </tr>
                        <?php  }

                        ?>

                    </tbody>
                </table>

                <?php
                if (empty($invoiceOnline)) {
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