<div class="modal fade" id="invoice-edit-voucher-<?php echo $invoiceId ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar el datos de la factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-group text-center">
                                <div class="profile-img-edit position-relative">
                                    <input type="hidden" id="Iid" name="Iid" value="<?php echo $invoiceId ?>" class="form-control">
                                    <input type="hidden" id="Did" name="Did" value="<?php echo $data['Did'] ?>" class="form-control">
                                    <input type="hidden" id="Cid" name="Cid" value="<?php echo $data['Cid'] ?>" class="form-control">
                                    <input type="hidden" id="Uid" name="Uid" value="<?php echo $data['Uid'] ?>" class="form-control">

                                    <img src="<?php echo './../assets/image/system/voucher/' . $imageVoucher ?>" alt="avatar" id="img-update" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload-update').click()" width="100%">

                                    <input type="hidden" name="Cid" value="<?php echo $courseId ?>">
                                    <input id="file-upload-update" class="file-upload" type="file" name="imagen" value="<?php echo $imageVoucher ?>" id="imagen" accept="image/*" style="display: none;" oninput="fileImageUpdate()">
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
                        </div>

                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="submit-invoice-voucher-update" name="submit-invoice-voucher-update">
                            <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="invoice-my-register-quota-hour-edit-<?php echo $invoiceId ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar el horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-group text-center">
                                <div class="profile-img-edit position-relative">
                                    <input type="hidden" id="Iid" name="Iid" value="<?php echo $invoiceId ?>" class="form-control">
                                    <input type="hidden" id="Did" name="Did" value="<?php echo $data['Did'] ?>" class="form-control">
                                    <input type="hidden" id="Cid" name="Cid" value="<?php echo $data['Cid'] ?>" class="form-control">
                                    <input type="hidden" id="Uid" name="Uid" value="<?php echo $data['Uid'] ?>" class="form-control">
                                    <input type="hidden" id="QHidA" name="QHidA" value="<?php echo $data['QHid'] ?>" class="form-control">
                                    <div class="form-floating">
                                        <select name="QHid" id="QHid" class="form-control" required>
                                            <option value="<?php echo $data["QHid"]; ?>"><?php echo $data["QHstart"] . ' - ' . $data["QHend"]; ?></option>
                                            <?php foreach ($quota_hour as $QHrow) { ?>
                                                <option value=" <?php echo $QHrow["QHid"]; ?>"><?php echo $QHrow["QHstart"] . ' - ' . $QHrow["QHend"] . ' - ' . $QHrow["Ename"]; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="sport">Horario disponible</label>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="submit-invoice-quota-hour-update" name="submit-invoice-quota-hour-update">
                            <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="invoice-discount-<?php echo $invoiceId ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar el descuento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-group text-center">
                                <div class="profile-img-edit position-relative">
                                    <input type="hidden" id="Iid" name="Iid" value="<?php echo $invoiceId ?>" class="form-control">
                                    <!-- <input type="hidden" id="Did" name="Did" value="<?php echo $data['Did'] ?>" class="form-control"> -->
                                    <input type="hidden" id="Cid" name="Cid" value="<?php echo $data['Cid'] ?>" class="form-control">
                                    <input type="hidden" id="Uid" name="Uid" value="<?php echo $data['Uid'] ?>" class="form-control">
                                    <input type="hidden" id="QHidA" name="QHidA" value="<?php echo $data['QHid'] ?>" class="form-control">
                                    <div class="form-floating">
                                        <select name="Did" id="Did" class="form-control" required>
                                            <option value="<?php echo $data["Did"]; ?>"><?php echo $data["Dpercentage"] . '% de ' . $data["Ddescription"]; ?></option>
                                            <?php foreach ($discount as $Drow) { ?>
                                                <option value=" <?php echo $Drow["Did"]; ?>"><?php echo $Drow["Dpercentage"] . '% de ' . $Drow["Ddescription"]; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="sport">Porcetaje de descuentos</label>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="submit-invoice-discount-update" name="submit-invoice-discount-update">
                            <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="invoice-change-module-<?php echo $invoiceId ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cambio de modulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-group text-center mb-2">
                                <input type="hidden" id="Iid" name="Iid" value="<?php echo $invoiceId ?>" class="form-control">
                                <input type="hidden" id="Uid" name="Uid" value="<?php echo $data['Uid'] ?>" class="form-control">
                                <input type="hidden" id="Did" name="Did" value="<?php echo $data['Did'] ?>" class="form-control">
                                <input type="hidden" id="QHidA" name="QHidA" value="<?php echo $data['QHid'] ?>" class="form-control">

                            </div>

                            <div class="">
                                <div class="form-control input-group mb-3">
                                    <select name="sportMC" id="sportMC" class="form-control js-example-basic-single" data-style="py-0" required onchange="showSelectedValuesCourse()">
                                        <option value="">Selecciona el cambio de deporte por modulo</option>
                                        <?php
                                        $coursesMC = $courseController->getAllCoursePOSTSE();
                                        foreach ($coursesMC as $row) {
                                            $Mstart = strtotime($row["Mstart"]);
                                            $Mstart = date("d-m-Y", $Mstart);
                                            $Mend = strtotime($row["Mend"]);
                                            $Mend = date("d-m-Y", $Mend);
                                        ?>
                                            <option value="<?php echo $row["Sid"] ?>" data-cid="<?php echo htmlspecialchars($row['Cid']); ?>" data-qhid="<?php echo htmlspecialchars($row['QHid']); ?>" data-sname="<?php echo htmlspecialchars($row['Sname']); ?>" data-ename="<?php echo htmlspecialchars($row['Ename']); ?>" data-qhstart="<?php echo htmlspecialchars($row['QHstart']); ?>" data-qhend="<?php echo htmlspecialchars($row['QHend']); ?>" data-ciprice="<?php echo htmlspecialchars($row['CIprice']); ?>" data-mname="<?php echo htmlspecialchars($row['Mname']); ?>" data-mstart="<?php echo htmlspecialchars($Mstart); ?>" data-mend="<?php echo htmlspecialchars($Mend); ?>">
                                                <?php echo $row["Mname"] . ' | ' . $row["Sname"] . ' DE ' . $row["QHstart"] . ' A ' . $row["QHend"] . ' | ' . $row["Ename"] .  ' | CUPOS ' . $row["QHquota"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-control input-group mb-3">
                                    <div id="selectedCourseDetails"></div>
                                    <script>                                    
                                        function showSelectedValuesCourse() {
                                            var selectElement = document.getElementById("sportMC");
                                            var selectedOption = selectElement.options[selectElement.selectedIndex];

                                            var cid = selectedOption.getAttribute("data-cid");
                                            var qhid = selectedOption.getAttribute("data-qhid");
                                            var sname = selectedOption.getAttribute("data-sname");
                                            var ename = selectedOption.getAttribute("data-ename");
                                            var qhstart = selectedOption.getAttribute("data-qhstart");
                                            var qhend = selectedOption.getAttribute("data-qhend");
                                            var ciprice = selectedOption.getAttribute("data-ciprice");
                                            var mname = selectedOption.getAttribute("data-mname");
                                            var mstart = selectedOption.getAttribute("data-mstart");
                                            var mend = selectedOption.getAttribute("data-mend");

                                            var courseDetails = `
                                                                <div id="courseDetails_${selectedOption.value}">
                                                                <input hidden value="${cid}" name="Cid" id="Cid"/>
                                                                <input hidden value="${qhid}" name="QHid" id="QHid"/>
                                                                <strong>${mname}</strong> <br>
                                                                <p><strong>Nombre del deporte:</strong> ${sname}<br>
                                                                <strong>Nombre del evento:</strong> ${ename}<br>
                                                                <strong>Horario del curso:</strong> ${qhstart} - ${qhend}<br>
                                                                <strong>Precio:</strong> ${ciprice}<br>
                                                                <strong>Inicio del curso</strong> ${mstart} - ${mend}</p>
                                                                </div>
                                                            `;

                                            document.getElementById("selectedCourseDetails").innerHTML = courseDetails;
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="submit-invoice-update" name="submit-invoice-update">
                            <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="invoice-my-register-delete-<?php echo $invoiceId ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Eliminar inscripción del curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-group text-center">
                                <div class="profile-img-edit position-relative">
                                    <input type="hidden" id="Iid" name="Iid" value="<?php echo $invoiceId ?>" class="form-control">
                                    <input type="hidden" id="Did" name="Did" value="<?php echo $data['Did'] ?>" class="form-control">
                                    <input type="hidden" id="Cid" name="Cid" value="<?php echo $data['Cid'] ?>" class="form-control">
                                    <input type="hidden" id="Uid" name="Uid" value="<?php echo $data['Uid'] ?>" class="form-control">
                                    <input type="hidden" id="QHid" name="QHid" value="<?php echo $data['QHid'] ?>" class="form-control">

                                    <label for="sport" class="text-danger"> <?php echo '<b>' . $data['Mname'] . '</b> del Curso de <b>' . $data['Sname']
                                                                                . '</b> <br><b>' . $data['Uname'] . ' ' . $data['Ulastname'] . '</b>' ?> </label>

                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-danger" id="submit-invoice-delete" name="submit-invoice-delete">
                            <i class="fa fa-trash" aria-hidden="true"></i> Eliminar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>