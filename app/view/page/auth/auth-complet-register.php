<?php
if (isset($_SESSION["Uid"])) {
   $userId = $_SESSION["Uid"];
   $userController = new UserController();
   $user = $userController->getUserById($userId);
   $Uname = $user["Uname"];
   $imageUser = $user["Uimage"];
   $status = $user["Ustatus"];


   $userController->updateUserProfileInfoUser();
   //  $userController->updateUserProfileStatus();
   //  $userController->updateUserProfileKey();
   $userController->updateUserProfileImagen();
   //  $userController->updateUserProfileRole();
} else {
   echo "Error: User ID is not specified.";
}

include 'auth-validation.php';
?>

<script>
    Swal.fire({
  position: "top-center",
  icon: "warning",
  title: "Completa la información en los campos vacíos",
  showConfirmButton: false,
  timer: 1500
});
</script>
<div class="iq-navbar-header" style="height: 160px;">
   <!-- <div class="container-fluid iq-container">
      <div class="row">
         <div class="col-md-12">
            <div class="flex-wrap d-flex justify-content-between align-items-center">
               <div class="form-group">
                  <h2 class="card-title">Complete sus datos </h2>
               </div>

            </div>
         </div>
      </div>
   </div> -->
   <div class="iq-header-img">
      <img src="./../assets/image/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">      
   </div>
