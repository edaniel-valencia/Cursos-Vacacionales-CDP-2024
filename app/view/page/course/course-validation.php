<script>
    function validateFormCreate() {
        var isValid = true;
        validateModule();
        validateScenery();
        validateSport();
        validateHourStart();
        validateHourEnd();
        validateHour();
        validateKit();

        validateDescripcion();
        validatePrice();
        validateQuota();
        // validateHourRange();
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }
        var submitButton = document.getElementById("submit-course-add");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }
    document.getElementById("formCreateAdd").addEventListener("input", validateFormCreate);

    function validateFormUpdate() {
        var isValid = true;
        fileImageUpdate();
        validateModule();

        validateSport();
        validatePrice();
        validateKit();
        validateDescripcion();
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }
        var submitButton = document.getElementById("submit-course-update-info");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }
    document.getElementById("formUpdateInformation").addEventListener("input", validateFormUpdate);

   

    function validateModule() {
        var inputModule = document.getElementById("module");
        var selectedValue = inputModule.value;

        if (selectedValue.trim() === "") {
            inputModule.style.borderColor = "red";
        } else {
            inputModule.style.borderColor = "green";
        }
    }

    function validateScenery() {
        var inputModule = document.getElementById("scenery");
        var selectedValue = inputModule.value;

        if (selectedValue.trim() === "") {
            inputModule.style.borderColor = "red";
        } else {
            inputModule.style.borderColor = "green";
        }
    }

    function validateSport() {
        var inputSport = document.getElementById("sport");
        var selectedValue = inputSport.value;

        if (selectedValue.trim() === "") {
            inputSport.style.borderColor = "red";
        } else {
            inputSport.style.borderColor = "green";
        }
    }

    function validateDescripcion() {
        var inputName = document.getElementById("description");
        var regex = /^[A-Za-z0-9\s-,.\u00C0-\u00FF¡!$]+$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }
    function validateKit() {
        var inputName = document.getElementById("kit");
        var regex = /^[A-Za-z0-9\s-,.]+$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }

    function validateHourStart() {
        var inputName = document.getElementById("start_time");
        var regex = /^([01]\d|2[0-3]):([0-5]\d)$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }

    function validateHourEnd() {
        var inputName = document.getElementById("end_time");
        var regex = /^([01]\d|2[0-3]):([0-5]\d)$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }

    
    function validateHour() {
        var startTimeInput = document.getElementById("start_time");
        var endTimeInput = document.getElementById("end_time");

        // Expresión regular para validar el formato de la hora (hh:mm)
        var regex = /^([01]\d|2[0-3]):([0-5]\d)$/;

        // Obtener los valores de las horas y minutos de inicio y fin
        var startTime = startTimeInput.value;
        var endTime = endTimeInput.value;

        // Verificar si ambos campos tienen el formato correcto
        if (!regex.test(startTime) || !regex.test(endTime)) {
            startTimeInput.style.borderColor = "red";
            endTimeInput.style.borderColor = "red";
            return; // Detener la validación si alguno de los campos no tiene el formato correcto
        }

        // Extraer las horas y minutos de inicio y fin
        var startParts = startTime.split(":");
        var endParts = endTime.split(":");

        var startHour = parseInt(startParts[0]);
        var startMinute = parseInt(startParts[1]);
        var endHour = parseInt(endParts[0]);
        var endMinute = parseInt(endParts[1]);

        // Verificar si la hora final es mayor que la hora inicial
        if (endHour < startHour || (endHour === startHour && endMinute <= startMinute)) {
            startTimeInput.style.borderColor = "red";
            endTimeInput.style.borderColor = "red";
        } else {
            startTimeInput.style.borderColor = "green";
            endTimeInput.style.borderColor = "green";
        }
    }

    function validatePrice() {
        var inputPrice = document.getElementById("price");
        var PriceValue = inputPrice.value.trim();
        var regex = /^[0-9]+(\.[0-9]+)?$/;

        if (!regex.test(PriceValue)) {
            inputPrice.style.borderColor = "red";
        } else {
            inputPrice.style.borderColor = "green";
        }
    }

    function validateQuota() {
        var inputQuota = document.getElementById("quota");
        var QuotaValue = inputQuota.value.trim();
        var regex = /^[0-9]+$/; // Expresión regular que permite números decimales

        if (!regex.test(QuotaValue)) {
            inputQuota.style.borderColor = "red";
        } else {
            inputQuota.style.borderColor = "green";
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