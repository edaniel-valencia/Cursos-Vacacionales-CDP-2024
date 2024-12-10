<?php
$authenticateController = new UserController;

$authenticateController->createRegisterUser();
?>


<script>
    function mostrarAlerta() {
        Swal.fire({
            position: "top-center",
            title: "¿Cómo inscribirme a un Curso Vacacional 2024?",
            text: "Solo registrar los datos del deportista que tomará el curso vacacional.",
            showConfirmButton: true,
            html: '<iframe width="420" height="260" style="border-radius: 15px;" src="https://www.youtube.com/embed/BJMu2qHKJ_4?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>',
            confirmButtonText: "Más Información",
            confirmButtonColor: "#0065F7",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Solo registrar los datos del deportista que tomará el curso vacacional.", "", "warning");
            }
        });
    }
</script>

<?php include 'auth-validation.php'; ?>

<section class="login-content">
    <div class="row m-0 align-items-center bg-white vh-100">

        <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
            <img src="https://teampichincha.com/wp-content/uploads/2024/07/Tercer-Modulo-1.jpg" class="img-fluid " width="100%"  alt="images">
        </div>
        <div class="col-md-6">
            <div class=" justify-items-center mb-0 auth-card" style=" max-width: 500px; margin: 10px; margin: 0 auto;border-radius: 15px; ">
                <div class="card-body">
                    <a href="login" class="navbar-brand d-flex align-items-center"></a>
                    <center>
                        <img src="https://teampichincha.com/wp-content/uploads/2024/06/Logo-escudo-dorado-H-1-400x225.png" class="text-center " alt="" width="40%" height="25%">
                    </center>
                    <h4 class="text-center"><B>REGISTRARSE SOLO LOS DEPORTISTAS</B></h4>
                    <p class="text-center"><a class="btn text-danger " onclick="mostrarAlerta()"><b>Ver Tutorial</b></a></p>




                    <script>
                        function mostrarAlerta() {
                            Swal.fire({
                                position: "top-center",
                                title: "¿Cómo inscribirme a un Curso Vacacional 2024?",
                                text: "Solo registrar los datos del deportista que tomará el curso vacacional.",
                                showConfirmButton: true,
                                html: '<iframe width="420" height="260" style="border-radius: 15px;" src="https://www.youtube.com/embed/BJMu2qHKJ_4?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>',
                                confirmButtonText: "Más Información",
                                confirmButtonColor: "#0065F7",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire("Solo registrar los datos del deportista que tomará el curso vacacional.", "", "warning");
                                }
                            });
                        }
                    </script>


                    <form method="post" id="loginFormRegisters" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-1">
                                    <input name="Uname" type="text" class="form-control" id="Uname" placeholder=" " required oninput="validateFormRegister()">
                                    <label for="floatingInput">Nombres</label>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-1">
                                        <input name="Ulastname" type="text" class="form-control" id="Ulastname" placeholder=" " required oninput="validateFormRegister()">
                                        <label for="floatingInput">Apellidos</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-1">
                                        <input name="Ucredential" type="text" class="form-control" id="Ucredential" placeholder=" " required oninput="validateFormRegister()">
                                        <label for="floatingInput">Cédula</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-1">
                                        <input name="Ubirthdate" type="date" class="form-control" id="Ubirthdate" placeholder=" " required oninput="validateFormRegister()">
                                        <label for="floatingInput">Fecha de nacimiento</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select id="Ugender" name="Ugender" class="form-control" data-style="py-0" required oninput="validateFormRegister()">
                                        <option value="">Selecciona el género</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Masculino">Masculino</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-1">
                                        <input name="Uwhatsapp" type="text" class="form-control" id="Uwhatsapp" placeholder=" " required oninput="validateFormRegister()">
                                        <label for="floatingInput">Celular</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-1">
                                        <input type="email" class="form-control" id="Uemail" name="Uemail" placeholder=" " required oninput="validateFormRegister()">
                                        <label for="Uemail">Correo Electrónico</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-floating custom-form-floating custom-form-floating-sm form-group">
                                    <input type="password" class="form-control" id="Upassword" name="Upassword" placeholder=" " required oninput="validateFormRegister()">
                                    <label for="Upassword">Contraseña</label>
                                    <span class="input-group-text" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; border: none; color: black">
                                        <i class="fa fa-eye" id="toggleViewUpassword" onclick="togglePasswordVisibility('Upassword')"></i>
                                    </span>
                                </div>
                                <div id="passwordMessage" style="color: red; font-size: 12px; margin-bottom: 15px;"></div>
                            </div>

                        </div>

                        <div class="col-lg-12 mt-3">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary" name="user-register" id="submit_activo">Registrarme</button>
                            </div>
                        </div>

                        <p class="mt-3 text-center">
                            ¡Ya tengo una Cuenta! <a href="auth-signin" class="text-underline">Clic aquí.</a>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>