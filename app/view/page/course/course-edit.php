<?php
if (isset($_GET["course-id"])) {
    $courseId = $_GET["course-id"];
    $courseController = new CourseController();
    $course = $courseController->getCourseById($courseId);
    $courseController->updateCourse();
    $kitController = new KitController();
    $moduleController   = new ModuleController();
    $sportController    = new SportController();


    $kit   = $kitController->getAllKit();
    $module = $moduleController->getAllModule();
    $sport  = $sportController->getAllSport();

    $imageCourse = $course["CIimage"];
    $status = $course["Cstatus"];
    include 'course-validation.php';
} else {
    echo "Error: course ID is not specified.";
}
?>
<div class="iq-navbar-header" style="height: 160px;">
    <div class="container-fluid iq-container">
        <div class="row">
            <div class="col-md-12">
                <div class="flex-wrap d-flex justify-content-between align-items-center">
                    <div>
                        <h1><?php echo 'Curso de ' . $course["Sname"] ?></h1>
                    </div>
                    <div>
                        <a href="course-list" class="btn btn-link btn-soft-light">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> Listado
                        </a>
                        <!-- <a href="course-detail?course-id=<?php echo $courseId ?>" class="btn btn-link btn-soft-light">
                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                            Atras
                        </a> -->

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

    <form method="POST" enctype="multipart/form-data" id="formUpdateInformation" name="formUpdateInformation">

        <div class="row">
            <div class="col-xl-3 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <!-- <form method="POST" enctype="multipart/form-data" id="formUpdateImage" name="formUpdateImage"> -->
                        <div class="form-group text-center">
                            <div class="profile-img-edit position-relative">
                                <?php
                                if ($imageCourse != null) { ?>
                                    <img src="<?php echo './../assets/image/system/course/' . $imageCourse ?>" alt="avatar" id="img-update" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload-update').click()" width="100%">
                                <?php    } else { ?>
                                    <img src="./../assets/image/avatars/01.png" alt="avatar" id="img" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload-update').click()" width="100%">
                                <?php    } ?>
                                <input type="hidden" name="Cid" value="<?php echo $courseId ?>">
                                <input id="file-upload-update" class="file-upload" type="file" name="imagen" value="<?php echo $course['CIimage'] ?>" id="imagen" accept="image/*" style="display: none;" oninput="validateFormUpdate()">
                            </div>
                            <div class="img-extension">
                                <div class="d-inline-block align-items-center">
                                    <span>Formato aceptado son: </span>
                                    <a href="javascript:void();">.jpg</a>
                                    <a href="javascript:void();">.png</a>
                                    <a href="javascript:void();">.jpeg</a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group col-md-12">
                            <center> <button type="submit" id="submit-btn-update-image" class="btn btn-primary" name="submit-btn-update-image" disabled>
                                    <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar Foto
                                </button>
                            </center>
                        </div> -->
                        <!-- </form> -->
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="container-fluid iq-container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="flex-wrap d-flex justify-content-between align-items-center">
                                        <div class="header-title">
                                            <h4 class="card-title">Información del nuevo usuario</h4>
                                        </div>
                                        <div>
                                            <a href="course-detail?course-id=<?php echo $courseId ?>" class="btn btn-primary" data-bs-toggle="tooltip" title="Volver a la informacion del usuario <?php echo $course['Sname'] ?>">
                                                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="new-course-info">
                            <div class="row">
                                <input type="hidden" name="Uid" value="<?php echo $courseId ?>">
                                <div class="form-group col-md-8">
                                    <div class="form-floating">
                                        <select name="module" id="module" class="form-control" required oninput="validateFormUpdate()">
                                            <option value="<?php echo $course["Mid"]; ?>"><?php echo $course["Mname"] . ' - ' . $course["Mdescription"] ?></option>
                                            <?php foreach ($module as $row) { ?>
                                                <option value="<?php echo $row["Mid"]; ?>"><?php echo $row["Mname"] . ' - ' . $row["Mdescription"]; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="module">Modulo del curso</label>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <div class="form-floating">
                                        <select name="sport" id="sport" class="form-control" required oninput="validateFormUpdate()">
                                            <option value="<?php echo $course["Sid"] ?>"><?php echo $course["Sname"] ?></option>
                                            <?php foreach ($sport as $row) { ?>
                                                <option value="<?php echo $row["Sid"]; ?>"><?php echo $row["Sname"]; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="sport">Disciplina deportiva</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-floating">
                                        <select name="kit" id="kit" class="form-control" required oninput="validateFormUpdate()">
                                            <option value="<?php echo $course["Kid"] ?>"><?php echo $course["Kname"] ?></option>
                                            <?php foreach ($kit as $row) { ?>
                                                <option value="<?php echo $row["Kid"]; ?>"><?php echo $row["Kname"]; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="kit">Kit</label>
                                    </div>
                                </div>
                               
                                <!-- <div class="form-group col-md-5">
                                    <div class="form-floating">
                                        <select name="discount" id="discount" class="form-control" required oninput="validateFormUpdate()">
                                            <option value="<?php echo $course["Did"]; ?>"><?php echo $course["Dpercentage"] . '% ' . $course["Ddescription"];; ?></option>
                                            <?php foreach ($discount as $row) { ?>
                                                <option value="<?php echo $row["Did"]; ?>"><?php echo $row["Dpercentage"] . '% ' . $row["Ddescription"]; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="discount">Descuentos</label>
                                    </div>
                                </div> -->
                                <div class="form-group col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="price" name="price" value="<?php echo $course["CIprice"] ?>" required oninput="validateFormUpdate()">
                                        <label class="form-label" for="price">Valor:</label>
                                    </div>
                                </div>
                               
                                <div class="form-group col-md-3">
                                    <div class="form-floating mb-3">
                                        <select name="status" id="status" class=" form-control" value="<?php echo $course["Cstatus"];  ?>" data-style="py-0" placeholder="TSoftec">
                                            <option>Selecciona un opción</option>
                                            <?php
                                            $statusController = new StatusController();
                                            $status = $statusController->getStatus();
                                            foreach ($status as $sts) {
                                                $selected = ($sts["Scodigo"] == $course["Cstatus"]) ? "selected" : ""; // Comprueba si  el precio coincide con  el precio del usuario y marca como seleccionado si es así
                                                echo '<option value="' . $sts["Scodigo"] . '" ' . $selected . '>' . $sts["Sname"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <label for="status">Estados disponibles</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-floating">
                                        <textarea type="text" r rows="2" cols="40" class="form-control" id="description" name="description" required oninput="validateFormUpdate()"><?php echo $course["CIdescription"] ?></textarea>
                                        <label for="description">Descripción del curso</label>
                                    </div>
                                </div>
                               
                                <div class="form-group col-md-12">
                                    <button type="submit" id="submit-course-update-info" class="btn btn-primary" name="submit-course-update-info">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar datos del usuario
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>