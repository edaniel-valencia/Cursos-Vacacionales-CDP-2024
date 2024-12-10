<script>
    function validateFormPay() {
        var isValid = true;
        validateBanco();
        validateNumber();

        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }
        var submitButton = document.getElementById("submit-course-pay");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }
    document.getElementById("formPay").addEventListener("input", validateFormPay);


    function validateBanco() {
        var input = document.getElementById("banco_pay");
        var selectedValue = input.value;

        if (selectedValue.trim() === "") {
            input.style.borderColor = "red";
        } else {
            input.style.borderColor = "green";
        }
    }

    function validateNumber() {
        var input = document.getElementById("number_pay");
        var Value = input.value.trim();
        var regex = /^\d+$/;

        if (!regex.test(Value)) {
            input.style.borderColor = "red";
        } else {
            input.style.borderColor = "green";
        }
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




    // function validateFormUpdateImage(id) {
    //     var isValid = true;
    //     fileImageUpdate(id);

    //     var inputs = document.getElementsByTagName("input");
    //     for (var i = 0; i < inputs.length; i++) {
    //         if (inputs[i].style.borderColor === "red") {
    //             isValid = false;
    //             break;
    //         }
    //     }

    //     var submitButton = document.getElementById("submit-btn-update-image");
    //     if (isValid) {
    //         submitButton.removeAttribute("disabled");
    //     } else {
    //         submitButton.setAttribute("disabled", "disabled");
    //     }
    // }
    // document.getElementById("formUpdateImage").addEventListener("input", validateFormUpdateImage);

    function fileImageUpdate() {
        const file = document.getElementById('file-upload-update');
        const img = document.getElementById('img-update');

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