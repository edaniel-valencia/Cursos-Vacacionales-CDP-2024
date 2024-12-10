<?php
$authenticateController = new AuthenticateController;

$authenticateController->signin();

if (isset($_GET["email"]) && isset($_GET["password"])) {
   $email    = $_GET["email"];
   $password = $_GET['password'];
  
  }
   include 'auth-validation.php'; ?>

<section class="login-content">
   <div class="row m-0 align-items-center bg-white vh-100">
      <div class="col-md-6">
         <div class="justify-items-center mb-0 auth-card" style=" max-width: 400px; margin: 50px; margin: 0 auto;border-radius: 15px;">
            <div class="card-body">
                  <a href="login" class="navbar-brand d-flex align-items-center"></a>
                  <center>
                     <img src="https://teampichincha.com/wp-content/uploads/2024/06/Logo-escudo-dorado-H-1-400x225.png" class="text-center mb-2 " alt="" width="50%" height="25%">
                  </center>
                  <h2 class="mb-2 text-center">INICIAR SESSIÓN</h2>
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
                  <form method="post" id="loginFormLogin" enctype="multipart/form-data">
                    
                  
                  <div class="form-floating  mt-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?php echo $email ?>" required oninput="validateForm()">
                        <label for="email" class="form-label">Correo Electrónico</label>
                     </div>

                     <div class="input-group  mt-3 ">
                        <div class="form-floating ">
                           <input type="password" class="form-control" id="password" name="password" aria-cribedby="password" value="<?php echo $password ?>"  placeholder="Cdp*100" required oninput="validateForm()">
                           <label for="password" class="form-label">Contraseña</label>
                        </div>
                     </div>
                     

                     <div class="col-lg-12 mt-3 ">
                        <div class="d-flex justify-content-center">
                           <button type="submit" class="btn btn-primary" name="submit-auth-signin" id="submit-auth-signin" disabled>Iniciar Sesión</button>
                        </div>
                     </div>
                     <p class="mt-3 text-center">
                        ¡Crear una cuenta! <a href="auth-signup" class="text-underline">Clic aquí.</a><br>
                        <a href="auth-reset" style="font-size: 14px;" class="text-underline text-gray">¿Reestablecer Contraseña? </a>
                     </p>
                  </form>
               </div>
         </div>
      </div>
      <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
      <img src="https://teampichincha.com/wp-content/uploads/2024/07/Tercer-Modulo-1.jpg" class="img-fluid" width="100%" alt="images">
      </div>
   </div>
</section>