<?php
$courseController   = new CourseController();
$sportController    = new SportController();
$moduleController   = new ModuleController();
$kitController    = new KitController();
$sceneryController    = new SceneryController();

$courseController->createCourse();
$kit  = $kitController->getAllKit();
$module = $moduleController->getAllModule();
$sport  = $sportController->getAllSport();
$scenery = $sceneryController->getAllScenery();

include 'course-validation.php';
?>
<div class="iq-navbar-header" style="height: 160px;">
    <div class="container-fluid iq-container">
        <div class="row">
            <div class="col-md-12">
                <div class="flex-wrap d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fa-brands fa-bootstrap"></i>
                        <h1>Agregar curso</h1>
                    </div>
                    <div>
                        <a href="course-list" class="btn btn-link btn-soft-light">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                            Lista de cursos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="iq-header-img">
        <img src="./../assets/image/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
    </div>
</div>


<!-- TITLE END -->

<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Información del nuevo curso</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="POST" enctype="multipart/form-data" id="formCreateAdd">
                            <div class="row">
                                <div class="col-xl-3 col-lg-2">
                                    <div class="profile-img-edit position-relative">
                                        <img src="./../assets/image/system/course/TSoftec.png" alt="avatar" id="img" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload').click()" width="100%">
                                        <input id="file-upload" class="file-upload" type="file" name="imagen" id="imagen" accept="image/*" style="display: none;" onchange="fileImage()">
                                    </div>
                                    <div class="img-extension text-center">
                                        <div class="d-inline-block align-items-center">
                                            <span>Carga una banner del curso</span>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="form-group col-md-9">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="form-floating">
                                                <select name="module" id="module" class="form-control" required oninput="validateFormCreate()">
                                                    <option value="">Modulo del curso</option>
                                                    <?php foreach ($module as $Mrow) { ?>
                                                        <option value="<?php echo $Mrow["Mid"]; ?>"><?php echo $Mrow["Mname"] . ' - ' . $Mrow["Mdescription"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="module">Modulo del curso</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-floating">
                                                <select name="scenery" id="scenery" class="form-control" required oninput="validateFormCreate()">
                                                    <option value="">Escenario para el curso</option>
                                                    <?php foreach ($scenery as $Erow) { ?>
                                                        <option value="<?php echo $Erow["Eid"]; ?>"><?php echo $Erow["Ename"] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="scenery">Escenario del curso</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-floating">
                                                <select name="sport" id="sport" class="form-control" required oninput="validateFormCreate()">
                                                    <option value="">Disciplina deportiva</option>
                                                    <?php foreach ($sport as $Srow) { ?>
                                                        <option value="<?php echo $Srow["Sid"]; ?>"><?php echo $Srow["Sname"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="sport">Disciplina deportiva</label>
                                            </div>
                                        </div>
                                  

                                        <div class="form-group col-md-3">
                                            <div class="form-floating">
                                                <input type="time" name="start_time" id="start_time" class="form-control" placeholder="TSoftec" required oninput="validateFormCreate()">
                                                <label for="start_time">Hora Inicial</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="form-floating">
                                                <input type="time" name="end_time" id="end_time" class="form-control" placeholder="TSoftec" required oninput="validateFormCreate()">
                                                <label for="end_time">Hora Final</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="form-floating">
                                                <input type="text" id="quota" name="quota" class="form-control" maxlength="3" placeholder="TSoftec" required oninput="validateFormCreate()">
                                                <label for="quota">Cupos</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="form-floating ">
                                                <input type="text" id="price" name="price" maxlength="5" minlength="2" class="form-control" placeholder="TSoftec" required oninput="validateFormCreate()">
                                                <label for="price">Precio</label>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group col-md-6">
                                            <div class="form-floating">
                                                <select name="discount" id="discount" class="form-control" required oninput="validateFormCreate()">
                                                    <option value="">Descuento disponibles</option>
                                                    <?php foreach ($discount as $Drow) { ?>
                                                        <option value="<?php echo $Drow["Did"]; ?>"><?php echo $Drow["Dpercentage"] . '% ' . $Drow["Ddescription"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="discount">Descuentos</label>
                                            </div>
                                        </div> -->
                                        <div class="form-group col-md-6">
                                            <div class="form-floating">
                                                <select name="kit" id="kit" class="form-control" required oninput="validateFormCreate()">
                                                    <option value="">Kit </option>
                                                    <?php foreach ($kit as $Srow) { ?>
                                                        <option value="<?php echo $Srow["Kid"]; ?>"><?php echo $Srow["Kname"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="kit">Kit </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="form-floating">
                                                <textarea type="text" class="form-control" id="description" name="description" placeholder="TSoftec" required oninput="validateFormCreate()"></textarea>
                                                <label for="description">Descripción del curso</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" id="submit-course-add" class="btn btn-primary" name="submit-course-add" >
                                    <i class="fa fa-save" aria-hidden="true"></i> Guardar Curso
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>