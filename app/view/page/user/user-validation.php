<script>
    // FUNCION POR SEPARADO
    function validateName() {
        var inputName = document.getElementById("name");
        var regex = /^[A-Z]+(\s[A-Z]+)*$/;
        var name = inputName.value.toUpperCase(); // Convertir el valor del campo a mayúsculas
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }

    function validateLastname() {
        var inputName = document.getElementById("lastname");
        var regex = /^[A-Z]+(\s[A-Z]+)*$/;
        var name = inputName.value.toUpperCase(); // Convertir el valor del campo a mayúsculas
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }

    function validateCredential() {
        var inputLastname = document.getElementById("credentity");
        var regex = /^\d{10,13}$/; // Expresión regular para validar que solo sean números y máximo 13 dígitos
        if (!regex.test(inputLastname.value)) {
            inputLastname.style.borderColor = "red";
        } else {
            inputLastname.style.borderColor = "green";
        }
    }

    function validateDate() {
        var inputDate = document.getElementById("birthdate").value.trim(); // Obtener el valor y eliminar espacios en blanco al inicio y al final
        if (inputDate === "") {
            document.getElementById("birthdate").style.borderColor = "red";
            return;
        }
        var selectedDate = new Date(inputDate);
        var currentDate = new Date();
        var tenYearsAgo = new Date(currentDate);
        tenYearsAgo.setFullYear(tenYearsAgo.getFullYear() - 5);

        var eightyYearsAgo = new Date(currentDate);
        eightyYearsAgo.setFullYear(eightyYearsAgo.getFullYear() - 17);

        if (selectedDate > tenYearsAgo && selectedDate > eightyYearsAgo) {
            Swal.fire({
                position: "top-center",
                icon: "warning",
                title: "No tiene la edad suficiente para el curso",
                showConfirmButton: false,
                timer: 2500
            });
            document.getElementById("birthdate").style.borderColor = "red"; // Cambiar el color del borde a rojo
        } else {
            // La fecha seleccionada es válida, cambiar el color del borde a verde
            document.getElementById("birthdate").style.borderColor = "green";
        }
    }

    function validateGender() {
        var selectedGender = document.getElementById("gender").value;
        if (selectedGender === "Selecciona el género") {
            document.getElementById("gender").style.borderColor = "red";
        } else {
            document.getElementById("gender").style.borderColor = "green";
        }
    }

    function validateRole() {
        var selectedRole = document.getElementById("role").value;
        if (selectedRole === "") {
            document.getElementById("role").style.borderColor = "red";
        } else {
            document.getElementById("role").style.borderColor = "green";
        }
    }


    function validateCity() {
        var inputCity = document.getElementById("city");
        var regex = /^[A-Z]+(\s[A-Z]+)*$/;
        var city = inputCity.value.toUpperCase();
        if (!regex.test(city)) {
            inputCity.style.borderColor = "red";
        } else {
            inputCity.style.borderColor = "green";
        }
        inputCity.value = city;
    }

    function validateAddress() {
        var inputAddress = document.getElementById("address");
        var regex = /^[A-Z0-9]+(\s+[A-Z0-9]+)*$/;
        var address = inputAddress.value.toUpperCase();
        if (!regex.test(address)) {
            inputAddress.style.borderColor = "red";
        } else {
            inputAddress.style.borderColor = "green";
        }
        inputAddress.value = address;
    }

    function validateNickname() {
        var inputNickname = document.getElementById("nickname");
        var regex = /^[a-z0-9]{5,15}$/;
        var nickname = inputNickname.value.toLowerCase();
        if (!regex.test(nickname)) {
            inputNickname.style.borderColor = "red";
        } else {
            inputNickname.style.borderColor = "green";
        }
        inputNickname.value = nickname;
    }

    function validateEmail() {
        var inputEmail = document.getElementById("email");
        var regex = /^[a-z0-9._%+-]+@(?:gmail|outlook|hotmail|yahoo|tsoftec|cdp|admin|teampichincha|live)\.(?:com|es|org)$/i;
        var email = inputEmail.value.toLowerCase();
        if (!regex.test(email)) {
            inputEmail.style.borderColor = "red";
        } else {
            inputEmail.style.borderColor = "green";
        }
        inputEmail.value = email;
    }

    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(`toggleView${inputId.charAt(0).toUpperCase() + inputId.slice(1)}`);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    function validatePassword() {
        const passwordInput = document.getElementById("password");
        const repeatPasswordInput = document.getElementById("repeat-password");
        var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,15}$/;
        var password = passwordInput.value.trim(); // Corregido de inputPassword a passwordInput
        var repeatPassword = repeatPasswordInput.value.trim(); // Asegura que se eliminen los espacios en blanco al inicio y al final

        // Validar que las contraseñas coincidan
        if (password === repeatPassword) {
            repeatPasswordInput.setCustomValidity("");
        } else {
            repeatPasswordInput.setCustomValidity("Las contraseñas no coinciden");
        }

        // Validar la contraseña principal
        if (!regex.test(password)) {
            passwordInput.style.borderColor = "red";
        } else {
            passwordInput.style.borderColor = "green";
        }

        // Validar la contraseña de repetición
        if (!regex.test(repeatPassword)) {
            repeatPasswordInput.style.borderColor = "red";
        } else {
            repeatPasswordInput.style.borderColor = "green";
        }
    }

    // Agregar la función para cambiar la visibilidad de la contraseña repetida
    function toggleRepeatPasswordVisibility() {
        const repeatPasswordInput = document.getElementById("repeat-password");
        const repeatPasswordIcon = document.getElementById("toggleViewRepeatPassword");

        if (repeatPasswordInput.type === 'password') {
            repeatPasswordInput.type = 'text';
            repeatPasswordIcon.classList.remove('fa-eye');
            repeatPasswordIcon.classList.add('fa-eye-slash');
        } else {
            repeatPasswordInput.type = 'password';
            repeatPasswordIcon.classList.remove('fa-eye-slash');
            repeatPasswordIcon.classList.add('fa-eye');
        }
    }

    // Llamar a la función validatePassword cuando se cambie el valor del campo repeat-password
    document.getElementById("repeat-password").addEventListener("input", validatePassword);





    function validateWhatsapp() {
        var input = document.getElementById("whatsapp");
        var regex = /^(?:\+[0-9]{1,3}(?:[ -]*[0-9])?|[0-9]{1,4})(?:[ -]*[0-9]){9,16}$/;
        var inputValue = input.value;
        if (regex.test(inputValue)) {
            input.style.borderColor = "green";
        } else {
            input.style.borderColor = "red";
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
</script>



<script>
    function validateForm() {
        var isValid = true;

        validateName();
        validateLastname();
        validateCredential();
        validateDate();
        validateGender();
        validateCity();
        validateAddress();
        validateNickname();
        validateEmail();
        validatePassword();
        validateWhatsapp();
        validateRole();
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }
        var submitButton = document.getElementById("submit-btn");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }
    // Llamar a la función validateForm() cada vez que cambie el valor de algún campo del formulario
    document.getElementById("formCreateUser").addEventListener("input", validateForm);
</script>



<script>
    // Función para validar y habilitar/deshabilitar el botón de envío para actualizar información
    function validateFormUpdateInfo() {
        var isValid = true;
        validateName();
        validateLastname();
        validateDate();
        validateGender();
        validateCity();
        validateAddress();
        validateWhatsapp();

        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }

        var submitButton = document.getElementById("submit-btn-update-info");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }

    // Función para validar y habilitar/deshabilitar el botón de envío para actualizar imagen
    function validateFormUpdateImage() {
        var isValid = true;
        fileImage();

        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }

        var submitButton = document.getElementById("submit-btn-update-image");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }

    // Función para validar y habilitar/deshabilitar el botón de envío para actualizar clave
    function validateFormUpdateKey() {
        var isValid = true;
        validatePassword();

        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }

        var submitButton = document.getElementById("submit-btn-update-key");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }

    // Escuchar el evento 'input' en los elementos de entrada relevantes y llamar a las funciones de validación correspondientes
    document.getElementById("formUpdateImage").addEventListener("input", validateFormUpdateImage);
    document.getElementById("formUpdateInformation").addEventListener("input", validateFormUpdateInfo);
    document.getElementById("formUpdateKey").addEventListener("input", validateFormUpdateKey);
</script>