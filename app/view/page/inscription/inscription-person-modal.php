<div class="modal fade" id="invoice-person-voucher-edit-<?php echo $invoiceId ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

<div class="modal fade" id="invoice-person-status-edit-<?php echo $invoiceId ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar estado de pago</h5>
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
                                    <div class="form-group col-md-12">
                                        <select name="PSid" id="PSid" class="form-control js-example-basic-single" required oninput="validateFormCreate()">
                                            <option value="<?php echo $data['PSid'] ?>"><?php echo $data['PSname'] ?></option>
                                            <?php foreach ($paymentStatus as $PSrow) { ?>
                                                <option value="<?php echo $PSrow["PSid"]; ?>"><?php echo $PSrow["PSname"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <input type="text" id="INVN" name="INVN" value="<?php echo $data['InewVoucherNumber'] ?>" placeholder="Actualiza el numero de comprobante" class="form-control">

                                    
                                </div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="invoice-person-status-update" name="invoice-person-status-update">
                            <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>