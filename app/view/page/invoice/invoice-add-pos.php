<?php

if (isset($_GET["userId"]) || isset($_GET["courseId"]) || isset($_GET["quota_hourId"]) || isset($_GET["discountId"])) {
    $userId       = intval($_GET["userId"]);
    $courseId       = intval($_GET["courseId"]);
    $quota_hourId       = intval($_GET["quota_hourId"]);
    $discountId       = intval($_GET["discountId"]);
}
$invoiceController = new InvoiceController();
$invoiceController->createInvoiceDataPOS();

include 'invoice-validation.php';
?>

<div class="iq-navbar-header" style="height: 100px;">

    <div class="iq-header-img">
        <img src="./../assets/image/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
    </div>
</div>


<!-- TITLE END -->

<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div>
        <form method="POST" enctype="multipart/form-data" id="validateFormPOSCreate">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Agregar datos de la factura</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="new-user-info">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input type="hidden" class="form-control" id="Uid" name="Uid" value="<?php echo $userId ?>">
                                            <input type="hidden" class="form-control" id="Cid" name="Cid" value="<?php echo $courseId ?>">
                                            <input type="hidden" class="form-control" id="QHid" name="QHid" value="<?php echo $quota_hourId ?>">
                                            <input type="hidden" class="form-control" id="Did" name="Did" value="<?php echo $discountId ?>">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombres" required oninput="validateFormPOSCreate()">
                                            <label for="name">Nombre</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellidos" required oninput="validateFormPOSCreate()">
                                            <label for="lastname">Apellidos</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="ruc" name="ruc" placeholder="Cédula/RUC" maxlength="13" minlength="10" required oninput="validateFormPOSCreate()">
                                            <label for="ruc">Cédula/RUC</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Correo electrónico" required oninput="validateFormPOSCreate()">
                                            <label for="email">Correo electrónico</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Correo electrónico" maxlength="13" minlength="10" required oninput="validateFormPOSCreate()">
                                            <label for="phone">Teléfono</label>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            $('.js-example-basic-single-1').select2();
                                        });
                                    </script>
                                    <div class="form-group col-md-8">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="canton" name="canton" placeholder="Correo electrónico" required oninput="validateFormPOSCreate()">
                                            <label for="canton">Dirección</label>
                                        </div>
                                    </div>



                                    <div class="form-group col-md-12">
                                        <button type="submit" id="submit-invoice-data-pos-add" class="btn btn-primary" name="submit-invoice-data-pos-add" disabled>Agregar datos de la factura</button>
                                    </div>


                                </div>
                                <!-- <div class="checkbox">
                                    <label class="form-label"><input class="form-check-input me-2" type="checkbox" value="" id="flexCheckChecked">Enable
                                        Two-Factor-Authentication</label>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>