<?php

$homeController = new HomeController();
$sportsData = $homeController->getGroupBySport();
$modulesData = $homeController->getGroupByModule();
$homeCount = $homeController->getCountAllUsers();
$invoiceCount = $homeController->getCountAllInvoice();
$invoiceProfitsCount = $homeController->getCountAllInvoiceProfits();
$sportsDataForToday = $homeController->getGroupByDayAndSport();
$inscriptionsData = $homeController->getInscriptionsByModuleAndType();
$inscriptionsDataSM = $homeController->getInscriptionsBySportAndModuleAndTendence();

if (!empty($invoiceProfitsCount)) :
    foreach ($invoiceProfitsCount as $invoice) :
        if ($invoice['Mid'] == 6) {
            $idOneM = $invoice['Mid'];
            $countOneM = $invoice['InvoiceCount'];
            $amountOneM = $invoice['TotalAmount'];
        } else  if ($invoice['Mid'] == 7) {
            $idTwoM = $invoice['Mid'];
            $countTwoM = $invoice['InvoiceCount'];
            $amountTwoM = $invoice['TotalAmount'];
        } else  if ($invoice['Mid'] == 8) {
            $idThridM = $invoice['Mid'];
            $countThridM = $invoice['InvoiceCount'];
            $amountThridM = $invoice['TotalAmount'];
        }
    endforeach;
endif;

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
                                    <div class="progress-widget">
                                        <img src="./../assets/image/icons/3D-Quota.png" width="75px" alt="">

                                        <div class="progress-detail">
                                            <p class="mb-1">Inscripciones Mod-1</p>

                                            <h4 class="counter"><?php echo $countOneM; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" data-aos="fade-up" data-aos-delay="50">
                                <div class="card-body">
                                    <div class="progress-widget">
                                        <img src="./../assets/image/icons/3D-Quota.webp" width="75px" alt="">
                                        <div class="progress-detail">
                                            <p class="mb-1">Ganancias Mod-1</p>
                                            <h4 class="counter"><?php echo $amountOneM; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card" data-aos="fade-up" data-aos-delay="50">

                                <div class="card-body">
                                    <div class="progress-widget">
                                        <img src="./../assets/image/icons/3D-Quota.png" width="75px" alt="">

                                        <div class="progress-detail">
                                            <p class="mb-1">Inscripciones Mod-2</p>

                                            <h4 class="counter"><?php echo $countTwoM; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" data-aos="fade-up" data-aos-delay="50">

                                <div class="card-body">
                                    <div class="progress-widget">
                                            <video style="border-radius: 15px;" width="100%" height="100%" controls autoplay loop>
                                                <source src="./../assets/video/publicidad-vacacional.mp4" type="video/mp4">
                                            </video>

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