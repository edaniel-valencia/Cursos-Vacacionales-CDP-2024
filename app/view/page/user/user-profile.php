<!-- TITLE START -->

<div class="iq-navbar-header" style="height: 125px;">

    <div class="iq-header-img">
        <img src="./../assets/image/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
    </div>
</div>



<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="profile-img position-relative me-3 mb-0 mb-lg-0 profile-logo profile-logo1">

                                <img src="<?php echo '../assets/image/system/user/' . $imageUser ?>" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-100 avatar-rounded">

                            </div>
                            <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                                <h4 class="me-2 h4"><?php echo $_SESSION['Uname'] . ' ' . $_SESSION['Ulastname'] ?></h4>
                                <!-- <span> - Cargo <?php echo $_SESSION['Rname'] ?></span> -->
                            </div>
                        </div>
                        <div class="d-flex nav nav-pills mb-0 text-center profile-tab">
                            <a class="btn btn-primary rounded-pill" href="user-profile">Mi Perfil</a>
                            &nbsp;
                            <?php if (in_array('button-invoice-data', $rutas)) : ?>
                                <a class="btn btn-info rounded-pill" href="invoice-data">
                                    <!-- <i class="fa fa-file" aria-hidden="true"></i> -->
                                    Datos de la Factura</a>
                            <?php endif; ?>
                            &nbsp;
                            <?php if (in_array('user-profile-edit', $rutas)) : ?>
                                <a class="btn btn-warning rounded-pill" href="user-profile-edit?user-id=<?php echo $_SESSION['Uid'] ?>" data-bs-toggle="tooltip" title="Editar datos del perfil">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="profile-content tab-content">



                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h4 class="card-title">Sobre mí</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="text-center">
                            <div class="user-profile">
                                <img src="../assets/image/system/user/<?php echo $imageUser ?>" alt="profile-img" class="rounded-pill avatar-130 img-fluid">
                            </div>
                            <h3 class="d-inline-block" style="text-align: justify"> <?php echo $_SESSION['Uname'] . ' ' . $_SESSION['Ulastname']  ?></h3><br>
                            <p class="d-inline-block pl-3"><?php echo $_SESSION['Unickname'] ?></p>
                        </div>
                        <div>
                            <p class="mb-0"><?php echo $_SESSION['Udescription'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h4 class="card-title">Datos personales</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class=" col-lg-6">
                                <ul class="list-inline m-0 p-0 ">
                                    <li class="d-flex mb-2 align-items-center">
                                        <img src="./../assets/image/icons/3D-Credential.webp" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                        <div class="ms-3">
                                            <h5><?php echo $_SESSION['Ucredential'] ?></h5>
                                            <p class="mb-0">ID identidad</p>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-2 align-items-center">
                                        <img src="./../assets/image/icons/3D-Date.png" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                        <div class="ms-3">
                                            <h5><?php echo $_SESSION['Ubirthdate'] ?></h5>
                                            <p class="mb-0">Fecha de nacimiento</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class=" col-lg-6">
                                <ul class="list-inline m-0 p-0 ">
                                    <li class="d-flex mb-2 align-items-center">
                                        <img src="./../assets/image/icons/3D-Gender.webp" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                        <div class="ms-3">
                                            <h5><?php echo $_SESSION['Ugender'] ?></h5>
                                            <p class="mb-0">Género</p>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-2 align-items-center">
                                        <img src="./../assets/image/icons/3D-Date.png" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                        <div class="ms-3">
                                            <h5><?php echo $_SESSION['Ucity'] . ' - ' . $_SESSION['Uaddress'] ?></h5>
                                            <p class="mb-0">Residencia</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">

            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Redes Sociales</h4>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-inline m-0 p-0">
                        <li class="d-flex mb-4 align-items-center">
                            <div class="img-fluid  rounded"><img width="50px" src="./../assets/image/icons/3D-WhatsApp.webp" alt="story-img" class="avatar-0"></div>
                            <div class="ms-3 flex-grow-1">
                                <h6>
                                    <a href="https://api.whatsapp.com/send?phone=593<?php echo $_SESSION['Uwhatsapp'] ?>" target="_blank" class="text-black">
                                        <?php echo $_SESSION['Uwhatsapp'] ?>
                                    </a>
                                </h6>
                                <p class="mb-0">WhatsApp</p>
                            </div>
                        </li>
                        <li class="d-flex mb-4 align-items-center">
                            <div class="img-fluid  rounded"><img width="50px" src="./../assets/image/icons/3D-Facebook.webp" alt="story-img" class="avatar-0"></div>
                            <div class="ms-3 flex-grow-1">
                                <h6>
                                    <a href="https://www.facebook.com/@<?php echo $_SESSION['Ufacebook'] ?>" target="_blank" class="text-black"><?php echo  '@' . $_SESSION['Ufacebook'] ?>
                                    </a>
                                </h6>
                                <p class="mb-0">Facebook</p>
                            </div>
                        </li>
                        <li class="d-flex mb-4 align-items-center">
                            <div class="img-fluid  rounded"><img width="50px" src="./../assets/image/icons/3D-Tiktok.webp" alt="story-img" class="avatar-0"></div>
                            <div class="ms-3 flex-grow-1">
                                <h6>
                                    <a href="https://www.tiktok.com/@<?php echo $_SESSION['Utiktok'] ?>" target="_blank" class="text-black">
                                        <?php echo  '@' . $_SESSION['Utiktok'] ?>
                                    </a>
                                </h6>
                                <p class="mb-0">Tiktok</p>

                            </div>
                        </li>
                        <li class="d-flex mb-4 align-items-center">
                            <div class="img-fluid  rounded"><img width="50px" src="./../assets/image/icons/3D-Email.png" alt="story-img" class="avatar-0"></div>
                            <div class="ms-3 flex-grow-1">
                                <h6>
                                    <a href="mailto:<?php echo $_SESSION['Uemail'] ?>" target="_blank" class="text-black">
                                        <?php echo $_SESSION['Uemail'] ?>
                                    </a>
                                </h6>
                                <p class="mb-0">Correo Electrónico</p>
                            </div>
                        </li>
                    </ul>


                </div>
            </div>
        </div>
    </div>

</div>

<!-- CONTENT END -->