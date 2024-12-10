<div class="iq-navbar-header" style="height:30px;">
    <div class="iq-header-img">
        <img src="./../assets/image/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
    </div>
</div>



<?php

if (isset($_GET["course-id"]) && isset($_GET["quota-hour-scenery"])) {
    $courseId = intval($_GET["course-id"]);
    $qhsId = intval($_GET["quota-hour-scenery"]);
    $userId = $_SESSION['Uid'];

    $invoiceController = new InvoiceController();
    $invoiceData = $invoiceController->getInvoiceDataId($userId, $qhsId, $courseId);
    $invoiceController->createInvoiceOnline();
    if (!empty($invoiceData)) {
        $invoiceData = $invoiceData[0];
    }

    $courseController = new CourseController();
    $course = $courseController->getCourseQHEById($qhsId, $courseId);
    // Depuración: imprimir el contenido de $course
    // echo '<pre>';
    // print_r($course);
    // echo '</pre>';

    if (!empty($course) && is_array($course)) {
        $course = $course[0];

        $imageCourse = $course["CIimage"];
        // $discount = $course["CIprice"] * $course["Dvalue"];
        $discount = 0;
        $pay = 0;
        $pay = $course["CIprice"];
        // $pay = $course["CIprice"] - $discount;

        $qhstart = date('H:i', strtotime($course['QHstart']));
        $qhend = date('H:i', strtotime($course['QHend']));

        $Mstart = strtotime($course["Mstart"]);
        $Mstart = date("d-m-Y", $Mstart);
        $Mend = strtotime($course["Mend"]);
        $Mend = date("d-m-Y", $Mend);

        include 'order-validation.php';
    } else {
        echo "No se encontraron resultados para el curso y la hora de cuota seleccionada.";
    }
}
?>


