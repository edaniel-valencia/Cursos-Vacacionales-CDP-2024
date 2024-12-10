<script>
    function validateFormCreate() {
        var isValid = true;
        validateName();
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }
        var submitButton = document.getElementById("submit-kit-add");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }
    document.getElementById("formKitCreate").addEventListener("input", validateFormCreate);


    function validateName() {
        var inputName = document.getElementById("name");
        var regex = /^[A-Z0-9\s-]+$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }

    function validateDescripcion() {
        var inputName = document.getElementById("description");
        var regex = /^[A-Z0-9\s-]+$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }


    function fileImage() {
        const file = document.getElementById('file-upload');
        const img = document.getElementById('img');

        if (file.files[0]) {
            const uploadedFile = file.files[0];
            if (uploadedFile.type.startsWith('image/')) {
                if (uploadedFile.size <= 2 * 1024 * 1024) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.src = e.target.result;
                    }
                    reader.readAsDataURL(uploadedFile);
                } else {
                    Swal.fire({
                        position: "top-center",
                        icon: "error",
                        title: "La imagen supera los 2 MB",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    file.value = '';
                }
            } else {
                Swal.fire({
                    position: "top-center",
                    icon: "error",
                    title: "Sube una imagen",
                    showConfirmButton: false,
                    timer: 2500
                });
                file.value = '';
            }
        }
    }


    ////////////////////////////////////////////////////////////////
    ////////////////////                        ////////////////////
    ////////////////////   ACTUALIZAR MODULO    ////////////////////
    ////////////////////                        ////////////////////
    ////////////////////////////////////////////////////////////////

    function validateFormUpdatekit() {
        var isValid = true;
        validateNameUpdate();
        validateDescriptionUpdate();
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }
        var submitButton = document.getElementById("submit-kit-update");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }

    function validateNameUpdate() {
        var inputName = document.getElementById("name");
        var regex = /^[A-Z0-9\s-,]+$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }
    function validateDescriptionUpdate() {
        var inputName = document.getElementById("description");
        var regex = /^[A-Z0-9\s-,]+$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }


    function fileImageUpdate(id) {
        const file = document.getElementById('file-upload-update-' + id);
        const img = document.getElementById('img-update-' + id);

        if (file.files[0]) {
            const uploadedFile = file.files[0];
            if (uploadedFile.type.startsWith('image/')) {
                if (uploadedFile.size <= 2 * 1024 * 1024) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.src = e.target.result;
                    }
                    reader.readAsDataURL(uploadedFile);
                } else {
                    Swal.fire({
                        position: "top-center",
                        icon: "error",
                        title: "La imagen supera los 2 MB",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    file.value = '';
                }
            } else {
                Swal.fire({
                    position: "top-center",
                    icon: "error",
                    title: "Sube una imagen",
                    showConfirmButton: false,
                    timer: 2500
                });
                file.value = '';
            }
        }
    }
</script>