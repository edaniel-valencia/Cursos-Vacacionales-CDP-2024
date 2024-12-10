<?php


$userId = $_SESSION['Uid'];
if (isset($_GET["course-id"])) {
    $courseId = $_GET["course-id"];
    $rolId = $_SESSION['Rid'];

    $courseController = new CourseController();
    $discountController = new DiscountController();
    $moduleController   = new ModuleController();
    $sportController    = new SportController();
    $discountController    = new DiscountController();
    $userController    = new UserController();

    $userController->getDataUserId($userId);
    $course = $courseController->getCourseById($courseId);
    $discount = $discountController->getAllDiscount();

    // Depuración: imprimir el contenido de $course

    $imageCourse = $course["CIimage"];
    $status = $course["Cstatus"];
    $dataQH = $courseController->getCourseByIdQH($courseId);

    include 'course-validation.php';
    include 'course-pagination.php';
    include 'course-modal.php';
    include 'course-pagination-available.php';
}
?>


<script>
    Swal.fire({
        imageUrl: "https://vacacionales.teampichincha.com/Transferencias.png",
        imageWidth: 425,
        imageHeight: 450
    });
</script>

<div class="iq-navbar-header" style="height: 100px;">

    <div class="iq-header-img">
        <img src="./../assets/image/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
    </div>
</div>





