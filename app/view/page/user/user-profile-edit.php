<?php
if (isset($_SESSION["Uid"])) {
    $userId = $_SESSION["Uid"];
    $userController = new UserController();
    $user = $userController->getUserById($userId);
    $imageUser = $user["Uimage"];
    $status = $user["Ustatus"];
    include 'user-validation.php';

    $userController->updateUserProfileInfo();
    $userController->updateUserProfileStatus();
    $userController->updateUserProfileKey();
    $userController->updateUserProfileImage();
    $userController->updateUserProfileRole();
} else {
    echo "Error: User ID is not specified.";
}

?>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
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


    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="card">

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="formUpdateImage" name="formUpdateImage">

                        <div class="form-group text-center">
                            <div class="profile-img-edit position-relative">
                                <?php
                                if ($imageUser != null) { ?>
                                    <img src="<?php echo '../assets/image/system/user/' . $imageUser ?>" alt="avatar" id="img" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload').click()" width="100%">
                                <?php    } else { ?>
                                    <img src="./../assets/image/avatars/01.png" alt="avatar" id="img" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload').click()" width="100%">
                                <?php    } ?>
                                <input type="hidden" name="Uid" value="<?php echo $userId ?>">
                                <input id="file-upload" class="file-upload" type="file" name="imagen" id="imagen" accept="image/*" style="display: none;" onchange=" validateFormUpdateImage()">
                            </div>
                            <div class="img-extension">
                                <div class="d-inline-block align-items-center">
                                    <span>Formato aceptado son:</span>
                                    <a href="javascript:void();">.jpg</a>
                                    <a href="javascript:void();">.png</a>
                                    <a href="javascript:void();">.jpeg</a>
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <center> <button type="submit" id="submit-btn-update-image" class="btn btn-primary" name="submit-btn-update-image" disabled>
                                    <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar Foto
                                </button>
                            </center>
                        </div>
                    </form>
                    <div class="form-group ">
                        <label for="uname">Apodo:</label>
                        <input type="text" class="form-control" name="nickname" disabled value="<?php echo $user["Unickname"] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="uname">Correo electrónico:</label>
                        <input type="text" class="form-control" name="email" disabled value="<?php echo $user["Uemail"] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="fname">Credencial ID:</label>
                        <input type="text" class="form-control" name="credentity" maxlength="13" disabled minlength="10" value="<?php echo $user["Ucredential"] ?>" required>
                    </div>


                </div>
            </div>

        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="container-fluid iq-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="flex-wrap d-flex justify-content-between align-items-center">
                                    <div class="header-title">
                                        <h4 class="card-title">Información del nuevo usuario</h4>
                                    </div>
                                    <div>
                                        <a href="user-detail?user-id=<?php echo $userId ?>" class="btn btn-primary" data-bs-toggle="tooltip" title="Volver a la informacion del usuario <?php echo $user['Unickname'] ?>">
                                            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="POST" enctype="multipart/form-data" id="formUpdateInformation" name="formUpdateInformation">
                            <div class="row">
                                <input type="hidden" name="Uid" value="<?php echo $userId ?>">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="add1">Nombres:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user["Uname"] ?>" required oninput="validateFormUpdateInfo()">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="add2">Apellidos:</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user["Ulastname"] ?>" required oninput="validateFormUpdateInfo()">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="furl">WhatsApp:</label>
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" maxlength="10" value="<?php echo $user["Uwhatsapp"] ?>" required oninput="validateFormUpdateInfo()">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="lname">Fecha de nacimiento:</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate" maxlength="8" value="<?php echo $user["Ubirthdate"] ?>" required oninput="validateFormUpdateInfo()">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Género:</label>
                                    <select id="gender" name="gender" class="form-control" data-style="py-0" required oninput="validateFormUpdateInfo()">
                                        <option value="">Selecciona el género</option>
                                        <option value="Femenino" <?php if ($user["Ugender"] === "Femenino") echo " selected"; ?>>Femenino</option>
                                        <option value="Masculino" <?php if ($user["Ugender"] === "Masculino") echo " selected"; ?>>Masculino</option>
                                        <option value="LGBTI" <?php if ($user["Ugender"] === "LGBTI") echo " selected"; ?>>LGBTI</option>
                                        <option value="Prefiero no decirlo" <?php if ($user["Ugender"] === "Prefiero no decirlo") echo " selected"; ?>>Prefiero no decirlo</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="form-label" for="talla">Talla:</label>
                                    <div class="form-control input-group" required>
                                        <select class="js-example-basic-single form-control" required data-style="py-0" id="size" name="size">
                                            <option value="<?php echo $user["Usize"] ?>"><?php echo $user["Usize"] ?></option>

                                            <option value="XXS">XXS </option>
                                            <option value="XS">XS </option>
                                            <option value="S">S </option>
                                            <option value="M">M</option>
                                            <option value="L">L </option>
                                            <option value="XL">XL </option>
                                            <option value="XXL">XXL </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="form-label" for="blood_type">Tipo de Sangre:</label>
                                    <div class="form-control input-group" id="size" name="size" required>
                                        <select class="js-example-basic-single form-control" required data-style="py-0" name="blood" id="blood">
                                            <option value="<?php echo $user["Ublood"] ?>"><?php echo $user["Ublood"] ?></option>

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
                                <script>
                                    $(document).ready(function() {
                                        $('.js-example-basic-single').select2();
                                    });
                                </script>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="mobno">Ciudad:</label>
                                    <div class="form-control input-group ">
                                        <select class="js-example-basic-single form-control" data-style="py-0" name="city" id="city">
                                            <option value="<?php echo $user["Ucity"] ?>"><?php echo $user["Ucity"] ?></option>
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
                                <div class="form-group col-md-8">
                                    <label class="form-label" for="mobno">Dirección:</label>
                                    <input type="text" class="form-control" id="address" name="address" maxlength="20" maxlength="5" value="<?php echo $user["Uaddress"] ?>" required oninput="validateFormUpdateInfo()">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="turl">Facebook:</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook" maxlength="25" value="<?php echo $user["Ufacebook"] ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="instaurl">Tiktok:</label>
                                    <input type="text" class="form-control" id="tiktok" name="tiktok" maxlength="25" value="<?php echo $user["Utiktok"] ?>" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="submit" id="submit-btn-update-info" disabled class="btn btn-primary" name="submit-btn-update-info">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar datos del usuario
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php if (in_array('user-rol-edit', $rutas) || in_array('user-status-edit', $rutas)) : ?>
                        <div class="card">
                            <div class="card-body">
                                <?php if (in_array('user-rol-edit', $rutas)) : ?>
                                    <form method="POST" enctype="multipart/form-data" id="" name="">
                                        <div class="header-title">
                                            <h4 class="card-title">Rol asignado</h4>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-9">
                                                <input type="hidden" name="Uid" value="<?php echo $userId ?>">
                                                <select name="role" id="role" class="selectpicker form-control" data-style="py-0" value="<?php echo $user["Uwhatsapp"] ?>" data-style="py-0" required oninput="validateFormUpdateInfo()">
                                                    <option>Selecciona el rol</option>
                                                    <?php
                                                    $roleController = new RoleController();
                                                    $roles = $roleController->ViewRoles();
                                                    foreach ($roles as $row) {
                                                        $selected = ($row["Rid"] == $user["Rid"]) ? "selected" : ""; // Comprueba si el rol coincide con el rol del usuario y marca como seleccionado si es así
                                                        echo '<option value="' . $row["Rid"] . '" ' . $selected . '>' . $row["Rname"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <button type="submit" id="submit-btn-update-role" class="btn btn-primary" name="submit-btn-update-role">
                                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                <?php endif; ?>
                                <?php if (in_array('user-status-edit', $rutas)) : ?>

                                    <form method="POST" enctype="multipart/form-data" id="formUpdateStatus" name="formUpdateStatus">
                                        <div class="header-title">
                                            <h4 class="card-title">Estado</h4>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-9">
                                                <input type="hidden" name="Uid" value="<?php echo $userId ?>">
                                                <select id="Ustatus" name="Ustatus" class="form-control" data-style="py-0" required>
                                                    <option value="">Selecciona el estado</option>
                                                    <option value="1" <?php if ($status === '1') echo " selected"; ?>>Activo</option>
                                                    <option value="2" <?php if ($status === '2') echo " selected"; ?>>Inactivo</option>
                                                    <option value="0" <?php if ($status === '0') echo " selected"; ?>>Pendiente</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <button type="submit" id="submit-btn-status-update" class="btn btn-primary" name="submit-btn-status-update">
                                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Credencial encriptada</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="new-user-info">
                                <form method="POST" enctype="multipart/form-data" id="formUpdateKey" name="formUpdateKey">
                                    <input type="hidden" name="Uid" value="<?php echo $userId ?>">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required oninput="validateFormUpdateKey()">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" id="toggleViewPassword" onclick="togglePasswordVisibility('password')"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="repeat-password" name="repeat-password" placeholder="Repetir Contraseña" required oninput="validateFormUpdateKey()">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" id="toggleViewRepeatPassword" onclick="toggleRepeatPasswordVisibility()"></i>
                                                </span>
                                                <div class="invalid-feedback">Las contraseñas no coinciden</div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" id="submit-btn-update-key" class="btn btn-primary" name="submit-btn-update-key" disabled>
                                                <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar clave</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

</div>
</div>