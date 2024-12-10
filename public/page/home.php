 <?php  
 include "./../header.php"

require_once "./app/controller/courses.php";
require_once "./app/model/courses.php";
$courseController = new CourseController();

$courses = $courseController->getAllCourseSport();
// include 'course-pagination-available.php';

?>
 <!-- Google Tag Manager (noscript) -->
 <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WMWZ37VQ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="boxex-inner">

        <main class="main-content" id="home">
            <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
                <div class="container-fluid  navbar-inner">

                    <a href="home" class="navbar-brand">
                        <div class="logo-main">
                            <div class="logo-normal">
                                <img src="./assets/image/icons/new-logo-cdp.png" alt="" width="60px" height="25%">

                            </div>
                            <div class="logo-mini">
                                <img src="./assets/image/icons/new-logo-cdp.png" alt="" width="60px" height="25%">

                            </div>
                        </div>
                        <h4 class="logo-title">
                            <img src="./assets/image/icons/logo-cdp-letras.png" alt="" width="100px" height="25%">
                            <img src="./assets/image/icons/100-años-cdp.png" alt="" width="100px" height="25%">

                        </h4>
                    </a>

                    <!-- Sidebar Menu End --> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <span class="navbar-toggler-bar bar1 mt-2"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item ">
                                <a href="https://teampichincha.com" target="_blank" class="btn btn-white rounded-pill">
                                    Página Oficial
                                </a>
                                <a href="#courseAvailble" class="btn rounded-pill">
                                    Cursos Disponibles
                                </a>

                            </li>
                            <li class="nav-item ">
                                <a href="https://www.youtube.com/watch?v=BJMu2qHKJ_4&t=7" target="_blank" class="btn btn-danger rounded-pill">
                                    <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M21.3309 7.44251C20.9119 7.17855 20.3969 7.1552 19.9579 7.37855L18.4759 8.12677C17.9279 8.40291 17.5879 8.96129 17.5879 9.58261V15.4161C17.5879 16.0374 17.9279 16.5948 18.4759 16.873L19.9569 17.6202C20.1579 17.7237 20.3729 17.7735 20.5879 17.7735C20.8459 17.7735 21.1019 17.7004 21.3309 17.5572C21.7499 17.2943 21.9999 16.8384 21.9999 16.339V8.66179C21.9999 8.1623 21.7499 7.70646 21.3309 7.44251Z" fill="currentColor"></path>
                                        <path d="M11.9051 20H6.11304C3.69102 20 2 18.3299 2 15.9391V9.06091C2 6.66904 3.69102 5 6.11304 5H11.9051C14.3271 5 16.0181 6.66904 16.0181 9.06091V15.9391C16.0181 18.3299 14.3271 20 11.9051 20Z" fill="currentColor"></path>
                                    </svg>
                                    Tutorial
                                </a>
                                <a href="./app/auth-signup" class="btn btn-secondary  rounded-pill">
                                    <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M21.101 9.58786H19.8979V8.41162C19.8979 7.90945 19.4952 7.5 18.999 7.5C18.5038 7.5 18.1 7.90945 18.1 8.41162V9.58786H16.899C16.4027 9.58786 16 9.99731 16 10.4995C16 11.0016 16.4027 11.4111 16.899 11.4111H18.1V12.5884C18.1 13.0906 18.5038 13.5 18.999 13.5C19.4952 13.5 19.8979 13.0906 19.8979 12.5884V11.4111H21.101C21.5962 11.4111 22 11.0016 22 10.4995C22 9.99731 21.5962 9.58786 21.101 9.58786Z" fill="currentColor"></path>
                                        <path d="M9.5 15.0156C5.45422 15.0156 2 15.6625 2 18.2467C2 20.83 5.4332 21.5001 9.5 21.5001C13.5448 21.5001 17 20.8533 17 18.269C17 15.6848 13.5668 15.0156 9.5 15.0156Z" fill="currentColor"></path>
                                        <path opacity="0.4" d="M9.50023 12.5542C12.2548 12.5542 14.4629 10.3177 14.4629 7.52761C14.4629 4.73754 12.2548 2.5 9.50023 2.5C6.74566 2.5 4.5376 4.73754 4.5376 7.52761C4.5376 10.3177 6.74566 12.5542 9.50023 12.5542Z" fill="currentColor"></path>
                                    </svg>
                                    Registrar
                                </a>
                                <a href="./app/" class="btn btn-primary rounded-pill">
                                    <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M2 6.447C2 3.996 4.03024 2 6.52453 2H11.4856C13.9748 2 16 3.99 16 6.437V17.553C16 20.005 13.9698 22 11.4744 22H6.51537C4.02515 22 2 20.01 2 17.563V16.623V6.447Z" fill="currentColor"></path>
                                        <path d="M21.7787 11.4548L18.9329 8.5458C18.6388 8.2458 18.1655 8.2458 17.8723 8.5478C17.5802 8.8498 17.5811 9.3368 17.8743 9.6368L19.4335 11.2298H17.9386H9.54826C9.13434 11.2298 8.79834 11.5748 8.79834 11.9998C8.79834 12.4258 9.13434 12.7698 9.54826 12.7698H19.4335L17.8743 14.3628C17.5811 14.6628 17.5802 15.1498 17.8723 15.4518C18.0194 15.6028 18.2113 15.6788 18.4041 15.6788C18.595 15.6788 18.7868 15.6028 18.9329 15.4538L21.7787 12.5458C21.9199 12.4008 21.9998 12.2048 21.9998 11.9998C21.9998 11.7958 21.9199 11.5998 21.7787 11.4548Z" fill="currentColor"></path>
                                    </svg>
                                    Iniciar Sesión
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
            </nav>



            <div class="conatiner-fluid content-inner  py-1">
                <br>

                <div class="row">
                    <div class="col-xl-12 " style="border-radius: 15px; ">

                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" aria-label="Slide 1" class="active text-bg-danger" aria-current="true"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" class=" text-bg-danger"></button>
                            </div>
                            <div class="carousel-inner">
                            <div class="carousel-item ">
                                    <a href="https://vacacionales.teampichincha.com/app/auth-signup" target="_blank" rel="noopener noreferrer">
                                        <img src="https://teampichincha.com/wp-content/uploads/2024/06/Banner-Principal-Pagina-Web-Final-1-1200x570.jpg" style="border-radius: 15px;" class="d-block" width="100%" alt="Modulo 1">
                                        </a>
                                        <div class="carousel-caption d-none d-md-block">
                                            </div>
                                        </div>
                                        
                                        <div class="carousel-item active">
                                            <a href="https://vacacionales.teampichincha.com/app/auth-signup" target="_blank" rel="noopener noreferrer">
                                        <img src="https://teampichincha.com/wp-content/uploads/2024/07/Tercer-Modulo-Banner-3-V2.jpg" style="border-radius: 15px;" class="d-block" width="100%" alt="Modulo 1">
                                    </a>
                                    <div class="carousel-caption d-none d-md-block">
                                    </div>
                                </div>
                               

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="text-center" id="courseAvailble">
                        <div class="form-group mt-5">
                            <h2 class="card-title text-white">Vacacionales Felices 2024</h2>
                        </div>
                        <iframe width="780" height="460" style="border-radius: 15px;" src="https://www.youtube.com/embed/kxznfYJVrMw?autoplay=1&controls=0&rel=0" frameborder="0" allowfullscreen></iframe>

                    </div>


                    <div class="text-center" id="courseAvailble">
                        <div class="form-group mt-5">
                            <h2 class="card-title text-white">Cursos Vacacionales Disponibles</h2>
                        </div>
                    </div>

                    <?php
                    $modal_counter = 1;
                    foreach ($courses as $row) {
                        $imageSport =  $row["Simage"];
                        $imageCourse =  $row["CIimage"];
                    ?>
                        <div class="overflow-hidden slider-circle-btn col-xl-3  p-2" style="border-radius: 15px; ">
                            <div class="d-flex align-items-center" style="border-radius: 15px; ">
                                <a href="https://vacacionales.teampichincha.com/app/auth-signup" target="_blank" rel="noopener noreferrer">
                                    <img style="border-radius: 15px; box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.2);" src="<?php echo './assets/image/system/course/' . $imageCourse ?>" alt="User-Profile" width="100%" class="theme-color-default-img img-fluid">
                                </a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>



                    <div class="col-xl-12 p-3" id="socialMedia" style="border-radius: 15px; ">
                        <aside class="text-center " id="masinformacion">
                            <div class="form-group mt-5">
                                <h2 class="card-title text-white">Visita nuestras Redes Sociales</h2>
                            </div>
                            <div class=" px-5">

                                <div class="row">
                                    <div class="col-2">
                                        <a href="https://www.facebook.com/ConcentracionDeportiva/" target="_blank"><img src="./assets/image/icons/facebook.png" width="100%" class="rounded-5 shadowmb-5 bg-body-tertiary" alt="..." />
                                        </a>
                                    </div>
                                    <div class="col-2">
                                        <a href="https://www.instagram.com/teampichincha/" target="_blank"><img src="./assets/image/icons/instagram.png" width="100%" class="rounded-5 shadowmb-5 bg-body-tertiary" alt="..." />
                                        </a>
                                    </div>
                                    <div class="col-2">
                                        <a href="https://twitter.com/TeamPichincha" target="_blank"><img src="./assets/image/icons/twiter.png" width="100%" class="rounded-5 shadowmb-5 bg-body-tertiary" alt="..." />
                                        </a>
                                    </div>
                                    <div class="col-2">
                                        <a href="https://www.tiktok.com/@team.pichincha" target="_blank"><img src="./assets/image/icons/tiktok.png" width="100%" class="rounded-5 shadowmb-5 bg-body-tertiary" alt="..." />
                                        </a>
                                    </div>
                                    <div class="col-2">
                                        <a href="https://www.youtube.com/TeamPichincha" target="_blank"><img src="./assets/image/icons/youtube.png" width="100%" class="rounded-5 shadowmb-5 bg-body-tertiary" alt="..." />
                                        </a>
                                    </div>
                                    <div class="col-2">
                                        <a href="https://api.whatsapp.com/send?phone=593993024613" target="_blank"><img src="./assets/image/icons/whatsapp.png" width="100%" class="rounded-5 shadowmb-5 bg-body-tertiary" alt="..." />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </aside>
                        <div>


                        </div>
                    </div>
                    <div class="col-xl-12  p-2" style="border-radius: 15px; ">
                        <div class="d-flex align-items-center" style="border-radius: 15px; ">

                            <img src="https://www.comunidad.madrid/sites/default/files/styles/aspect_ratio_16_9_desktop/public/img/publicaciones/deportistas_alto_nivel_y_alto_rendimiento.jpg?itok=iaN5pyAf&timestamp=1589187802" alt="User-Profile" width="100%" class="theme-color-default-img img-fluid" style="border-radius: 15px;">

                        </div>
                    </div>
                    <div>


                    </div>
                </div>
            </div>


            <!-- Footer Section Start -->
            <footer class="footer">
                <div class="footer-body">
                    <ul class="left-panel list-inline mb-0 p-0">
                        <li class="list-inline-item"><a href="#">Politicas de privacidad</a></li>
                        <li class="list-inline-item"><a href="">Terminos de uso</a></li>
                    </ul>
                    <div class="right-panel">
                        <span class="">Desarrollado </span> por <a href="https://tsoftec.com/">TSoftware Ecuador</a>.

                        ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                    </div>
                </div>
            </footer>
            <!-- Footer Section End -->
        </main>
        <!-- Wrapper End-->
    </div>
    <div class="btn-download">
        <a class="btn btn-success px-3 py-2 rounded-pill" href="#home">
            <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.4" d="M2 12C2 6.485 6.486 2 12 2C17.514 2 22 6.485 22 12C22 17.514 17.514 22 12 22C6.486 22 2 17.514 2 12Z" fill="currentColor"></path>
                <path d="M7.77942 13.4425C7.77942 13.2515 7.85242 13.0595 7.99842 12.9135L11.4684 9.42652C11.6094 9.28552 11.8004 9.20652 12.0004 9.20652C12.1994 9.20652 12.3904 9.28552 12.5314 9.42652L16.0034 12.9135C16.2954 13.2065 16.2954 13.6805 16.0014 13.9735C15.7074 14.2655 15.2324 14.2645 14.9404 13.9715L12.0004 11.0185L9.06042 13.9715C8.76842 14.2645 8.29442 14.2655 8.00042 13.9735C7.85242 13.8275 7.77942 13.6345 7.77942 13.4425Z" fill="currentColor"></path>
            </svg>
        </a>
    </div>

    <?php  
 include "./../footer.php"
 ?>