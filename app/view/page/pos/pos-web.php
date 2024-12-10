<?php


$courseController = new CourseController();
$courses = $courseController->getAllCoursePOS();

$userController = new UserController();
$users = $userController->getAllUsersPOS();
$userController->createUserPOS();

$discountController = new DiscountController();
$discounts = $discountController->getAllDiscount();

$statusController = new StatusController();
$status = $statusController->getStatus();






include 'pos-script.php';
include 'pos-modal-add-user.php';

?>

<div class="iq-navbar-header">

    <div class="iq-header-img">
        <img src="./../assets/image/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
    </div>
</div>


<div class="container-fluid content-inner" id="page_layout">
    <div class="row">
        <div id="alertContainer"></div>

        <div id="cart" class="iq-product-tracker-card b-0 show">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card p-3">
                        <div class="row">
                            <div class="">
                                <h5 class="mb-0 py-2">Cursos Deportivos</h5>
                                <div class="form-control input-group mb-3">
                                    <select name="sport" id="sport" class="form-control js-example-basic-single" data-style="py-0" required onchange="showSelectedValuesCourse()">
                                        <option value="">Selecciona un deporte</option>
                                        <?php foreach ($courses as $row) {
                                            $Mstart = strtotime($row["Mstart"]);
                                            $Mstart = date("d-m-Y", $Mstart);
                                            $Mend = strtotime($row["Mend"]);
                                            $Mend = date("d-m-Y", $Mend);
                                        ?>
                                            <option value="<?php echo $row["Sid"] ?>" data-cid="<?php echo htmlspecialchars($row['Cid']); ?>" data-qhid="<?php echo htmlspecialchars($row['QHid']); ?>" data-sname="<?php echo htmlspecialchars($row['Sname']); ?>" data-ename="<?php echo htmlspecialchars($row['Ename']); ?>" data-qhstart="<?php echo htmlspecialchars($row['QHstart']); ?>" data-qhend="<?php echo htmlspecialchars($row['QHend']); ?>" data-ciprice="<?php echo htmlspecialchars($row['CIprice']); ?>" data-mname="<?php echo htmlspecialchars($row['Mname']); ?>" data-mstart="<?php echo htmlspecialchars($Mstart); ?>" data-mend="<?php echo htmlspecialchars($Mend); ?>">
                                                <!-- echo $row["Mname"]. ' | ' . $row["Sname"]. ' DE ' . $row["QHstart"] . ' A ' . $row["QHend"] .' | ' . $row["Ename"] . ' (CUPOS ' . $row["QHquota"].')'  -->
                                                <?php echo $row["Mname"] . ' | ' . $row["Sname"] . ' DE ' . $row["QHstart"] . ' A ' . $row["QHend"] . ' | ' . $row["Ename"] .  ' | CUPOS ' . $row["QHquota"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <h5 class="mb-0">Deportistas</h5>
                                <div class="form-control input-group mb-3">
                                    <select name="users" id="users" class="form-control js-example-basic-single" data-style="py-0" required onchange="showSelectedValuesUser()">
                                        <option value="">Selecciona un opción</option>
                                        <?php foreach ($users as $row) {
                                            $Ubirthdate = strtotime($row["Ubirthdate"]);
                                            $Ubirthdate = date("d-m-Y", $Ubirthdate);
                                        ?>
                                            <option value="<?php echo $row["Uid"] ?>" data-uid="<?php echo htmlspecialchars($row['Uid']); ?>" data-uname="<?php echo htmlspecialchars($row['Uname']); ?>" data-ulastname="<?php echo htmlspecialchars($row['Ulastname']); ?>" data-ucredential="<?php echo htmlspecialchars($row['Ucredential']); ?>" data-uemail="<?php echo htmlspecialchars($row['Uemail']); ?>" data-ubirthdate="<?php echo htmlspecialchars($Ubirthdate); ?>" data-ugender="<?php echo htmlspecialchars($row['Ugender']); ?>">
                                                <?php echo $row["Uname"] . ' ' . $row["Ulastname"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <h5 class="mb-0">Descuentos</h5>
                                <div class="input-group mb-3">
                                    <div class="">
                                        <select name="discount" id="discount" class="form-control" data-style="py-0" required onchange="showSelectedValuesDiscount()">
                                            <option value="">Selecciona un opción</option>

                                            <?php foreach ($discounts as $row) {
                                                // Check if Dpercentage is 100 and session variable Rname is 'TSoftEc'
                                                if ($row["Dpercentage"] == 100 && isset($_SESSION['Rid']) && $_SESSION['Rid'] ==5) {
                                            ?>
                                                    <option value="<?php echo $row["Did"] ?>" data-did="<?php echo htmlspecialchars($row['Did']); ?>" data-dpercentage="<?php echo htmlspecialchars($row['Dpercentage']); ?>" data-ddescription="<?php echo htmlspecialchars($row['Ddescription']); ?>">
                                                        <?php echo $row["Dpercentage"] . '% de ' . $row["Ddescription"]  ?>
                                                    </option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?php echo $row["Did"] ?>" data-did="<?php echo htmlspecialchars($row['Did']); ?>" data-dpercentage="<?php echo htmlspecialchars($row['Dpercentage']); ?>" data-ddescription="<?php echo htmlspecialchars($row['Ddescription']); ?>">
                                                        <?php echo $row["Dpercentage"] . '% de ' . $row["Ddescription"]  ?>
                                                    </option>
                                            <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div id="selectedValues" style="display: none; color:black">
                                    <p>
                                        <center>
                                            <h5 class="mb-2"><b>Detalle del Curso</b></h5>
                                        </center>
                                        <b><span id="selectedMname"></span></b><br>
                                        Disciplina: <b><span id="selectedSname"></span></b><br>
                                        <b><span id="selectedEname"></span></b><br>
                                        Horario: <b><span id="selectedQHstart"></span></b> a <b> <span id="selectedQHend"></span></b><br>
                                        <b><span id="selectedMstart"></span></b> y termina
                                        <b><span id="selectedMend"></span></b><br>
                                        <input type="hidden" id="QHid" value="">
                                        <span style="color: white;" id="selectedQHid"></span>
                                        <input type="hidden" id="Cid" value="">
                                        <span style="color: white;" id="selectedCid"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="selectedValuesUser" style="display: none; color:black">
                                    <p>
                                        <center>
                                            <h5 class="mb-2"><b>Datos del Deportista</b></h5>
                                        </center>
                                        Deportistas: <b><span id="selectedUname"></span> <span id="selectedUlastname"></span></b><br>
                                        Cédula de identidad: <b><span id="selectedUcredential"></span></b><br>
                                        Email: <b><span id="selectedUemail"></span></b><br>
                                        Fecha de nacimiento: <b><span id="selectedUbirthdate"></span></b><br>
                                        Género: <b><span id="selectedUgender"></span></b><br>

                                        <input type="hidden" id="Uid" value="">
                                        <span style="color: white;" id="selectedUid"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div id="selectedValuesDiscount" style="display: none; color:black">
                                    <p>
                                        Se aplica el <b style="color:red"> <span id="selectedDpercentage"></span>%</b> de <b style="color:red"> <span id="selectedDdescription"></span></b><br>
                                        <input type="hidden" id="Did" value="">
                                        <span style="color: white;" id="selectedDid"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Actualización del input 'Cid'
                            var selectedCidElement = document.getElementById('selectedCid');
                            var inputCidElement = document.getElementById('Cid');

                            function updateCidInput() {
                                inputCidElement.value = selectedCidElement.innerText;
                            }

                            var observerCid = new MutationObserver(updateCidInput);
                            observerCid.observe(selectedCidElement, {
                                childList: true,
                                characterData: true,
                                subtree: true
                            });

                            updateCidInput();

                            // Actualización del input 'QHid'
                            var selectedQHidElement = document.getElementById('selectedQHid');
                            var inputQHidElement = document.getElementById('QHid');

                            function updateQHidInput() {
                                inputQHidElement.value = selectedQHidElement.innerText;
                            }

                            var observerQHid = new MutationObserver(updateQHidInput);
                            observerQHid.observe(selectedQHidElement, {
                                childList: true,
                                characterData: true,
                                subtree: true
                            });

                            updateQHidInput();

                            // Actualización del input 'Uid'
                            var selectedUidElement = document.getElementById('selectedUid');
                            var inputUidElement = document.getElementById('Uid');

                            function updateUidInput() {
                                inputUidElement.value = selectedUidElement.innerText;
                            }

                            var observerUid = new MutationObserver(updateUidInput);
                            observerUid.observe(selectedUidElement, {
                                childList: true,
                                characterData: true,
                                subtree: true
                            });

                            updateUidInput();

                            // Actualización del input 'Did'
                            var selectedDidElement = document.getElementById('selectedDid');
                            var inputDidElement = document.getElementById('Did');

                            function updateDidInput() {
                                inputDidElement.value = selectedDidElement.innerText;
                            }

                            var observerDid = new MutationObserver(updateDidInput);
                            observerDid.observe(selectedDidElement, {
                                childList: true,
                                characterData: true,
                                subtree: true
                            });

                            updateDidInput();
                        });

                        document.addEventListener('DOMContentLoaded', function() {
                            var inputCidElement = document.getElementById('Cid');
                            var inputQHidElement = document.getElementById('QHid');
                            var inputUidElement = document.getElementById('Uid');
                            var inputDidElement = document.getElementById('Did');
                            var generateButton = document.getElementById('generateButton');

                            function checkInputs() {
                                if (inputCidElement.value && inputQHidElement.value && inputUidElement.value && inputDidElement.value) {
                                    generateButton.disabled = false;
                                } else {
                                    generateButton.disabled = true;
                                }
                            }

                            function updateInput(inputElement, selectedElementId) {
                                var selectedElement = document.getElementById(selectedElementId);

                                function update() {
                                    inputElement.value = selectedElement.innerText;
                                    checkInputs();
                                }
                                var observer = new MutationObserver(update);
                                observer.observe(selectedElement, {
                                    childList: true,
                                    characterData: true,
                                    subtree: true
                                });
                                update();
                            }

                            updateInput(inputCidElement, 'selectedCid');
                            updateInput(inputQHidElement, 'selectedQHid');
                            updateInput(inputUidElement, 'selectedUid');
                            updateInput(inputDidElement, 'selectedDid');
                        });

                        function generateUrl() {
                            var uid = document.getElementById('Uid').value;
                            var cid = document.getElementById('Cid').value;
                            var qhid = document.getElementById('QHid').value;
                            var did = document.getElementById('Did').value;

                            if (!uid || !cid || !qhid || !did) {
                                showAlert("Son obligatorio seleccionar todos las opciones.");
                                return;
                            }

                            var url = "order-process-pos?userId=" + encodeURIComponent(uid) +
                                "&courseId=" + encodeURIComponent(cid) +
                                "&quota_hourId=" + encodeURIComponent(qhid) +
                                "&discountId=" + encodeURIComponent(did);

                            var a = document.createElement('a');
                            a.href = url;
                            a.click();
                        }

                        function showAlert(message) {
                            var alertContainer = document.getElementById('alertContainer');
                            alertContainer.innerHTML = `
                        <div class="bd-example">
                            <div class="alert alert-solid alert-danger rounded-pull alert-dismissible fade show" role="alert">
                                <span style="font-size: 20px; text-align: justify;">
                                    ${message}
                                </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                                 `;
                        }
                    </script>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex mb-2">
                                <a class="btn btn-primary d-block w-100 rounded-pill" data-bs-toggle="modal" data-bs-target="#pos-modal-add-user"> <i class="fa fa-users" aria-hidden="true"></i>
                                    Agregar Deportista</a>
                            </div>
                            <div class="d-flex mb-2">
                                <a class="btn btn-secondary d-block w-100 rounded-pill" href="user-list-pos"> <i class="fa fa-search" aria-hidden="true"></i>
                                    Listado de Deportista</a>
                            </div>
                            <div class="d-flex mb-2">
                                <a class="btn btn-success d-block w-100 rounded-pill" href="pos-all-register"> <i class="fa fa-list" aria-hidden="true"></i>
                                    Todas las inscripciones</a>
                            </div>
                            <div class="d-flex">
                                <a class="btn btn-danger d-block w-100 rounded-pill" href="pos-my-register"> <i class="fa fa-list" aria-hidden="true"></i>
                                    Mis Inscripciones</a>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom mb-2 py-2">
                                <center>
                                    <h5 class="">Valor a Pagar</h5>
                                </center>
                            </div>
                            <div id="selectedValuesT" class="" style="display: none; color:black">
                                <div class="d-flex justify-content-between mb-4">
                                    <h6>Subtotal</h6>
                                    <h6 class="text-primary">$<span id="selectedQHpriceT"></span></h6>
                                </div>
                            </div>

                            <div id="selectedValuesDiscountP" style="display: none; color:black">

                                <div class="border-bottom">
                                    <div class="d-flex justify-content-between mb-2">
                                        <h6>Descuento</h6>
                                        <h6 class="text-success"> <span id="selectedDpercentageP"></span>%</h6>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="mt-4">
                                <div class="d-flex">
                                    <a id="buyButton" href="#payment" class="btn btn-success d-block mt-3 w-100">Verificar datos</a>
                                </div>
                            </div> -->

                            <div class="mt-4">
                                <div class="d-flex">
                                    <button onclick="generateUrl()" class="btn btn-primary rounded-pill d-block mt-3 w-100">
                                        <i class="fa fa-check-circle" aria-hidden="true"></i>

                                        Verificar datos</button>
                                    <p id="generatedUrl" style="color: blue;"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>