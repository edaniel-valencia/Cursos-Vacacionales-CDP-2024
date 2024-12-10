<div style="float:right;">
    <a class="btn btn-sm btn-icon text-primary flex-end" data-bs-toggle="modal" data-bs-target="#sport-edit<?php echo $row["Sid"] ?>">
        <span class="btn-inner">
            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
    </a>
    <div class="modal fade" id="sport-edit<?php echo $row["Sid"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Actualizar la  deporte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="profile-img-edit position-relative">
                                    <?php
                                    if ($imageName != null) { ?>
                                        <img src="<?php echo '../assets/image/system/sport/' . $imageName ?>" alt="avatar" id="img-update-<?php echo $row["Sid"] ?>" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload-update-<?php echo $row['Sid'] ?>').click()" width="100%">
                                        <input type="hidden" class="form-control text-primary" name="current_image" value="<?php echo $imageName; ?>" placeholder="Nombre de la categoría">
                                    <?php    } else { ?>
                                        <img src="./../assets//image/system/sport/sport.jpg" alt="avatar" id="img-update" class="theme-color-default-img profile-pic rounded" onclick="document.getElementById('file-upload-update').click()" width="100%">
                                    <?php    } ?>
                                    <!-- <input type="hidden" name="Uid" value="<?php echo $row["Sid"]  ?>"> -->
                                    <input type="hidden" class="form-control text-primary" id="id" name="id" value="<?php echo $row["Sid"] ?>">
                                    <input type="hidden" class="form-control text-primary" id="pagina" name="pagina" value="<?php echo $pagina ?>">

                                    <input id="file-upload-update-<?php echo $row["Sid"] ?>" class="file-upload" type="file" name="imagen" accept="image/*" style="display: none;" onchange="fileImageUpdate('<?php echo $row['Sid']; ?>')">
                                </div>

                            </div>


                            <div class="form-group col-md-8">
                                <div class="form-floating mb-3">
                                    <input type="hidden" class="form-control text-primary" id="id" name="id" value="<?php echo $row["Sid"] ?>" oninput="validateFormUpdateSport()">
                                    <input type="text" class="form-control text-primary" id="name" name="name" value="<?php echo $row["Sname"] ?>" placeholder="Nombre de la  deporte" required oninput="validateFormUpdateSport()">
                                    <label for="Uname">Nombre del deporte</label>
                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="form-control" rows="2" cols="50" name="description" placeholder="Agrega la description"><?php echo $row["Sdescription"] ?></textarea>

                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <select name="status" id="status" class=" form-control" value="<?php echo $row["Sid"] ?>" data-style="py-0">
                                    <option>Selecciona el deporte</option>
                                    <?php
                                    $statusController = new StatusController();
                                    $status = $statusController->getStatus();
                                    foreach ($status as $sts) {
                                        $selected = ($sts["Scodigo"] == $row["Sstatus"]) ? "selected" : ""; // Comprueba si  el deporte coincide con  el deporte del usuario y marca como seleccionado si es así
                                        echo '<option value="' . $sts["Scodigo"] . '" ' . $selected . '>' . $sts["Sname"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" id="submit-sport-update" name="submit-sport-update" data-bs-dismiss="modal">
                                <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-sm btn-icon text-danger flex-end" data-bs-toggle="modal" data-bs-target="#sport-delete<?php echo $row["Sid"] ?>">
        <span class="btn-inner">
            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
    </a>
    <div class="modal fade" id="sport-delete<?php echo $row["Sid"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Eliminar el deporte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group col-md-12">
                            <div class="form-floating">
                                <input type="hidden" class="form-control text-primary" id="id" name="id" value="<?php echo $row["Sid"] ?>" placeholder="Nombre del deporte" required oninput="validateFormCreateRole()">
                                <input type="text" class="form-control text-danger" id="name" name="name" value="<?php echo $row["Sname"] ?>" placeholder="Nombre del deporte" required oninput="validateFormCreateRole()">
                                <label for="Uname">Nombre del deporte</label>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger" id="submit-sport-delete" name="submit-sport-delete" data-bs-dismiss="modal">
                                <i class="fa fa-trash" aria-hidden="true"></i> Eliminar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>