<div class="modal fade" id="quota-hour-add-<?php echo $courseId ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog   modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar nuevo horario y hora al curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="">

                            <input type="hidden" class="form-control text-primary" id="id" name="id" value="<?php echo $data["Cid"] ?>">

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="form-floating">
                                        <select name="scenery" id="scenery" class="form-control" required oninput="validateFormCreate()">
                                            <option value="">Selecciona un escenario para el curso</option>
                                            <?php foreach ($scenery as $Erow) { ?>
                                                <option value="<?php echo $Erow["Eid"]; ?>"><?php echo $Erow["Ename"] ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="scenery">Escenario del curso</label>
                                    </div>
                                </div>
                                <div class=" form-group  col-md-4">
                                    <div class="form-floating">
                                        <input type="time" name="start_time" id="start_time" class="form-control" placeholder="TSoftec" required oninput="validateFormUpdatecourse()">
                                        <label for="start_time">Hora Inicial</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-floating">
                                        <input type="time" name="end_time" id="end_time" class="form-control" placeholder="TSoftec" required oninput="validateFormUpdatecourse()">
                                        <label for="end_time">Hora Final</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-floating">
                                        <input type="text" id="quota" name="quota" class="form-control" maxlength="3" placeholder="TSoftec" required oninput="validateFormUpdatecourse()">
                                        <label for="quota">Cupos</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" id="submit-course-update-quota-hour" name="submit-course-add-quota-hour">
                                <i class="fa fa-save" aria-hidden="true"></i> Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="course-delete-<?php echo $courseId ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Eliminar el curso deportivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group col-md-12">
                        <div class="form-floating">
                            <input type="hidden" class="form-control text-primary" id="id" name="id" value="<?php echo $courseId ?>" placeholder="Nombre del modulo">
                            <input type="hidden" class="form-control text-primary" id="QHid" name="QHid" value="<?php echo $data['QHid'] ?>" placeholder="Nombre del modulo">
                        </div>
                        <label for=""><?php echo 'Curso deportivo ' . $data["Sname"] . ' del ' . $data['Mname'] . ' - ' . $data['Myear'] ?></label>

                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-danger" id="submit-course-delete" name="submit-course-delete" data-bs-dismiss="modal">
                            <i class="fa fa-trash" aria-hidden="true"></i> Eliminar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>