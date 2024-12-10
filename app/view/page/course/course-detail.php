<?php

if (isset($_GET["course-id"])) {
    $courseId = $_GET["course-id"];
    $courseController = new CourseController();
    $sceneryController    = new SceneryController();

    $courseController->createCourseQuotaHour();
    $courseController->updateCourseQuotaHour();
    $courseController->deleteCourseQuotaHour();
    $courseController->deleteCourse();
    $courseDeleted = $courseController->deleteCourse();

$statusController = new StatusController();
$status = $statusController->getStatus();
    // Redireccionar a la misma página después de eliminar el curso
    if ($courseDeleted) {
        header("Location: {$_SERVER['PHP_SELF']}");
        exit; // Asegúrate de salir después de redirigir para evitar que se ejecute más código
    }

    $scenery  = $sceneryController->getAllScenery();
    $data = $courseController->getCourseById($courseId);
    $dataQH = $courseController->getCourseByIdQHTSE($courseId);
    $image = $data["CIimage"];
    $status = $data["Cstatus"];
    include 'course-validation.php';
    include 'course-pagination.php';
    include 'course-modal.php';
}
?>
<div class="iq-navbar-header" style="height: 85px;">

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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="">
                            <h4 class=""><?php echo 'CURSO DE ' . $data['Sname'] ?></h4>
                            <span><?php echo $data['Mname'] . ' DEL ' . $data['Mdescription']  ?></span>
                        </div>
                        <div class="d-flex nav nav-pills  text-center profile-tab">
                            <?php if (in_array('course-list', $rutas)) : ?>
                                <a class="nav-link show btn btn-primary" href="course-list" data-bs-toggle="tooltip" title="Volver a la informacion anterior">
                                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                                </a>
                                <?php endif; ?>&nbsp;
                                <?php if (in_array('course-quota-hour', $rutas)) : ?>
                                    <a class="nav-link show btn btn-warning" data-bs-toggle="modal" data-bs-target="#quota-hour-add-<?php echo $courseId ?>">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                                &nbsp;
                                <?php if (in_array('course-edit', $rutas)) : ?>
                                    <a class="nav-link show btn btn-info" href="course-edit?course-id=<?php echo $courseId ?>" data-bs-toggle="tooltip" title="Editar datos del curso de <?php echo $data['Sname'] ?>">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                                &nbsp;
                                <?php if (in_array('course-delete', $rutas)) : ?>
                                    <a class="nav-link show btn btn-danger" data-bs-toggle="modal" data-bs-target="#course-delete-<?php echo $courseId ?>">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="profile-content tab-content">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h4 class="card-title">Información del curso</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class=" col-lg-5">
                                <div class="d-flex mb-2 align-items-center">
                                    <img src="./../assets/image/icons/3D-Price.png" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                    <div class="ms-3">
                                        <h5><?php echo '$ ' . $data['CIprice'] ?></h5>
                                        <p class="mb-0">Valor</p>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-lg-7">
                                <div class="d-flex mb-2 align-items-center">
                                    <img src="./../assets/image/icons/3D-kit.png" alt="story-img" class=" avatar-80 p-1 profile-story-img  img-fluid">
                                    <div class="ms-3">
                                        <h5><?php echo $data['Kname']  ?></h5>
                                        <p class="mb-0">Kit deportivo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-2">Horarios & Cupos</h4>
                        <div class="table-responsive">
                            <table id="datatable" role="grid" width="100%" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Horario</th>
                                        <th>Cupos</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $courseId = $data["Cid"];
                                    foreach ($dataQH as $row) {
                                        $QHid = $row['QHid'];
                                        if ($courseId = $QHid) {
                                    ?>
                                            <tr>
                                                <td>

                                                    <div>
                                                        <h6>
                                                            <b><?php echo $row['Ename'] ?></b>
                                                            <br><?php echo $row['QHday'] ?>
                                                            <br><?php echo $row['QHstart'] . ' - ' . $row['QHend']   ?>
                                                        </h6>
                                                    </div>

                                                </td>
                                                <td>
                                                    <h5><?php echo $row['QHquota']   ?></h5>
                                                </td>
                                                <td style="width: 10%;">
                                                    <?php include 'course-modal-detail.php'; ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                <div class="card-body">
                    <h5>Descripción del curso</h5>
                    <p class="mb-0" style="text-align: justify;"><?php echo $data['CIdescription']  ?></p>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="img-fluid"><img style="border-radius: 15px;" width="100%" src="./../assets/image/system/course/<?php echo $image ?>" alt="story-img" class="avatar-0"></div>
                </div>
            </div>
        </div>
    </div>
</div>