<div class="container-fluid content-inner" id="page_layout">
    <div class="row">
        <ul class="text-center iq-product-tracker py-1" id="progressbar">
            <li class="active iq-tracker-position-0 text-white" id="iq-tracker-position-1">Mi Curso</li>
            <li class="iq-tracker-position-0 text-white" id="iq-tracker-position-2">Verificar</li>
            <li class="iq-tracker-position-0 text-white" id="iq-tracker-position-3">Pago</li>
        </ul>

        <div id="cart" class="iq-product-tracker-card b-0 show">
            <div class="row">
                <div class="col-lg-8">

                    <div class="card">
                        <div class="row p-3">
                            <div class="col-lg-6">
                                <?php
                                if ($imageCourse != null) { ?>
                                    <img src="<?php echo './../assets/image/system/course/' . $imageCourse ?>" alt="avatar" id="img-update" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload-update').click()" width="100%">
                                <?php    } else { ?>
                                    <img src="./../assets/image/avatars/01.png" alt="avatar" id="img" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload-update').click()" width="100%">
                                <?php    } ?>
                            </div>
                            <div class="col-lg-6 mt-4 mt-lg-0">
                                <div class="border-bottom">
                                    <div class="d-flex flex-column align-content-between justify-items-center mb-2">

                                        <div class="d-flex justify-content-between mb-2">
                                            <h2 class="mb-0"><?php echo $course['Sname'] ?></h2>

                                            <a href="course-available" class="btn btn-icon btn-primary" data-bs-toggle="tooltip" title="Volver a la página anterior">
                                                <span class="btn-inner">
                                                    <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.4" d="M12 22.0002C6.485 22.0002 2 17.5142 2 12.0002C2 6.48624 6.485 2.00024 12 2.00024C17.514 2.00024 22 6.48624 22 12.0002C22 17.5142 17.514 22.0002 12 22.0002Z" fill="#FFFFFF"></path>
                                                        <path d="M13.4425 16.2208C13.2515 16.2208 13.0595 16.1478 12.9135 16.0018L9.42652 12.5318C9.28552 12.3908 9.20652 12.1998 9.20652 11.9998C9.20652 11.8008 9.28552 11.6098 9.42652 11.4688L12.9135 7.99683C13.2065 7.70483 13.6805 7.70483 13.9735 7.99883C14.2655 8.29283 14.2645 8.76783 13.9715 9.05983L11.0185 11.9998L13.9715 14.9398C14.2645 15.2318 14.2655 15.7058 13.9735 15.9998C13.8275 16.1478 13.6345 16.2208 13.4425 16.2208Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                        <div class=" d-flex align-items-center w-100">
                                            <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z" fill="#FFD329"></path>
                                            </svg>
                                            <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z" fill="#FFD329"></path>
                                            </svg>
                                            <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z" fill="#FFD329"></path>
                                            </svg>
                                            <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z" fill="#FFD329"></path>
                                            </svg>
                                            <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z" fill="#FFD329"></path>
                                            </svg>
                                            <h6 class="ms-2 mb-0">5.0</h6>
                                        </div>
                                        <div class="d-flex my-2">
                                            <H6 class=""><?php echo $course['Mname'] . ' - ' . $course['Mdescription'] ?></H6>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $Mstart = strtotime($course["Mstart"]);
                                $Mstart = date("d-m-Y", $Mstart);
                                $Mend = strtotime($course["Mend"]);
                                $Mend = date("d-m-Y", $Mend);
                                ?>
                                <div class="d-flex flex-column py-2">
                                    <div>

                                        <div class="border-bottom py-2">
                                            <h6><b>Horario:</b> <span class="text-primary"><?php echo $qhstart . '- ' . $qhend ?></span></h6>
                                            <h6><b>Fecha Inicial:</b> <span class="text-primary"><?php echo $Mstart ?></span></h6>
                                            <h6><b>Fecha Final:&nbsp;&nbsp;</b> <span class="text-primary"><?php echo $Mend ?></span></h6>
                                        </div>



                                    </div>

                                </div>
                                <div class="d-flex text-center  py-2">
                                    <h5 class="text-primary"> Adquirir <b>1</b> cupo </h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Valor a cancelar</h4>
                        </div>
                        <div class="card-body">
                            <!-- <div class="border-bottom">
                                <div class="d-flex justify-content-between mb-4">
                                    <h6 class="mb-0">ID de la Orden</h6>
                                    <h6 class="mb-0">ASDW11268</h6>
                                </div>

                            </div> -->
                            <div class="border-bottom mt-4">
                                <div class="d-flex justify-content-between mb-4">
                                    <h6>Subtotal</h6>
                                    <h6 class="text-primary">$<?php echo $course['CIprice'] ?></h6>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <h6>Descuento</h6>
                                    <h6 class="text-success">$<?php echo $discount ?></h6>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="d-flex justify-content-between mb-4">
                                    <h6 class="mb-0">Total de la Orden</h6>
                                    <h5 class="text-primary mb-0">$<?php echo $pay ?></h5>
                                </div>

                                <div class="d-flex">
                                    <a id="place-order" href="#payment" class="btn btn-success d-block mt-3 w-100">Verificar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="checkout" class="iq-product-tracker-card b-0">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="flex-wrap d-flex justify-content-between align-items-center ">
                                        <div class="form-group">
                                            <h3 class="card-title">Datos de la factura</h3>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <a class="btn btn-primary rounded-pill  " href="invoice-data">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-lg-12">
                                    <li class="d-flex mb-2 align-items-center">
                                        <img src="./../assets/image/icons/3D-User.webp" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                        <div>
                                            <h5><?php echo $invoiceData['IDname'] . ' ' . $invoiceData['IDlastname'] ?></h5>
                                            <p class="mb-0">Razon Social</p>
                                        </div>
                                    </li>
                                </div>

                                <div class=" col-lg-7">
                                    <li class="d-flex mb-2 align-items-center">
                                        <img src="./../assets/image/icons/3D-Email.png" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                        <div>
                                            <h5><?php echo $invoiceData['IDemail'] ?></h5>
                                            <p class="mb-0">Correo electrónico</p>
                                        </div>
                                    </li>
                                </div>
                                <div class=" col-lg-5">
                                    <li class="d-flex mb-2 align-items-center">
                                        <img src="./../assets/image/icons/3D-Credential.webp" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                        <div>
                                            <h5><?php echo $invoiceData['IDruc'] ?></h5>
                                            <p class="mb-0">RUC</p>
                                        </div>
                                    </li>
                                </div>

                                <div class=" col-lg-6">
                                    <li class="d-flex mb-2 align-items-center">
                                        <img src="./../assets/image/icons/3D-Smartphone.webp" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                        <div>
                                            <h5><?php echo $invoiceData['IDphone'] ?></h5>
                                            <p class="mb-0">Contacto</p>
                                        </div>
                                    </li>
                                </div>

                                <div class=" col-lg-6">
                                    <li class="d-flex mb-2 align-items-center">
                                        <img src="./../assets/image/icons/3D-Address.webp" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                        <div>
                                            <h5><?php echo $invoiceData['IDcanton'] ?></h5>
                                            <p class="mb-0">Residencia</p>
                                        </div>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Valor a cancelar</h4>
                        </div>
                        <div class="card-body">
                            <!-- <div class="border-bottom">
                                <div class="d-flex justify-content-between mb-4">
                                    <h6 class="mb-0">ID de la Orden</h6>
                                    <h6 class="mb-0">ASDW11268</h6>
                                </div>

                            </div> -->
                            <div class="border-bottom mt-4">
                                <div class="d-flex justify-content-between mb-4">
                                    <h6>Subtotal</h6>
                                    <h6 class="text-primary">$<?php echo $course['CIprice'] ?></h6>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <h6>Descuento</h6>
                                    <h6 class="text-success">$<?php echo $discount ?></h6>
                                </div>

                            </div>
                            <div class="mt-4">
                                <div class="d-flex justify-content-between mb-4">
                                    <h6 class="mb-0">Total de la Orden</h6>
                                    <h5 class="text-primary mb-0">$<?php echo $pay ?></h5>
                                </div>
                                <div class="d-flex justify-content-between flex-wrap">
                                    <a id="backbutton" href="#checkout" class="btn btn-primary-subtle d-block back justify-content-between">Volver</a>
                                    <a id="deliver-address" href="#payment" class="btn btn-primary d-block">Realizar Orden</a>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>
        </div>
        <div id="payment" class="iq-product-tracker-card b-0">

            <form method="POST" enctype="multipart/form-data" id="formPay">

                <div class="row">
                    <div class="col-lg-8">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0">Registrar pago</h4>
                            </div>

                            <div class="card-body">
                                <div class="new-user-info">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="profile-img-edit position-relative">
                                                <img src="./../assets/image/system/course/TSoftec.png" alt="avatar" id="img" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload').click()" width="100%">
                                                <input id="file-upload" class="file-upload" type="file" name="imagen" id="imagen" accept="image/*" style="display: none;" required onchange="fileImage()">
                                            </div>
                                            <div class="img-extension text-center">
                                                <div class="d-inline-block align-items-center">
                                                    <span>Carga comprobante de pago</span>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="row">
                                                <div class="form-group ">
                                                    <div class="form-floating">
                                                        <select name="banco_pay" id="banco_pay" class="form-control" required oninput="validateFormPay()">
                                                            <option value="">Selecciona el tipo de banco</option>
                                                            <option value="Banco del Austro">Banco del Austro</option>
                                                            <option value="Banco Bolivariano">Banco Bolivariano</option>
                                                            <option value="Banco General Ruminahui">Banco General Ruminahui</option>
                                                            <option value="Banco Internacional">Banco Internacional</option>
                                                            <option value="Banco Guayaquil">Banco Guayaquil</option>
                                                            <option value="Banco Mutualista Pichincha">Banco Mutualista Pichincha</option>
                                                            <option value="Banco Pacifico">Banco Pacifico</option>
                                                            <option value="Banco Pichincha">Banco Pichincha</option>
                                                            <option value="Produbanco">Produbanco</option>
                                                            <option value="Cooperativa JET">Cooperativa JET</option>
                                                            <option value="ServiPago">ServiPagos</option>

                                                        </select>
                                                        <label for="module">Tipo de banco</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-floating">
                                                        <input type="text" id="number_pay" name="number_pay" class="form-control" maxlength="15" minlength="3" placeholder="TSoftec" required oninput="validateFormPay()">
                                                        <label for="number_pay">Número de comprobante</label>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="form-floating">
                                                        <input type="date" name="date_pay" id="date_pay" class="form-control" placeholder="TSoftec" required oninput="validateFormPay()">
                                                        <label for="date_pay">Fecha de pago</label>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="term-condition" name="term-condition" required>
                                                        <label class="form-check-label" for="exampleCheck1">Acepto los
                                                            <a target="_blank" href="course-terms-conditions">términos</a> y
                                                            <a target="_blank" href="course-terms-conditions">condiciones</a> </label>
                                                    </div>
                                                </div>
                                                <div>
                                                    <input type="hidden" name="Uid" id="Uid" value="<?php echo $_SESSION['Uid'] ?>">
                                                    <input type="hidden" name="Cid" id="Cid" value="<?php echo $courseId ?>">
                                                    <input type="hidden" name="QHSid" id="QHSid" value="<?php echo $qhsId ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                     
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0">Valor a cancelar</h4>
                            </div>
                            <div class="card-body">
                                <!-- <div class="border-bottom">
                                    <div class="d-flex justify-content-between mb-4">
                                        <h6 class="mb-0">ID de la Orden</h6>
                                        <h6 class="mb-0">ASDW11268</h6>
                                    </div>
                                </div> -->
                                <div class="border-bottom mt-4">
                                    <div class="d-flex justify-content-between mb-4">
                                        <h6>Subtotal</h6>
                                        <h6 class="text-primary">$<?php echo $course['CIprice'] ?></h6>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <h6>Descuento</h6>
                                        <h6 class="text-success">$<?php echo $discount ?></h6>
                                    </div>

                                </div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <h6 class="mb-0">Total de la Orden</h6>
                                        <h5 class="text-primary mb-0">$<?php echo $pay ?></h5>
                                    </div>
                                    <div class="d-flex">
                                        <button name="submit-course-pay" id="submit-course-pay" class="btn btn-primary  d-block mt-3 w-100">Finalizar Pago</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 form-check d-flex align-items-center gap-3">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/cc/Banco-Pichincha.png" width="75px" alt="">
                                        <label class="form-check-label d-flex flex-column" for="StandardD">
                                            <span class="h5"><b>Banco de Pichincha</b></span>
                                            <span>N°. 3005444804 <br>Cuenta Corriente</span>
                                        </label>
                                    </div>

                                </div>
                                <center>
                                    <div class="">
                                        <br>
                                        <a class="text-white btn btn-danger mb-0" href="market://details?id=com.yellowpepper.pichincha"><i class="fa fa-mobile" style="font-size:20px" aria-hidden="true"></i> Móvil</a>
                                        &nbsp;
                                        <a class="text-white btn btn-danger mb-0" href="https://bancaweb.pichincha.com/pichincha/login"><i class="fa fa-laptop" aria-hidden="true"></i> Web
                                        </a>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>