<?php
$authenticateController = new AuthenticateController;

$authenticateController->validationEmail();

// if (isset($_GET["email"])) {
//     $email    = $_GET["email"];
// }
include 'auth-validation.php'; ?>

<section class="login-content">
    <div class="row m-0 align-items-center bg-white vh-100">
        <div class="col-md-6 d-md-block d-none bg p-0 mt-n1 vh-100 overflow-hidden">
            <img src="https://vacacionales.teampichincha.com/assets/image/config/2.png" class="img-fluid " alt="images">
        </div>
        <div class="col-md-6 p-0">
            <div class="justify-items-center mb-0 auth-card" style=" padding:15%; margin: 50px; margin: 0 auto;border-radius: 15px;">
                <div class="card-body">
                    <a href="login" class="navbar-brand d-flex align-items-center"></a>
                    <center>
                        <img src="https://teampichincha.com/wp-content/uploads/2024/06/Logo-escudo-dorado-H-1-400x225.png" class="text-center mb-2 " alt="" width="50%" height="25%">

                        <h2 class="mb-2">Restablecer la contraseña</h2>
                        <p>Ingrese su dirección de correo electrónico.
                        </p>
                        <div id="alert-container"></div>

                    </center>
                    <form id="validateFormReset" method="post" enctype="multipart/form-data" onsubmit="return validarCodigo()">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder=" " required oninput="validateFormReset()">
                                    <label for="email">Correo Electrónico</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <style>
                                .input-container {
                                    position: relative;
                                    display: inline-block;
                                }

                                .input-container input {
                                    pointer-events: none;
                                    /* Desactiva todos los eventos en el input */
                                    user-select: none;
                                    /* Evita la selección de texto en navegadores modernos */
                                    -webkit-user-select: none;
                                    /* Safari */
                                    -moz-user-select: none;
                                    /* Firefox */
                                    -ms-user-select: none;
                                    /* Internet Explorer/Edge */
                                }

                                .overlay {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    background: transparent;
                                    /* Capa transparente */
                                    z-index: 10;
                                    /* Superpone la capa sobre el input */
                                    pointer-events: all;
                                    /* Permite que la capa capture eventos del mouse */
                                }
                            </style>
                            <div class="col-lg-4">
                                <div class="floating-label form-group input-container">
                                    <input type="text" disabled class="form-control" id="code" name="code" aria-describedby="code" maxlength="6" placeholder=" " required>
                                    <div class="overlay"></div>
                                </div>

                            </div>
                            <script>
                                const overlay = document.querySelector('.overlay');

                                // Prevenir eventos de selección de texto
                                overlay.addEventListener('mousedown', function(event) {
                                    event.preventDefault();
                                });

                                overlay.addEventListener('contextmenu', function(event) {
                                    event.preventDefault();
                                });

                                overlay.addEventListener('selectstart', function(event) {
                                    event.preventDefault();
                                });

                                overlay.addEventListener('dragstart', function(event) {
                                    event.preventDefault();
                                });

                                overlay.addEventListener('dblclick', function(event) {
                                    event.preventDefault();
                                });
                            </script>
                            <div class="col-lg-8">
                                <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                                    <input type="text" class="form-control" id="validation" name="validation" aria-describedby="email" maxlength="6" placeholder=" " required>
                                    <label for="validation">Agregar Código</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="auth-validation-email" id="auth-validation-email" class="btn btn-primary" disabled>Verificar Correo Electrónico</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



<script>
    // Función para generar un código aleatorio alfanumérico de longitud especificada
    function generarCodigo(longitud) {
        let caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        let codigo = '';
        for (let i = 0; i < longitud; i++) {
            codigo += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
        }
        return codigo;
    }

    // Función para inicializar el código generado cuando se carga la página
    window.onload = function() {
        let codigo_generado = generarCodigo(6); // Generar código aleatorio de 6 caracteres
        sessionStorage.setItem('codigo_generado', codigo_generado); // Almacenar el código en sessionStorage
        document.getElementById('code').value = codigo_generado; // Mostrar el código generado en el campo deshabilitado
    }

    // Función para validar el formulario antes de enviar
    function validarCodigo() {
        let codigo_generado = sessionStorage.getItem('codigo_generado'); // Obtener el código generado guardado
        let codigo_ingresado = document.getElementById('validation').value.trim(); // Obtener el código ingresado por el usuario
        let alertContainer = document.getElementById('alert-container'); // Contenedor de alertas

        alertContainer.innerHTML = '';

        if (codigo_generado !== codigo_ingresado) {
        //     let successAlert = document.createElement('div');
        //     successAlert.className = 'alert alert-solid alert-primary rounded-pill alert-dismissible fade show ';
        //     successAlert.role = 'alert';
        //     successAlert.innerHTML = `
        //     Código verificado correctamente. 
        //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`;

        //     alertContainer.appendChild(successAlert);
        //     return true;

        // } else {
            let errorAlert = document.createElement('div');
            errorAlert.className = 'alert alert-solid alert-danger rounded-pill alert-dismissible fade show';
            errorAlert.role = 'alert';
            errorAlert.innerHTML = `
            Haz agregado mal el código. Intentalo otra vez. 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`;

            alertContainer.appendChild(errorAlert);
            return false;
        }
    }
</script>