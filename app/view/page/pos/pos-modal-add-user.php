<div class="modal fade" id="pos-modal-add-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Información del nuevo usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            include 'pos-validation-user.php';
            ?>
            <form id="formCreateUserPOS" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="new-user-info">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group ">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombres" required oninput="validateFormPOS()">
                                        <label for="name">Nombre del deportista</label>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group ">
                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellidos" required oninput="validateFormPOS()">
                                        <label for="lastname">Apellidos del deportista</label>

                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group ">
                                        <input type="text" class="form-control" id="credentity" name="credentity" placeholder="Credenciales ID" maxlength="13" minlength="10" required oninput="validateFormPOS()">
                                        <label for="credentity">Cédula</label>

                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group ">
                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp" r required oninput="validateFormPOS()">
                                        <label for="whatsapp">Whatsapp</label>

                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group ">
                                        <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Fecha de nacimiento" maxlength="8" required oninput="validateFormPOS()">
                                        <label for="birthdate">Fecha de Nacimiento</label>

                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group ">
                                        <select id="gender" name="gender" class="form-control" required onchange="validateFormPOS()">
                                            <option value="Género">Género</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="LGBTI">LGBTI</option>
                                            <option value="Prefiero no decirlo">Prefiero no decirlo</option>
                                        </select>
                                        <label for="gender">Género</label>

                                    </div>
                                </div>
                                <!-- <div class="form-group col-md-4">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group ">
                                        <select class="form-control" name="city" id="city" required onchange="validateFormPOS()">
                                            <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Fecha de nacimiento" maxlength="8" required oninput="validateFormPOS()">

                                            <label for="city">Sector</label>

                                    </div>
                                </div> -->
                                <div class="form-group col-md-4">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group ">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="Dirección" required
                                         oninput="validateFormPOS()">
                                        <label for="city">Sector</label>

                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group ">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Dirección" required
                                         oninput="validateFormPOS()">
                                        <label for="address">Dirección</label>

                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group ">
                                        <select class="form-control" id="size" name="size" required onchange="validateFormPOS()">
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
                                        <label for="size">Talla</label>

                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group ">
                                        <select class="form-control" id="blood" name="blood" required onchange="validateFormPOS()">
                                            <option value="">Sangre</option>
                                            <option value="O-">O-</option>
                                            <option value="O+">O+</option>
                                            <option value="A-">A-</option>
                                            <option value="A+">A+</option>
                                            <option value="B-">B-</option>
                                            <option value="B+">B+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="AB+">AB+</option>
                                        </select>
                                        <label for="blood">Tipo de Sangre</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group ">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Correo electrónico" required oninput="validateFormPOS()">
                                        <label for="email">Correo Electrónico</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group ">
                                        <input type="password" class="form-control" id="Upassword" name="Upassword" placeholder=" " required oninput="validateFormPOS()">
                                        <label for="Upassword">Contraseña</label>
                                        <span class="input-group-text" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; border: none; color: black ">
                                            <i class="fa fa-eye" id="toggleViewUpassword" onclick="togglePasswordVisibility('Upassword')"></i>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="submit-create-user-pos" name="submit-create-user-pos" disabled>
                            <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>