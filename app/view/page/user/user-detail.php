<?php
if (isset($_GET["user-id"])) {
    $userId = $_GET["user-id"];
    $userController = new UserController();
    $user = $userController->getUserById($userId);
    $userController->deleteUser($userId);
    $imageUser = $user["Uimage"];
    $status = $user["Ustatus"];
    include 'user-validation.php';
} else {
    echo "Error: User ID is not specified.";
}

?>
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
                                <h4 class="me-2 h4"><?php echo $user['Uname'] . ' ' . $user['Ulastname'] ?></h4>
                                <!-- <span> - Cargo <?php echo $user['Rname'] ?></span> -->
                            </div>
                        </div>
                        <div class="d-flex nav nav-pills  text-center profile-tab">
                        <?php if (in_array('user-edit', $rutas)) : ?>
                              &nbsp;  <a class="nav-link show btn btn-secondary" href="invoice-data-pos-detail?userId=<?php echo $userId ?>" data-bs-toggle="tooltip" title="Editar datos de <?php echo $user['Unickname'] ?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar datos de factura
                                </a>
                            <?php endif; ?>
                            &nbsp;
                            <?php if (in_array('user-edit', $rutas)) : ?>
                                <a class="nav-link show btn btn-primary" href="user-edit?user-id=<?php echo $userId ?>" data-bs-toggle="tooltip" title="Editar datos de <?php echo $user['Unickname'] ?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar usuario
                                </a>
                            <?php endif; ?>
                         
                           
                            <?php if (in_array('user-delete', $rutas)) : ?>
                                <form method="POST" enctype="multipart/form-data" id="" name="">
                                    <input type="hidden" name="Uid" id="Uid" value="<?php echo $userId ?>">
                                    <button type="submit" id="submit-btn-delete-user" class="nav-link show btn btn-danger" name="submit-btn-delete-user" data-bs-toggle="tooltip" title="Eliminar datos de <?php echo  $user['Unickname'] ?>">
                                        <i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
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
                            <h3 class="d-inline-block" style="text-align: justify"> <?php echo $user['Uname'] . ' ' . $user['Ulastname']  ?></h3><br>
                            <p class="d-inline-block pl-3"><?php echo $user['Unickname'] ?></p>
                        </div>
                        <div>
                            <p class="mb-0"><?php echo $user['Udescription'] ?></p>
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
                                            <h5><?php echo $user['Ucredential'] ?></h5>
                                            <p class="mb-0">ID identidad</p>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-2 align-items-center">
                                        <img src="./../assets/image/icons/3D-Date.png" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                        <div class="ms-3">
                                            <h5><?php echo $user['Ubirthdate'] ?></h5>
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
                                            <h5><?php echo $user['Ugender'] ?></h5>
                                            <p class="mb-0">Género</p>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-2 align-items-center">
                                        <img src="./../assets/image/icons/3D-City.png" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                        <div class="ms-3">
                                            <h5><?php echo $user['Ucity']  ?></h5>
                                            <p class="mb-0">Residencia</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class=" col-lg-6">
                               
                                    <li class="d-flex mb-2 align-items-center">
                                        <img src="./../assets/image/icons/3D-Size.png" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                        <div class="ms-3">
                                            <h5><?php echo $user['Usize'] ?></h5>
                                            <p class="mb-0">Talla</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class=" col-lg-6">
                               
                                    <li class="d-flex mb-2 align-items-center">
                                        <img src="./../assets/image/icons/3D-Blood.webp" alt="story-img" class=" avatar-70 p-1 profile-story-img  img-fluid">
                                        <div class="ms-3">
                                            <h5><?php echo $user['Ublood']  ?></h5>
                                            <p class="mb-0">Tipo de Sangre</p>
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
                                    <a href="https://api.whatsapp.com/send?phone=593<?php echo $user['Uwhatsapp'] ?>" target="_blank" class="text-black">
                                        <?php echo $user['Uwhatsapp'] ?>
                                    </a>
                                </h6>
                                <p class="mb-0">WhatsApp</p>
                            </div>
                        </li>
                        <li class="d-flex mb-4 align-items-center">
                            <div class="img-fluid  rounded"><img width="50px" src="./../assets/image/icons/3D-Facebook.webp" alt="story-img" class="avatar-0"></div>
                            <div class="ms-3 flex-grow-1">
                                <h6>
                                    <a href="https://www.facebook.com/@<?php echo $user['Ufacebook'] ?>" target="_blank" class="text-black"><?php echo  '@' . $user['Ufacebook'] ?>
                                    </a>
                                </h6>
                                <p class="mb-0">Facebook</p>
                            </div>
                        </li>
                        <li class="d-flex mb-4 align-items-center">
                            <div class="img-fluid  rounded"><img width="50px" src="./../assets/image/icons/3D-Tiktok.webp" alt="story-img" class="avatar-0"></div>
                            <div class="ms-3 flex-grow-1">
                                <h6>
                                    <a href="https://www.tiktok.com/@<?php echo $user['Utiktok'] ?>" target="_blank" class="text-black">
                                        <?php echo  '@' . $user['Utiktok'] ?>
                                    </a>
                                </h6>
                                <p class="mb-0">Tiktok</p>

                            </div>
                        </li>
                        <li class="d-flex mb-4 align-items-center">
                            <div class="img-fluid  rounded"><img width="50px" src="./../assets/image/icons/3D-Email.png" alt="story-img" class="avatar-0"></div>
                            <div class="ms-3 flex-grow-1">
                                <h6>
                                    <a href="mailto:<?php echo $user['Uemail'] ?>" target="_blank" class="text-black">
                                        <?php echo $user['Uemail'] ?>
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