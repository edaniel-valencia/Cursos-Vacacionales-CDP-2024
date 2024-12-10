<?php

if (isset($_GET["invoiceId"])) {
    $invoiceId = $_GET["invoiceId"];
    $invoiceController = new InvoiceController();
    $courseController = new CourseController();
    $sceneryController    = new SceneryController();



    $scenery  = $sceneryController->getAllScenery();
    $data = $invoiceController->getMyCourseOnlineById($invoiceId);
    $image = $data["Simage"];
    $imageVoucher = $data["Ivoucher"];


    $courseId = $_GET["course-id"];
    $rolId = $_SESSION['Rid'];

    $courseController = new CourseController();
    $discountController = new DiscountController();
    $moduleController   = new ModuleController();
    $sportController    = new SportController();
    $discountController    = new DiscountController();

    $course = $courseController->getCourseById($courseId);
    $discount = $discountController->getAllDiscount();

    // Depuración: imprimir el contenido de $course

    $imageCourse = $course["CIimage"];
    $status = $course["Cstatus"];
    $dataQH = $courseController->getCourseByIdQH($courseId);

    // include 'course-validation.php';
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
                        <div class="d-flex align-items-center">
                            <div class="me-3 mb-0 mb-lg-0 profile-logo">
                                <img src="<?php echo '../assets/image/system/sport/' . $image ?>" alt="User-Profile" class="avatar avatar-60 ">
                            </div>
                            <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                                <h4 class=""><?php echo 'CURSO DE ' . $data['Sname'] ?></h4>
                                <!-- <span><?php echo $data['Mname'] . ' DEL ' . $data['Mdescription']  ?></span> -->

                            </div>
                        </div>
                        <div class="d-flex nav nav-pills  text-center profile-tab">
                            <a class=" btn btn-primary rounded-pill" href="course-list" data-bs-toggle="tooltip" title="Volver a la informacion anterior">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            </a>


                            <?php if (in_array('invoice-my-course-print', $rutas)) : ?>
                                &nbsp;
                                <a class="rounded-pill btn btn-dark " href="view/page/report/report.php?invoiceId=<?php echo $data['Iid'] ?>" data-bs-toggle="tooltip" title="Volver a la informacion anterior">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                            <!-- <?php if (in_array('invoice-my-course-edit', $rutas)) : ?>
                                &nbsp;
                                <a class="rounded-pill btn btn-info " href="view/page/report/report.php?invoiceId=<?php echo $data['Iid'] ?>" data-bs-toggle="tooltip" title="Volver a la informacion anterior">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                            <?php if (in_array('invoice-my-course-delete', $rutas)) : ?>
                                &nbsp;
                                <a class="rounded-pill btn btn-danger " href="view/page/report/report.php?invoiceId=<?php echo $data['Iid'] ?>" data-bs-toggle="tooltip" title="Volver a la informacion anterior">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?> -->

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
                            <h4 class="card-title">Datos de mi curso</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class=" col-lg-6">
                                <div class="d-flex mb-2 align-items-center">
                                    <div class="ms-3">
                                        <h5><?php echo '$ ' . $data['CIprice'] ?></h5>
                                        <p class="mb-0">Valor del curso</p>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-lg-6">
                                <div class="d-flex mb-2 align-items-center">
                                    <div class="ms-3">
                                        <h5><?php echo $data['Kname']  ?></h5>
                                        <p class="mb-0">Kit deportivo</p>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-lg-6">
                                <div class="d-flex mb-2 align-items-center">
                                    <div class="ms-3">
                                        <h5><?php echo  $data['Ddescription'] . ' ' . $data['Dpercentage'] . '%' ?></h5>
                                        <p class="mb-0">Descuento</p>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-lg-6">
                                <div class="d-flex mb-2 align-items-center">
                                    <div class="ms-3">
                                        <h5><?php echo $data['QHstart'] . ' - ' . $data['QHend']   ?></h5>
                                        <p class="mb-0">Horario</p>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-lg-12">
                                <br>
                                <div class="d-flex mb-2 align-items-center">
                                    <div class="ms-3">
                                        <h5>DESCRIPCIÓN DEL CURSO</h5>
                                        <p class="mb-0"><?php echo $data['Mname'] . ', ' . $data['Mdescription'] . '.'  ?></p>
                                        <p class="mb-0"><?php echo $data['CIdescription']  ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="img-fluid"><img style="border-radius: 15px;" width="100%" src="./../assets/image/system/voucher/<?php echo $imageVoucher ?>" alt="story-img" class="avatar-0"></div>
                </div>
            </div>
        </div>
    </div>
</div>