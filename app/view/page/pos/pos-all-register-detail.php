    <?php

    if (isset($_GET["invoiceId"])) {
        $invoiceId = $_GET["invoiceId"];
        $invoiceController = new InvoiceController();
        $invoiceController->updateInvoiceVoucherId();
        $invoiceController->updateInvoiceQuotaHourId();
        $invoiceController->updateInvoiceDiscountId();
        $invoiceController->updateInvoiceQuotaHour();
        $invoiceController->deleteInvoiceAll();

        $courseController = new CourseController();
        $sceneryController    = new SceneryController();
        $discountController    = new DiscountController();

        $courses = $courseController->getAllCourseTSE();
        $scenery  = $sceneryController->getAllScenery();
        $data = $invoiceController->getMyCourseOnlineById($invoiceId);
        $image = $data["Simage"];
        $imageVoucher = $data["Ivoucher"];
        $Cid = $data["Cid"];
        $quota_hour = $courseController->getInvoiceCourseByIdQH($Cid);
        $discount = $discountController->getAllDiscount();

        include 'pos-modal.php';
        include 'pos-validation.php';
    }
    ?>

    <div class="iq-navbar-header" style="height: 85px;">
        <div class="iq-header-img">
            <img src="./../assets/image/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
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
                                    <div class="media-support-info">
                                        <h4 class=""><?php echo 'CURSO DE ' . $data['Sname'] . ' - ' . $data['Ename'] ?></h4>
                                        <span><?php echo 'TSE-CDP-CV-' . $data['Iid'] . '-' . $data['Myear']  .'<br>'.  $data['Mname']  ?></span>
                                    </div>

                                </div>
                            </div>
                            <div class="d-flex nav nav-pills  text-center profile-tab">
                                <!-- <a class=" btn btn-primary rounded-pill" href="pos-all-register" data-bs-toggle="tooltip" title="Volver a la informacion anterior">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            </a> -->
                              

                                <?php if (in_array('invoice-my-course-print', $rutas)) : ?>
                                    &nbsp;
                                    <!-- <a class="rounded-pill btn btn-dark" target="_blank" href="view/page/report/comprobante-all.php?invoiceId=<?php echo $data['Iid'] ?>" data-bs-toggle="tooltip" title="Volver a la informacion anterior"> -->
                                    <a class="rounded-pill btn btn-dark" target="_blank" href="view/page/report/comprobante-all.php?invoiceId=<?php echo $data['Iid'] ?>" data-bs-toggle="tooltip" title="Volver a la informacion anterior">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (in_array('invoice-update-register', $rutas)) : ?>
                                    &nbsp;
                                    <a class="rounded-pill btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoice-change-module-<?php echo $invoiceId ?>">
                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                                <!-- <?php if (in_array('invoice-my-course-edit', $rutas)) : ?>
                                &nbsp;
                                <a class="rounded-pill btn btn-info " href="pos-web-edit?invoiceId=<?php echo $data['Iid'] ?>'&userId='<?php echo $data['Uid'] ?>'&courseId='<?php echo $data['Cid'] ?>'&quota_hourId='<?php echo $data['QHid'] ?>" data-bs-toggle="tooltip" title="Volver a la informacion anterior">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?> -->
                                <?php if (in_array('invoice-my-register-quota-hour-edit', $rutas)) : ?>
                                    &nbsp;
                                    <a class="rounded-pill btn btn-warning" data-bs-toggle="modal" data-bs-target="#invoice-my-register-quota-hour-edit-<?php echo $invoiceId ?>">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (in_array('invoice-my-register-quota-hour-edit', $rutas)) : ?>
                                    &nbsp;
                                    <a class="rounded-pill btn btn-secondary" data-bs-toggle="modal" data-bs-target="#invoice-discount-<?php echo $invoiceId ?>">
                                        <i class="fa fa-percent" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (in_array('invoice-my-register-delete', $rutas)) : ?>
                                    &nbsp;
                                    <a class="rounded-pill btn btn-danger" data-bs-toggle="modal" data-bs-target="#invoice-my-register-delete-<?php echo $invoiceId ?>">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                                <!-- <?php if (in_array('invoice-my-course-delete', $rutas)) : ?>
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
                                <h5 class="card-title"><b>Datos del deportista</b> </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class=" col-lg-8">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo $data['Uname'] . ' ' .  $data['Ulastname'] ?></h6>
                                            <p class="mb-0">Deportistas</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-4">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo $data['Ucredential']  ?></h6>
                                            <p class="mb-0">Cédula</p>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-lg-8">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo $data['Uemail'] ?></h6>
                                            <p class="mb-0">Correo Electrónico</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-4">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo $data['Uwhatsapp'] ?></h6>
                                            <p class="mb-0">Whatssap</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-8">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo $data['Ucity'] ?></h6>
                                            <p class="mb-0">Sector de residencia</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-4">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo $data['Ubirthdate'] ?></h6>
                                            <p class="mb-0">Fecha de nacimiento</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-4">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo $data['Ugender'] ?></h6>
                                            <p class="mb-0">Género</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-4">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo $data['Usize'] ?></h6>
                                            <p class="mb-0">Talla</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-4">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo $data['Ublood'] ?></h6>
                                            <p class="mb-0">Tipo de sangre</p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="header-title">
                                <h5 class="card-title"><b>Datos de mi curso</b> </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class=" col-lg-6">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo '$ ' . $data['CIprice'] ?></h6>
                                            <p class="mb-0">Valor del curso</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-6">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo $data['Kname']  ?></h6>
                                            <p class="mb-0">Kit deportivo</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-6">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo  $data['Ddescription'] . ' ' . $data['Dpercentage'] . '%' ?></h6>
                                            <p class="mb-0">Descuento</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-6">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo $data['QHstart'] . ' - ' . $data['QHend']   ?></h6>
                                            <p class="mb-0">Horario</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-6">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo $data['QHday']   ?></h6>
                                            <p class="mb-0">Días de entrenamiento</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-6">
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6><?php echo $data['Ename']   ?></h6>
                                            <p class="mb-0">Escenarios</p>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-lg-12">
                                    <br>
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="ms-3">
                                            <h6>DESCRIPCIÓN DEL CURSO</h6>
                                            <p class="mb-0"><?php echo $data['Mname'] . ', ' . $data['Mdescription'] . '.'  ?></p>
                                            <!-- <p class="mb-0"><?php echo $data['PTid']  ?></p> -->
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
                    <div class="card-header">
                        <center>
                            <?php if (in_array('bottom-update-voucher', $rutas)) : ?>
                                <a class="btn btn-primary rounded-pill  " data-bs-toggle="modal" data-bs-target="#invoice-edit-voucher-<?php echo $invoiceId ?>">
                                    <i class="fa fa-image" aria-hidden="true"></i>
                                    <span>Actualizar Voucher</span>
                                </a>
                            <?php endif; ?>
                        </center>
                    </div>
                    <div class="card-body">

                        <div class="img-fluid"><img style="border-radius: 15px;" width="100%" src="./../assets/image/system/voucher/<?php echo $imageVoucher ?>" alt="story-img" class="avatar-0"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>