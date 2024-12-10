<?php
$courseController = new CourseController();
$courses = $courseController->getAllCourseSport();
include 'course-pagination-available.php';

?>

<div class="iq-navbar-header" style="height: 160px;">
    <div class="container-fluid iq-container">
        <div class="row">
            <div class="col-md-12">
                <div class="flex-wrap d-flex justify-content-between align-items-center">
                    <div class="form-group">
                        <h2 class="card-title">Cursos deportivos disponibles</h2>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <form class="d-flex" method="GET">
                                <div class="input-group ">
                                    <input type="text" class="form-control" name="search" id="search" placeholder="Buscar...">
                                    <button type="submit" id="submit-btn-add" class="btn btn-primary">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- <div class="form-group col-md-4">
                                <a class="text-center btn btn-primary " href="course-add">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    <span>Agregar</span>
                                </a>
                            </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <br>
    <div class="row">
        <?php
        $modal_counter = 1;
        foreach ($courses as $row) {
            $imageSport =  $row["Simage"];
            $imageCourse =  $row["CIimage"];
        ?>
            <div class="col-xl-3 col-lg-3">
                <div class="card">
                    <div class="card-body d-grid gap-card">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class=" flex-column text-center align-items-center justify-content-between ">
                                <div class="fs-italic">
                                   
                                        <h5> <?php echo $row['Sname']; ?></h5>
                                   
                                    <h6> <b><?php echo $row['Mname']; ?></b></h6>
                                    <!-- <div class="text-muted-50 mb-1">
                                        <small> <?php echo $row['Mname']; ?></small>
                                    </div> -->
                                </div>
                                <div class="d-flex align-items-center">
                                    <?php if ($imageSport != null) { ?>
                                        <img src="<?php echo './../assets/image/system/sport/' . $imageSport ?>" alt="User-Profile" width="150px" class="theme-color-default-img img-fluid">
                                    <?php    } else { ?>
                                        <img src="./../assets/image/system/sport/TSoftec.png" alt="User-Profile" width="150px" class="theme-color-default-img img-fluid ">
                                    <?php    } ?>
                                </div>
                                <a href="course-available-detail?course-id=<?php echo $row['Cid'] ?>" class="mt-2 btn btn-primary d-block rounded"><i class="fa fa-info-circle" aria-hidden="true"></i>
                                    Detalle</a>
                                <!-- <a type="button" class="btn btn-primary btn-sm px-3 py-2  ms-1" data-bs-toggle="tooltip" title="Detalles del curso">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i> Detalle
                                    </a> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <?php
        }

        ?>

        <?php
        if (empty($courses)) {
            if (isset($name)) {
                $message = "No se encontraron resultados";
            } else {
                $message = "<b>Error 404</b>, no existen registros";
            }
        }
        if (isset($message)) : ?>
            <center>
                <img src="./../assets/image/icons/3D-not-data.png" class="text-center justify-content-between align-items-center" width="35%">
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