</div>



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
                           <img src="<?php echo './../assets/image/system/user/' . $imageUser ?>" alt="avatar" id="img" style="cursor: pointer;" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload').click()" width="100%">

                           <div style="position:absolute;bottom:3px; right: 3px; ">
                              <i class="fa fa-camera" style="
                        color: blue; 
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                         width: 35px;
                         height: 35px;
                          border-radius: 50%;
                          background-color: white;
                           color: blue;
                            font-size: 17px;
                             cursor: pointer; 
                        " onclick="document.getElementById('file-upload').click()"></i>
                           </div>


                        <?php    } else { ?>
                           <img src="./../assets/image/avatars/01.png" alt="avatar" id="img" class="theme-color-default-img profile-pic rounded" style="cursor: pointer;" onclick="document.getElementById('file-upload').click()" width="100%">
                        <?php    } ?>
                        <input type="hidden" name="Uid" value="<?php echo $userId ?>">
                        <input id="file-upload" class="file-upload" type="file" name="Uimage" id="Uimage" accept="image/*" style="display: none;" onchange="validateFormUpdateImagen()">
                     </div>
                     <div class="img-extension" style="position: relative; top:5px">
                        <div class="d-inline-block align-items-center">
                           <span>Formato aceptado son:</span>
                           <a href="javascript:void();">.jpg</a>
                           <a href="javascript:void();">.png</a>
                           <a href="javascript:void();">.jpeg</a>
                        </div>
                     </div>

                  </div>
                  <div class="form-group col-md-12">
                     <center> <button type="submit" id="submit-btn-update-image" class="btn btn-primary" name="submit-btn-update-image">
                           <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar Foto
                        </button>
                     </center>
                  </div>
               </form>




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
                              <h4 class="card-title">Completa la información en los campos vacíos</h4>
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
                           <input type="text" class="form-control" id="Uname" name="Uname" required value="<?php echo  $user["Uname"] ?>">
                        </div>
                        <div class="form-group col-md-6">
                           <label class="form-label" for="add2">Apellidos:</label>
                           <input type="text" class="form-control" id="Ulastname" name="Ulastname" required value="<?php echo  $user["Ulastname"] ?>">
                        </div>
                        <div class="form-group col-md-4">
                           <label class="form-label" for="furl">Cedula:</label>
                           <input type="text" class="form-control" id="Ucredential" disabled name="Ucredential" minlength="10" maxlength="10" required value="<?php echo  $user["Ucredential"] ?>">
                        </div>
                        <div class="form-group col-md-8">
                           <label class="form-label" for="furl">Correo:</label>
                           <input type="text" class="form-control" id="Uemail" disabled name="Uemail" required value="<?php echo  $user["Uemail"] ?>">
                        </div>
                        <div class="form-group col-md-4">
                           <label class="form-label" for="furl">WhatsApp:</label>
                           <input type="text" class="form-control" id="Uwhatsapp"  name="Uwhatsapp" maxlength="10" required value="<?php echo  $user["Uwhatsapp"] ?>">
                        </div>
                        <div class="form-group col-md-4">
                           <label class="form-label" for="lname">Fecha de nacimiento:</label>
                           <input type="date" class="form-control" id="Ubirthdate" name="Ubirthdate"  required value="<?php echo  $user["Ubirthdate"] ?>">
                        </div>
                        <div class="form-group col-md-3">
                           <label class="form-label">Género:</label>
                           <select id="Ugender" name="Ugender" class="form-control" required data-style="py-0">
                              <option value="">Selecciona el género</option>
                              <option value="Femenino" <?php if ($user["Ugender"] === "Femenino") echo " selected"; ?>>Femenino</option>
                              <option value="Masculino" <?php if ($user["Ugender"] === "Masculino") echo " selected"; ?>>Masculino</option>
                              <option value="LGBTI" <?php if ($user["Ugender"] === "LGBTI") echo " selected"; ?>>LGBTI</option>
                              <option value="Prefiero no decirlo" <?php if ($user["Ugender"] === "Prefiero no decirlo") echo " selected"; ?>>Prefiero no decirlo</option>
                           </select>
                        </div>
                        <div class="form-group col-md-3">
                           <label class="form-label" for="talla">Talla:</label>
                           <div class="form-control input-group"  required>
                              <select class="js-example-basic-single form-control" required data-style="py-0" id="Usize" name="Usize">
                              <option value="<?php echo $user["Usize"] ?>"><?php echo $user["Usize"] ?></option>
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
                              <label class="form-label" for="blood_type">Tipo de Sangre:</label>
                              <div class="form-control input-group" id="Usize" name="Usize" required >
                                 <select class="js-example-basic-single form-control" required data-style="py-0" name="Ublood" id="Ublood">
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
                           <input type="text" class="form-control" id="Ucity" name="Ucity" required value="<?php echo $user["Ucity"] ?>">

                         
                        </div>
                        <div class="form-group col-md-12">
                           <label class="form-label" for="mobno">Dirección:</label>
                           <input type="text" class="form-control" id="Uaddress" name="Uaddress" required value="<?php echo $user["Uaddress"] ?>">
                        </div>

                        <center>
                           <div class="form-group col-md-12">
                              <button type="submit" id="submit-btn-update-info-user" class="btn btn-primary" name="submit-btn-update-info-user">
                                 <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar datos del usuario
                              </button>
                           </div>
                        </center>
                     </div>
                  </form>
               </div>
            </div>
         </div>

      </div>
   </div>

   <!-- <div class="card">
      <div class="card-header">
         <div class="header-title">
            <h4 class="card-title">Actualizar Datos</h4>
         </div>
      </div>
      <div class="card-body">
         <div class="row">

            <div class=" col-lg-3">
               <div class="form-group">
                  <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                     <input name="Uname" type="text" class="form-control" id="Uname" placeholder=" ">
                     <label for="floatingInput">Nombres</label>
                  </div>
               </div>
            </div>
            <div class=" col-lg-3">
               <div class="form-group">
                  <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                     <input name="Ulastname" type="text" class="form-control" id="Ulastname" placeholder=" ">
                     <label for="floatingInput">Apellidos</label>
                  </div>
               </div>
            </div>
            <div class=" col-lg-3">
               <div class="form-group">
                  <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                     <input name="Ucredential" type="text" class="form-control" id="Ucredential" placeholder=" ">
                     <label for="floatingInput">Cedula</label>
                  </div>
               </div>
            </div>

            <div class="col-lg-3">
               <div class="form-group">
                  <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                     <input name="Ubirthdate" type="date" class="form-control" id="Ubirthdate" placeholder=" " required oninput="validateFormRegister()">
                     <label for="floatingInput">Fecha de nacimiento</label>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="form-group">
                  <select id="Ugender" name="Ugender" class="form-control" data-style="py-0" required>
                     <option value="">Selecciona el género</option>
                     <option value="Femenino">Femenino</option>
                     <option value="Masculino">Masculino</option>
                  </select>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="form-group">
                  <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                     <input name="Ucity" type="text" class="form-control" id="Ucity" placeholder=" " required oninput="validateFormRegister()">
                     <label for="floatingInput">Ciudad</label>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="form-group">
                  <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                     <input name="Uaddress" type="text" class="form-control" id="Uaddress" placeholder=" " required oninput="validateFormRegister()">
                     <label for="floatingInput">Dirección</label>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="form-group">
                  <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                     <input name="Unickname" type="text" class="form-control" id="Unickname" placeholder=" " required oninput="validateFormRegister()">
                     <label for="floatingInput">Unickname </label>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="form-group">
                  <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                     <input type="email" class="form-control" id="Uemail" name="Uemail" placeholder=" " required oninput="validateFormRegister()">
                     <label for="Uemail ">Correo Electrónico</label>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="form-group">
                  <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                     <input name="Uwhatsapp" type="text" class="form-control" id="Uwhatsapp" placeholder=" " required oninput="validateFormRegister()">
                     <label for="floatingInput">Celular</label>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="form-group">
                  <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                     <input name="Ufacebook" type="text" class="form-control" id="Ufacebook" placeholder=" " required oninput="validateFormRegister()">
                     <label for="floatingInput">facebook</label>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="form-group">
                  <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                     <input name="Utiktok" type="text" class="form-control" id="Utiktok" placeholder=" " required oninput="validateFormRegister()">
                     <label for="floatingInput">tiktok</label>
                  </div>
               </div>
            </div>

            <div class="col-lg-3">
               <div class="form-group">
                  <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                     <input name="Udescription" type="text" class="form-control" id="Udescription" placeholder=" " required oninput="validateFormRegister()">
                     <label for="floatingInput">Descripción</label>
                  </div>
               </div>
            </div>

            <div class="col-lg-12 mt-3 ">
               <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary" name="submit-auth-signin" id="submit-auth-signin" disabled>Actualizar</button>
               </div>
            </div>



         </div>
      </div>
   </div> -->
</div>