<script>
    // FUNCION POR SEPARADO
    function validateName() {
        var inputName = document.getElementById("name");
        var regex = /^[A-Z]+(\s[A-Z]+)*$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
            return false;

        } else {
            inputName.style.borderColor = "green";
            return true;

        }
        inputName.value = name;
    }

    function validateLastname() {
        var inputName = document.getElementById("lastname");
        var regex = /^[A-Z]+(\s[A-Z]+)*$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
            return false;
        } else {
            inputName.style.borderColor = "green";
            return true;
        }
        inputName.value = name;
    }

    function validateCredential() {
        var inputLastname = document.getElementById("credentity");
        var regex = /^\d{10,13}$/;
        if (!regex.test(inputLastname.value)) {
            inputLastname.style.borderColor = "red";
            return false;
        } else {
            inputLastname.style.borderColor = "green";
            return true;

        }
    }

    function validateDate() {
        var inputDate = document.getElementById("birthdate").value.trim(); // Obtener el valor y eliminar espacios en blanco al inicio y al final
        if (inputDate === "") {
            document.getElementById("birthdate").style.borderColor = "red";
            return false;
        }
        var selectedDate = new Date(inputDate);
        var currentDate = new Date();
        var tenYearsAgo = new Date(currentDate);
        tenYearsAgo.setFullYear(tenYearsAgo.getFullYear() - 4);

        var eightyYearsAgo = new Date(currentDate);
        eightyYearsAgo.setFullYear(eightyYearsAgo.getFullYear() - 80);

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
            return true;

        }
    }

    function validateGender() {
        var selectedGender = document.getElementById("gender").value;
        if (selectedGender === "Género") {
            document.getElementById("gender").style.borderColor = "red";
            return false;
        } else {
            document.getElementById("gender").style.borderColor = "green";
            return true;

        }
    }

    function validateCity() {
        var selectedCity = document.getElementById("city").value;
        if (selectedCity === "") {
            document.getElementById("city").style.borderColor = "red";
            return false;
        } else {
            document.getElementById("city").style.borderColor = "green";
            return true;

        }
    }

    function validateBlood() {
        var selectedBlood = document.getElementById("blood").value;
        if (selectedBlood === "") {
            document.getElementById("blood").style.borderColor = "red";
            return false;
        } else {
            document.getElementById("blood").style.borderColor = "green";
            return true;

        }
    }

    function validateSize() {
        var selectedSize = document.getElementById("size").value;
        if (selectedSize === "") {
            document.getElementById("size").style.borderColor = "red";
            return false;
        } else {
            document.getElementById("size").style.borderColor = "green";
            return true;

        }
    }

    function validateAddress() {
        var inputAddress = document.getElementById("address");
        var regex = /^[A-Z0-9]+(\s+[A-Z0-9]+)*$/;
        var address = inputAddress.value.toUpperCase();
        if (!regex.test(address)) {
            inputAddress.style.borderColor = "red";
            return false;
        } else {
            inputAddress.style.borderColor = "green";
            return true;

        }
        inputAddress.value = address;
    }

    function validateEmail() {
        var inputEmail = document.getElementById("email");
        var regex = /^[a-z0-9._%+-]+@(?:gmail|outlook|hotmail|yahoo|tsoftec|cdp|admin)\.(?:com|es|org)$/i;
        var email = inputEmail.value.toLowerCase();
        if (!regex.test(email)) {
            inputEmail.style.borderColor = "red";
            return false;
        } else {
            inputEmail.style.borderColor = "green";
            return true;

        }
        inputEmail.value = email;
    }

    function validatePassword() {
        const passwordInput = document.getElementById("password");
        const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,15}$/;
        const password = passwordInput.value.trim();

        if (!regex.test(password)) {
            passwordInput.style.borderColor = "red";
            return false;
        } else {
            passwordInput.style.borderColor = "green";
            return true;

        }
    }

    function validateWhatsapp() {
        var input = document.getElementById("whatsapp");
        var regex = /^(?:\+[0-9]{1,3}(?:[ -]*[0-9])?|[0-9]{1,4})(?:[ -]*[0-9]){9,16}$/;
        var inputValue = input.value;
        if (regex.test(inputValue)) {
            input.style.borderColor = "green";
            return true;
        } else {
            input.style.borderColor = "red";
            return false;

        }
    }

    function validatePasswordRegister() {
        const passwordInput = document.getElementById("Upassword");
        const passwordMessage = document.getElementById("passwordMessage");
        var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,15}$/;
        var password = passwordInput.value.trim();

        if (!regex.test(password)) {
            passwordInput.style.borderColor = "red";
            passwordMessage.innerText = "La contraseña debe contener al menos una mayúscula, una minúscula, un número, un carácter especial y tener entre 6 y 15 caracteres.";
            return false;
        } else {
            passwordInput.style.borderColor = "green";
            passwordMessage.innerText = "";
            return true;

        }
        return regex.test(password);
    }

    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(`toggleView${inputId.charAt(0).toUpperCase() + inputId.slice(1)}`);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
            icon.style.color = 'teal';
            icon.parentElement.style.border = 'none';
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
            icon.style.color = 'black';
            icon.parentElement.style.border = 'none';
        }
    }

    function validateFormPOS() {
        var isValid = true;

        validateName();
        validateLastname();
        validateCredential();
        validateWhatsapp();
        validateDate();
        validateGender();
        validateCity();
        validateAddress();
        validateSize();
        validateBlood();
        validateEmail();
        //  validatePasswordRegister();

        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }

        var submitButton = document.getElementById("submit-create-user-pos");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }

    document.getElementById("formCreateUserPOS").addEventListener("input", validateFormPOS);
</script>