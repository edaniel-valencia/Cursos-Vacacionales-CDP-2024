<?php

if (isset($_GET["quota-hour-scenery"]) || isset($_GET["course-id"])) {
    $QHid = $_GET["quota-hour-scenery"];
    $Cid = $_GET["course-id"];
}
$userId = $_SESSION['Uid'];
$invoiceController = new InvoiceController();
$invoiceController->createInvoiceDataOnline();

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
        <form method="POST" enctype="multipart/form-data" id="validateFormCreate">
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
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $userId ?>" required oninput="validateFormCreate()">
                                            <input type="hidden" class="form-control" id="QHid" name="QHid" value="<?php echo $QHid ?>" required oninput="validateFormCreate()">
                                            <input type="hidden" class="form-control" id="Cid" name="Cid" value="<?php echo $Cid ?>" required oninput="validateFormCreate()">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombres" required oninput="validateFormCreate()">
                                            <label for="name">Nombre</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellidos" required oninput="validateFormCreate()">
                                            <label for="lastname">Apellidos</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="ruc" name="ruc" placeholder="Cédula/RUC" maxlength="13" minlength="10" required oninput="validateFormCreate()">
                                            <label for="ruc">Cédula/RUC</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Correo electrónico" required oninput="validateFormCreate()">
                                            <label for="email">Correo electrónico</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Correo electrónico" maxlength="13" minlength="10" required oninput="validateFormCreate()">
                                            <label for="phone">Teléfono</label>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            $('.js-example-basic-single').select2();
                                        });
                                    </script>
                                    <div class="form-group col-md-8">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="canton" name="canton" placeholder="Correo electrónico" required oninput="validateFormCreate()">
                                            <label for="phone">Cantón</label>
                                        </div>
                                        <!-- <div class="form-control input-group ">
                                            <select name="canton" id="canton" class="js-example-basic-single form-control" data-style="py-0" required oninput="validateFormCreate()">
                                                <option value="">Selecciona una residencia</option>
                                                <option value="BELISARIO QUEVEDO">BELISARIO QUEVEDO</option>
                                                <option value="CARCELEN">CARCELEN</option>
                                                <option value="CENTRO HISTORICO">CENTRO HISTORICO</option>
                                                <option value="CHILIBULO">CHILIBULO</option>
                                                <option value="CHILLOGALLO">CHILLOGALLO</option>
                                                <option value="CHIMBACALLE">CHIMBACALLE</option>
                                                <option value="COCHAPAMBA">COCHAPAMBA</option>
                                                <option value="COMITE DEL PUEBLO">COMITE DEL PUEBLO</option>
                                                <option value="CONCEPCION">CONCEPCION</option>
                                                <option value="COTOCOLLAO">COTOCOLLAO</option>
                                                <option value="EL CONDADO">EL CONDADO</option>
                                                <option value="EL INCA">EL INCA</option>
                                                <option value="GUAMANI">GUAMANI</option>
                                                <option value="IÑAQUITO">IÑAQUITO</option>
                                                <option value="ITCHIMBIA">ITCHIMBIA</option>
                                                <option value="JIPIJAPA">JIPIJAPA</option>
                                                <option value="KENNEDY">KENNEDY</option>
                                                <option value="LA ARGELIA">LA ARGELIA</option>
                                                <option value="LA ECUATORIANA">LA ECUATORIANA</option>
                                                <option value="LA FERROVIARIA">LA FERROVIARIA</option>
                                                <option value="LA LIBERTAD">LA LIBERTAD</option>
                                                <option value="LA MENA">LA MENA</option>
                                                <option value="MAGDALENA">MAGDALENA</option>
                                                <option value="MARISCAL SUCRE">MARISCAL SUCRE</option>
                                                <option value="PONCEANO">PONCEANO</option>
                                                <option value="PUENGASI">PUENGASI</option>
                                                <option value="QUITUMBE">QUITUMBE</option>
                                                <option value="RUMIPAMBA">RUMIPAMBA</option>
                                                <option value="SAN BARTOLO">SAN BARTOLO</option>
                                                <option value="SAN JUAN">SAN JUAN</option>
                                                <option value="SOLANDA">SOLANDA</option>
                                                <option value="TURUBAMBA">TURUBAMBA</option>
                                            </select>
                                            <label for="canton"></label> -->
                                        <!-- </div> -->
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button type="submit" id="submit-invoice-data-add" class="btn btn-primary" name="submit-invoice-data-add" disabled>Agregar datos de la factura</button>
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