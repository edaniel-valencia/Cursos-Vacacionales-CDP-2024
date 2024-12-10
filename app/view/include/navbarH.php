<?php
$imageUser = isset($_SESSION['Uimage']) && $_SESSION['Uimage'] !== '' ? $_SESSION['Uimage'] : 'users.jpg';
?>
<main class="main-content">
    <div class="position-relative iq-banner">
        <nav class="nav navbar navbar-expand-lg navbar-light fixed-top mb-3 iq-navbar" aria-label="Main navigation">
            <div class="container-fluid navbar-inner">
                <a href="<?php echo  'home-'.$roleName; ?>" class="navbar-brand">
                    <div class="logo-main">
                        <div class="logo-normal">
                            <img src="./../assets/image/icons/logo-normal.png" alt="" width="60px" height="25%">

                        </div>
                        <div class="logo-mini">
                            <img src="./../assets/image/icons/logo-normal.png" alt="" width="60px" height="25%">

                        </div>
                    </div>
                    <h4 class="logo-title">
                        <img src="./../assets/image/icons/logo-cdp-letras.png" alt="" width="100px" height="25%">

                    </h4>
                </a>
                <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                    <i class="icon">
                        <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                        </svg>
                    </i>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <span class="mt-2 navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                        <li class="me-10 me-xl-2">
                            <a class="btn btn-danger rounded-pill btn-sm d-flex gap-2 align-items-center" aria-current="page" href="#" target="_blank" data-bs-toggle="tooltip" title="Tutorial de como INSCRIBIRTE a un curso deportivo">
                                <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M22 12C22 17.524 17.523 22 12 22C6.477 22 2 17.524 2 12C2 6.478 6.477 2 12 2C17.523 2 22 6.478 22 12Z" fill="currentColor"></path>
                                    <path d="M15.5739 15.8145C15.4429 15.8145 15.3109 15.7805 15.1899 15.7095L11.2639 13.3675C11.0379 13.2315 10.8989 12.9865 10.8989 12.7225V7.67554C10.8989 7.26154 11.2349 6.92554 11.6489 6.92554C12.0629 6.92554 12.3989 7.26154 12.3989 7.67554V12.2965L15.9589 14.4195C16.3139 14.6325 16.4309 15.0925 16.2189 15.4485C16.0779 15.6835 15.8289 15.8145 15.5739 15.8145Z" fill="currentColor"></path>
                                </svg>
                                <div id="timer"></div>

                            </a>
                        </li>

                        <?php if (in_array('bottom-tutorial-cashier', $rutas)) : ?>
                            <li class="me-10 me-xl-2">
                                                  <a class="btn btn-primary rounded-pill btn-sm d-flex gap-2 align-items-center" aria-current="page" href="https://www.youtube.com/watch?v=DvNtrlIJJLg" target="_blank" data-bs-toggle="tooltip" title="Tiempo de espera...">
                                    <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M21.3309 7.44251C20.9119 7.17855 20.3969 7.1552 19.9579 7.37855L18.4759 8.12677C17.9279 8.40291 17.5879 8.96129 17.5879 9.58261V15.4161C17.5879 16.0374 17.9279 16.5948 18.4759 16.873L19.9569 17.6202C20.1579 17.7237 20.3729 17.7735 20.5879 17.7735C20.8459 17.7735 21.1019 17.7004 21.3309 17.5572C21.7499 17.2943 21.9999 16.8384 21.9999 16.339V8.66179C21.9999 8.1623 21.7499 7.70646 21.3309 7.44251Z" fill="currentColor"></path>
                                        <path d="M11.9051 20H6.11304C3.69102 20 2 18.3299 2 15.9391V9.06091C2 6.66904 3.69102 5 6.11304 5H11.9051C14.3271 5 16.0181 6.66904 16.0181 9.06091V15.9391C16.0181 18.3299 14.3271 20 11.9051 20Z" fill="currentColor"></path>
                                    </svg>
                                    
                                    Tutorial
                                </a>
                            </li>

                        <?php endif; ?>

                        <?php if (in_array('bottom-tutorial-client', $rutas)) : ?>
                            <li class="me-10 me-xl-2">
                                <a class="btn btn-primary btn-sm d-flex gap-2 rounded-pill align-items-center" aria-current="page" href="https://www.youtube.com/watch?v=BJMu2qHKJ_4&t=7s" target="_blank" data-bs-toggle="tooltip" title="Tutorial de como INSCRIBIRTE a un curso deportivo">
                                    <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M21.3309 7.44251C20.9119 7.17855 20.3969 7.1552 19.9579 7.37855L18.4759 8.12677C17.9279 8.40291 17.5879 8.96129 17.5879 9.58261V15.4161C17.5879 16.0374 17.9279 16.5948 18.4759 16.873L19.9569 17.6202C20.1579 17.7237 20.3729 17.7735 20.5879 17.7735C20.8459 17.7735 21.1019 17.7004 21.3309 17.5572C21.7499 17.2943 21.9999 16.8384 21.9999 16.339V8.66179C21.9999 8.1623 21.7499 7.70646 21.3309 7.44251Z" fill="currentColor"></path>
                                        <path d="M11.9051 20H6.11304C3.69102 20 2 18.3299 2 15.9391V9.06091C2 6.66904 3.69102 5 6.11304 5H11.9051C14.3271 5 16.0181 6.66904 16.0181 9.06091V15.9391C16.0181 18.3299 14.3271 20 11.9051 20Z" fill="currentColor"></path>
                                    </svg>
                                    Tutorial
                                </a>
                            </li>

                        <?php endif; ?>

                        <li class="nav-item dropdown">
                            <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../assets/image/system/user/<?php echo $imageUser ?>" alt="<?php echo $imageUser ?>" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                                <div class="caption ms-3 d-none d-md-block ">
                                    <h6 class="mb-0 caption-title"><?php echo $_SESSION['Uname'] . ' ' . $_SESSION['Ulastname'] ?></h6>
                                    <p class="mb-0 caption-sub-title"><?php echo $_SESSION['Unickname'] ?></p>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li class="text-gray">
                                    <a class="dropdown-item " href="user-profile"><i class="fa fa-user" aria-hidden="true"></i>
                                        Mi Perfil
                                    </a>
                                </li>
                                <!-- <li class="text-gray">
                                    <a class="dropdown-item" href="#"><i class="fa fa-cog" aria-hidden="true"></i>
                                        Configuración
                                    </a>
                                </li> -->
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="text-danger">
                                    <a class="dropdown-item text-danger" href="auth-logout"><i class="fa fa-sign-out" aria-hidden="true"></i>
                                        Cerrar Sesión
                                    </a>
                                </li>
                            </ul>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br>