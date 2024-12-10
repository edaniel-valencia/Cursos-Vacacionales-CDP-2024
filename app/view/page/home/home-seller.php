<?php
$Uid = $_SESSION["Uid"];
$homeController = new HomeController();
$sportsData =           $homeController->getGroupBySport();
$modulesData =          $homeController->getGroupByModule();
$usersCount =           $homeController->getCountAllUsers();
$usersByInvoiceCount =  $homeController->getCountByUsers($Uid);
$invoiceCount =  $homeController->getCountInvoice();

?>

<!-- Nav Header Component Start -->
<div class="iq-navbar-header" style="margin-top: 10%;">
    <!-- <div class="container-fluid iq-container">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div> -->
    <div class="iq-header-img">
        <img src="./../assets/image/dashboard/top-header-cdp.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">

    </div>
</div> <!-- Nav Header Component End -->
<!--Nav End-->
</div>
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <!-- <div class="flex-wrap justify-content-between align-items-center">
            <div class="form-group">
                <h2 class="card-title text-white" style="box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);">Dashboard <?php echo $roleName; ?></h2>
            </div>
        </div> -->
        <div class="col-md-12 col-lg-12">

            <div class="row">

                <div class="col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" data-aos="fade-up" data-aos-delay="50">
                                <div class="card-body">
                                    <a href="pos-my-register" target="">
                                        <div class="progress-widget">
                                            <img src="./../assets/image/icons/3D-Quota.png" width="75px" alt="">
                                            <div class="progress-detail">
                                                <p class="mb-1">Mis Inscripciones</p>
                                                <h4 class="counter"><?php echo $usersByInvoiceCount; ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" data-aos="fade-up" data-aos-delay="50">
                                <div class="card-body">
                                    <a href="pos-all-register" target="">
                                        <div class="progress-widget">
                                            <img src="./../assets/image/icons/3D-Quota.webp" width="75px" alt="">
                                            <div class="progress-detail">
                                                <p class="mb-1">Inscripciones</p>
                                                <h4 class="counter"><?php echo $invoiceCount; ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card" data-aos="fade-up" data-aos-delay="50">
                                <div class="card-body">
                                    <a href="user-list-pos" target="">
                                        <div class="progress-widget">
                                            <img src="./../assets/image/icons/3D-User.webp" width="75px" alt="">
                                            <div class="progress-detail">
                                                <p class="mb-1">Lista de Usuarios</p>
                                                <h4 class="counter"><?php echo $usersCount; ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" data-aos="fade-up" data-aos-delay="50">
                                <div class="card-body">
                                    <div class="progress-widget">
                                        <img src="https://teampichincha.com/wp-content/uploads/2024/06/Banner-Principal-Pagina-Web-Final-1-1200x570.jpg" width="100%" height="100%" style="border-radius: 15px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>