<div class="container-fluid content-inner mt-n5 py-0" id="page_layout">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="row ">

                        <div class="bd-example">
                            <div class="alert alert-solid alert-danger rounded-pull alert-dismissible fade show " role="alert">
                                <span style="font-size: 20px; text-align: justify;">
                                    Una vez comprado un <b>cupo</b> en algun Curso Deportivo <b>no habrá devoluciones, ni cambio</b> a otro Curso Deportivo.
                                    </b></center>
                                </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <?php

                            if ($imageCourse != null) { ?>
                                <img src="<?php echo './../assets/image/system/course/' . $imageCourse ?>" alt="avatar" id="img-update" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload-update').click()" width="100%">
                            <?php    } else { ?>
                                <img src="./../assets/image/avatars/01.png" alt="avatar" id="img" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload-update').click()" width="100%">
                            <?php    } ?>
                        </div>
                        <div class="col-lg-6 mt-4 mt-lg-0">
                            <div class="border-bottom">
                                <div class="d-flex flex-column align-content-between justify-items-center mb-2">

                                    <div class="d-flex justify-content-between mb-2">
                                        <h2 class="mb-0"><?php echo $course['Sname'] ?></h2>

                                        <a href="course-available" class="btn btn-icon btn-primary" data-bs-toggle="tooltip" title="Volver a la página anterior">
                                            <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" d="M12 22.0002C6.485 22.0002 2 17.5142 2 12.0002C2 6.48624 6.485 2.00024 12 2.00024C17.514 2.00024 22 6.48624 22 12.0002C22 17.5142 17.514 22.0002 12 22.0002Z" fill="#FFFFFF"></path>
                                                    <path d="M13.4425 16.2208C13.2515 16.2208 13.0595 16.1478 12.9135 16.0018L9.42652 12.5318C9.28552 12.3908 9.20652 12.1998 9.20652 11.9998C9.20652 11.8008 9.28552 11.6098 9.42652 11.4688L12.9135 7.99683C13.2065 7.70483 13.6805 7.70483 13.9735 7.99883C14.2655 8.29283 14.2645 8.76783 13.9715 9.05983L11.0185 11.9998L13.9715 14.9398C14.2645 15.2318 14.2655 15.7058 13.9735 15.9998C13.8275 16.1478 13.6345 16.2208 13.4425 16.2208Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                    <div class=" d-flex align-items-center w-100">
                                        <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z" fill="#FFD329"></path>
                                        </svg>
                                        <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z" fill="#FFD329"></path>
                                        </svg>
                                        <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z" fill="#FFD329"></path>
                                        </svg>
                                        <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z" fill="#FFD329"></path>
                                        </svg>
                                        <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z" fill="#FFD329"></path>
                                        </svg>
                                        <h6 class="ms-2 mb-0">5.0</h6>
                                    </div>
                                    <div class="d-flex my-4">
                                        <h4 class="mb-0"> Precio:</h4>
                                        <h4 class="text-primary mb-0 ms-2">$<?php echo $course['CIprice'] ?></h4>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $Mstart = strtotime($course["Mstart"]);
                            $Mstart = date("d-m-Y", $Mstart);
                            $Mend = strtotime($course["Mend"]);
                            $Mend = date("d-m-Y", $Mend);
                            ?>
                            <div class="d-flex flex-column py-2">
                                <form action="">
                                    <div class="form-group col-md-12 py-2">
                                        <!-- <h6 class="py-2">Escenarios y horarios disponibles</h6> -->
                                        <input type="hidden" name="course" id="course" class="form-control" value="<?php echo $courseId ?>">
                                        <div class="form-group">
                                            <select name="module" id="module" class="form-control  rounded-pill text-black" required onchange="showSelectedValues()">
                                                <option value="">Selecciona un escenario y horario</option>
                                                <?php foreach ($dataQH as $row) {
                                                    $QHid =  $row['QHid'] ?>
                                                    <option value="<?php echo $row['QHid']; ?>" data-ename="<?php echo htmlspecialchars($row['Ename']); ?>" data-qhstart="<?php echo htmlspecialchars($row['QHstart']); ?>" data-qhend="<?php echo htmlspecialchars($row['QHend']); ?>" data-qhquota="<?php echo htmlspecialchars($row['QHquota']); ?>">
                                                        <?php echo $row['Ename'] . ' | HORARIO DE ' . $row['QHstart'] . ' - ' . $row['QHend'] . ' | CUPOS ' . $row['QHquota']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>




                                        <div id="selectedValues" style="display: none;">
                                            <p>
                                            <h5>Detalle del curso</h5>
                                            <b> Escenario:</b> <span id="selectedEname"></span><br>
                                            <b> Horario:</b> <span id="selectedQHstart"></span> - <span id="selectedQHend"></span><br>
                                            <b>Cupos Disponibles:</b> <span id="selectedQHquota"></span>
                                            </p>
                                        </div>

                                        <script>
                                            function showSelectedValues() {
                                                var select = document.getElementById('module');
                                                var selectedOption = select.options[select.selectedIndex];
                                                var selectedValuesDiv = document.getElementById('selectedValues');
                                                var buyButton = document.getElementById('buyButton');

                                                if (selectedOption.value !== '') {
                                                    var ename = selectedOption.getAttribute('data-ename');
                                                    var qhstart = selectedOption.getAttribute('data-qhstart');
                                                    var qhend = selectedOption.getAttribute('data-qhend');
                                                    var qhquota = selectedOption.getAttribute('data-qhquota');

                                                    document.getElementById('selectedEname').textContent = ename;
                                                    document.getElementById('selectedQHstart').textContent = qhstart;
                                                    document.getElementById('selectedQHend').textContent = qhend;
                                                    document.getElementById('selectedQHquota').textContent = qhquota;

                                                    // Mostrar el div
                                                    selectedValuesDiv.style.display = 'block';

                                                    // Actualizar el enlace
                                                    var courseId = <?php echo json_encode($courseId); ?>; // Asegúrate de que $courseId esté definido en PHP
                                                    var newHref = 'order-process?quota-hour-scenery=' + selectedOption.value + '&course-id=' + courseId;
                                                    buyButton.href = newHref;
                                                    buyButton.classList.remove('disabled-link');
                                                } else {
                                                    selectedValuesDiv.style.display = 'none';
                                                    // Deshabilitar el enlace
                                                    buyButton.href = '#';
                                                    buyButton.classList.add('disabled-link');
                                                }
                                            }
                                        </script>
                                        <style>
                                            .disabled-link {
                                                pointer-events: none;
                                                opacity: 0.6;
                                            }
                                        </style>

                                      

                                        <!-- <div class="text-center py-2">
                                            <div id="miBoton" class="btn btn-secondary rounded-pill">Descuentos</div>
                                        </div> -->
                                        <script>
                                            document.getElementById("miBoton").onclick = function() {
                                                Swal.fire({
                                                    icon: "success",
                                                    title: "Aplicaciones de Descuentos",
                                                    text: "Solamente en los puntos de inscripción en las Oficinas Matriz, Piscinas de Miraflores, El Batán, Cotocollao y Jipijapa."
                                                });
                                            }
                                        </script>

                                        <div class="text-center py-2">


                                            <a id="buyButton" class="btn btn-primary disabled-link rounded-pill" href="#">
                                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                                Adquirr <b>1</b> cupo
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Descripción del curso</h5>
                    <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                        <div class="d-flex flex-column">
                            <p class=" mb-0" style="text-align: justify;"><?php echo $course['CIdescription'] ?>.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

</div>