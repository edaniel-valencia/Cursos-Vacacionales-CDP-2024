<?php
$userController = new UserController();
$userController->createUser();
include 'user-validation.php';
?>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>


<div class="iq-navbar-header" style="height: 160px;">
    <div class="container-fluid iq-container">
        <div class="row">
            <div class="col-md-12">
                <div class="flex-wrap d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fa-brands fa-bootstrap"></i>
                        <h1>Agregar Usuario</h1>
                    </div>
                    <div>
                        <a href="user-list" class="btn btn-link btn-soft-light">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                            Lista de usuarios
                        </a>
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


<!-- TITLE END -->

<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="card">

                        <div class="card-body">
                            <div class="form-group text-center">
                                <div class="profile-img-edit position-relative">
                                    <img src="./../assets/image/avatars/01.png" alt="avatar" id="img" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload').click()" width="100%">
                                    <input id="file-upload" class="file-upload" type="file" name="imagen" id="imagen" accept="image/*" style="display: none;" onchange="fileImage()">
                                </div>
                                <div class="img-extension mt-3">
                                    <div class="d-inline-block align-items-center">
                                        <span>Formato aceptado son:</span>
                                        <a href="javascript:void();">.jpg</a>
                                        <a href="javascript:void();">.png</a>
                                        <a href="javascript:void();">.jpeg</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group input-group mb-3">
                                <select name="role" id="role" class="selectpicker form-control" data-style="py-0" required onchange="validateForm()">
                                    <option value="">Selecciona un rol</option>
                                    <?php
                                    $roleController = new RoleController();
                                    $roles = $roleController->ViewRoles();
                                    foreach ($roles as $row) {
                                        echo '<option value="' . $row["Rid"] . '">' . $row["Rname"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group input-group mb-3">
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp" required oninput="validateForm()">
                            </div>
                            <div class="form-group input-group mb-3">
                                <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook">
                            </div>
                            <div class="form-group input-group mb-3">
                                <input type="text" class="form-control" id="tiktok" name="tiktok" placeholder="Tiktok">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Información del nuevo usuario</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="new-user-info">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombres" required oninput="validateForm()">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellidos" required oninput="validateForm()">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="credentity" name="credentity" placeholder="Credencias ID" maxlength="13" minlength="10" required oninput="validateForm()">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Fecha de nacimiento" maxlength="8" required oninput="validateForm()">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="input-group form-control mb-3">
                                            <select id="gender" name="gender" class="selectpicker js-example-basic-single form-control" data-style="py-0" required oninput="validateForm()">
                                                <option>Selecciona el género</option>
                                                <option>Femenino</option>
                                                <option>Masculino</option>
                                                <option>LGBTI</option>
                                                <option>Prefiero no decirlo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <div class="form-control input-group ">
                                            <select class="js-example-basic-single form-control" data-style="py-0" name="city" id="city">
                                                <option value="">Ciudad</option>
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
                                        </div>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Dirección" required oninput="validateForm()">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <div class="form-control input-group">
                                            <select class="js-example-basic-single form-control" required data-style="py-0" id="size" name="size">
                                            <option value="">Talla</option>
                                            <option value="6">6</option>
                                            <option value="8">8</option>
                                            <option value="10">10</option>
                                            <option value="12">12</option>
                                            <option value="14">14 </option>
                                            <option value="S">S </option>
                                            <option value="M">M</option>
                                            <option value="L">L </option>
                                            <option value="XL">XL </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <div class="form-control input-group">
                                            <select class="js-example-basic-single form-control" required data-style="py-0" name="blood" id="blood">
                                                <option value="">Tipo de sangre</option>

                                                <option value="O-">O-</option>
                                                <option value="O+">O+</option>
                                                <option value="A-">A-</option>
                                                <option value="A+">A+</option>
                                                <option value="B-">B-</option>
                                                <option value="B+">B+</option>
                                                <option value="AB-">AB-</option>
                                                <option value="AB+">AB+</option>
                                            </select>
                                        </div>

                                    </div>                                   
                                </div>
                                <hr>
                                <h5 class="mb-3">Seguridad</h5>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Usuario" required oninput="validateForm()">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Correo electrónico" required oninput="validateForm()">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required oninput="validatePassword()">
                                            <span class="input-group-text">
                                                <i class="fa fa-eye" id="toggleViewPassword" onclick="togglePasswordVisibility('password')"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="repeat-password" name="repeat-password" placeholder="Repetir Contraseña" required oninput="validatePassword()">
                                            <span class="input-group-text">
                                                <i class="fa fa-eye" id="toggleViewRepeatPassword" onclick="toggleRepeatPasswordVisibility()"></i>
                                            </span>
                                            <div class="invalid-feedback">Las contraseñas no coinciden</div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="submit" id="submit-btn" class="btn btn-primary" name="user-add" disabled>Registrar nuevo usuario</button>
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