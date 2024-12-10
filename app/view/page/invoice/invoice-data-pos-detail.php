<?php

if (isset($_GET["userId"]) || isset($_GET["courseId"]) || isset($_GET["quota_hourId"]) || isset($_GET["discountId"])) {

    $userId       = intval($_GET["userId"]);
   
    $invoiceController = new InvoiceController();
    $invoiceData = $invoiceController->getInvoiceDataIdUserPos($userId);
    $invoiceController->updateInvoiceLPOS();
    include 'invoice-validation.php';
    if (!empty($invoiceData)) {
        $invoiceData = $invoiceData[0];
    }
}
?>


<div class="iq-navbar-header" style="height: 125px;">

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
                            <div class="profile-img position-relative me-3 mb-0 mb-lg-0 profile-logo profile-logo1">

                                <img src="<?php echo '../assets/image/system/user/' . $invoiceData['Uimage'] ?>" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-100 avatar-rounded">

                            </div>
                            <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                                <h4 class="me-2 h4"><?php echo $invoiceData['Uname'] . ' ' . $invoiceData['Ulastname'] ?></h4>
                                <!-- <span> - Cargo <?php echo $_SESSION['Rname'] ?></span> -->
                            </div>
                        </div>
                        <div class="d-flex nav nav-pills mb-0 text-center profile-tab">
                            <a class="btn btn-primary rounded-pill" href="user-profile">Mi Perfil</a>
                            &nbsp;
                            <a class="btn btn-primary rounded-pill" href="invoice-data">Datos de la factura</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="profile-content tab-content">
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
                                            <a class="btn btn-warning rounded-pill  " data-bs-toggle="modal" data-bs-target="#invoice-data-edit-<?php echo $userId ?>">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                <span>Editar</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-lg-7">
                                <li class="d-flex mb-2 align-items-center">
                                    <img src="./../assets/image/icons/3D-User.webp" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                    <div>
                                        <h5><?php echo $invoiceData['IDname'] . ' ' . $invoiceData['IDlastname'] ?></h5>
                                        <p class="mb-0">Razon Social</p>
                                    </div>
                                </li>
                            </div>
                         
                            <div class=" col-lg-5">
                                <li class="d-flex mb-2 align-items-center">
                                    <img src="./../assets/image/icons/3D-Email.png" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                    <div>
                                        <h5><?php echo $invoiceData['IDemail'] ?></h5>
                                        <p class="mb-0">Correo electrónico</p>
                                    </div>
                                </li>
                            </div>
                            <div class=" col-lg-4">
                                <li class="d-flex mb-2 align-items-center">
                                    <img src="./../assets/image/icons/3D-Credential.webp" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                    <div>
                                        <h5><?php echo $invoiceData['IDruc'] ?></h5>
                                        <p class="mb-0">RUC</p>
                                    </div>
                                </li>
                            </div>

                            <div class=" col-lg-4">
                                <li class="d-flex mb-2 align-items-center">
                                    <img src="./../assets/image/icons/3D-Smartphone.webp" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                    <div>
                                        <h5><?php echo $invoiceData['IDphone'] ?></h5>
                                        <p class="mb-0">Contacto</p>
                                    </div>
                                </li>
                            </div>

                            <div class=" col-lg-4">
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
        </div>
    </div>
</div>


<div class="modal fade" id="invoice-data-edit-<?php echo $userId ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar el datos de la factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="validationFormUpdate">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-floating">
                                <input type="hidden" class="form-control text-dark" id="id" name="id" value="<?php echo $invoiceData["IDid"] ?>" placeholder="TSoftec" required oninput="validateFormUpdate()">
                                <input type="text" class="form-control text-dark" id="name" name="name" value="<?php echo $invoiceData["IDname"] ?>" placeholder="TSoftec" required oninput="validateFormUpdate()">
                                <label for="name">Nombres</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control text-dark" id="lastname" name="lastname" value="<?php echo $invoiceData["IDlastname"] ?>" placeholder="TSoftec" required oninput="validateFormUpdate()">
                                <label for="lastname">Apellidos</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control text-dark" id="ruc" name="ruc" value="<?php echo $invoiceData["IDruc"] ?>" placeholder="TSoftec" required oninput="validateFormUpdate()">
                                <input type="hidden" name="userId" value="<?php echo $userId ?>">
                            <input type="hidden" name="courseId" value="<?php echo $courseId ?>">
                            <input type="hidden" name="quota_hourId" value="<?php echo $quota_hourId ?>">
                            <input type="hidden" name="discountId" value="<?php echo $discountId ?>">
                                <label for="ruc">Cédula/RUC</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control text-dark" id="email" name="email" value="<?php echo $invoiceData["IDemail"] ?>" placeholder="TSoftec" required oninput="validateFormUpdate()">
                                <label for="email">Email</label>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control text-dark" id="phone" name="phone" value="<?php echo $invoiceData["IDphone"] ?>" placeholder="TSoftec" required oninput="validateFormUpdate()">
                                <label for="phone">Teléfono</label>
                            </div>
                        </div>
                        <!-- <input type="hidden" class="form-control text-dark" id="id" name="id" value="<?php echo $row["Pid"] ?>">
                        <input type="hidden" class="form-control text-dark" id="pagina" name="pagina" value="<?php echo $pagina ?>"> -->
                        <div class="form-group col-md-12">
                            <div class="form-floating">
                            <input type="text" class="form-control text-dark" id="canton" name="canton" value="<?php echo $invoiceData["IDcanton"] ?>" placeholder="TSoftec" required oninput="validateFormUpdate()">

                                <!-- <select name="canton" id="canton" class="text-dark form-control" value="<?php echo $invoiceData["IDcanton"] ?>" data-style="py-0" required oninput="validateFormUpdate()">
                                    <option><?php echo $invoiceData["IDcanton"] ?></option>
                                    <option value="BELISARIO QUEVEDO">BELISARIO QUEVEDO</option>
                                    <option value="CARCELÉN">CARCELÉN</option>
                                    <option value="CENTRO HISTÓRICO">CENTRO HISTÓRICO</option>
                                    <option value="CHILIBULO">CHILIBULO</option>
                                    <option value="CHILLOGALLO">CHILLOGALLO</option>
                                    <option value="CHIMBACALLE">CHIMBACALLE</option>
                                    <option value="COCHAPAMBA">COCHAPAMBA</option>
                                    <option value="COMITÉ DEL PUEBLO">COMITÉ DEL PUEBLO</option>
                                    <option value="CONCEPCIÓN">CONCEPCIÓN</option>
                                    <option value="COTOCOLLAO">COTOCOLLAO</option>
                                    <option value="EL CONDADO">EL CONDADO</option>
                                    <option value="EL INCA">EL INCA</option>
                                    <option value="GUAMANÍ">GUAMANÍ</option>
                                    <option value="IÑAQUITO">IÑAQUITO</option>
                                    <option value="ITCHIMBÍA">ITCHIMBÍA</option>
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
                                    <option value="PUENGASÍ">PUENGASÍ</option>
                                    <option value="QUITUMBE">QUITUMBE</option>
                                    <option value="RUMIPAMBA">RUMIPAMBA</option>
                                    <option value="SAN BARTOLO">SAN BARTOLO</option>
                                    <option value="SAN JUAN">SAN JUAN</option>
                                    <option value="SOLANDA">SOLANDA</option>
                                    <option value="TURUBAMBA">TURUBAMBA</option>
                                </select> -->
                                <label for="canton">Lugar de residencia</label>

                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" disabled id="submit-invoice-data-update" name="submit-invoice-data-update">
                            <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>