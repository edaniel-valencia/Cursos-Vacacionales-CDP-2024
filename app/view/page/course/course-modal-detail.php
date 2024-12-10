<a class="btn btn-sm btn-icon text-primary flex-end" data-bs-toggle="modal" data-bs-target="#quota-hour-edit-<?php echo $QHid ?>">
    <span class="btn-inner">
        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </span>
</a>
<div class="modal fade" id="quota-hour-edit-<?php echo $QHid ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar el horario y los cupos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control text-primary" id="id" name="id" value="<?php echo $row["QHid"] ?>">
                    <input type="hidden" class="form-control text-primary" id="Cid" name="Cid" value="<?php echo $data["Cid"] ?>">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-floating">
                                <select name="scenery" id="scenery" class="form-control" required oninput="validateFormUpdate()">
                                    <option value="<?php echo $row["Eid"]; ?>"><?php echo $row["Ename"] ?></option>
                                    <?php foreach ($scenery as $Mrow) { ?>
                                        <option value="<?php echo $Mrow["Eid"]; ?>"><?php echo $Mrow["Ename"] ?></option>
                                    <?php } ?>
                                </select>
                                <label for="scenery">Escenario del curso</label>
                            </div>
                        </div>
                        <div class=" form-group  col-md-4">
                            <div class="form-floating">
                                <input type="time" name="start_time" id="start_time" class="form-control" placeholder="TSoftec" value="<?php echo $row["QHstart"] ?>" required oninput="validateFormUpdatecourse()">
                                <label for="start_time">Hora Inicial</label>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-floating">
                                <input type="time" name="end_time" id="end_time" class="form-control" placeholder="TSoftec" value="<?php echo $row["QHend"] ?>" required oninput="validateFormUpdatecourse()">
                                <label for="end_time">Hora Final</label>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-floating">
                                <input type="text" id="quota" name="quota" class="form-control" maxlength="3" placeholder="TSoftec" value="<?php echo $row["QHquota"] ?>" required oninput="validateFormUpdatecourse()">
                                <label for="quota">Cupos</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                    <select name="QHstatus" id="QHstatus" class=" form-control" value="<?php echo $row["QHid"] ?>" data-style="py-0">
                                <option>Selecciona el estatus</option>
                                <?php
                                $statusController = new StatusController();
                                $status = $statusController->getStatus();
                                foreach ($status as $sts) {
                                    $selected = ($sts["Sid"] == $row["QHstatus"]) ? "selected" : ""; // Comprueba si  el modulo coincide con  el modulo del usuario y marca como seleccionado si es así
                                    echo '<option value="' . $sts["Sid"] . '" ' . $selected . '>' . $sts["Sname"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="submit-course-update-quota-hour" name="submit-course-update-quota-hour">
                            <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<a class="btn btn-sm btn-icon text-danger flex-end" data-bs-toggle="modal" data-bs-target="#quota-hour-delete-<?php echo $QHid ?>">
    <span class="btn-inner">
        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
            <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </span>
</a>
<div class="modal fade" id="quota-hour-delete-<?php echo $QHid ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Eliminar el horario y cupo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="text-center">
                        <!-- <p class=" text-danger"><?php echo '<B>CURSO DE ' . $data["Sname"] . ' DEL ' . $data["Mname"] . '</B> <br> ' . $data["Mdescription"] ?></p> -->
                        <p class=" text-danger"><?php echo '<B>HORARIO: </B> ' . $row["QHstart"] . ' a ' . $row["QHend"] . '<BR><B>CUPOS: </B> ' . $row["QHquota"] ?></p>
                    </div>
                    <input type="hidden" class="form-control text-primary" id="id" name="id" value="<?php echo $row["QHid"] ?>">
                    <input type="hidden" class="form-control text-primary" id="Cid" name="Cid" value="<?php echo $data["Cid"] ?>">
                    <div class="text-center">
                        <button type="submit" class="btn btn-danger" id="submit-course-delete-quota-hour" name="submit-course-delete-quota-hour" data-bs-dismiss="modal">
                            <i class="fa fa-trash" aria-hidden="true"></i> Eliminar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>