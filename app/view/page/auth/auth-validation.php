
<script>
    function validateFormUpdateImagen() {
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














    // REGISTER

   function validateName() {
    var inputName = document.getElementById("Uname");
    var name = inputName.value.toUpperCase(); 
    inputName.value = name;

    var regex = /^[A-Z]+(\s[A-Z]+)*$/;

    if (!regex.test(name)) {
        inputName.style.borderColor = "red";
        return false;
    } else {
        inputName.style.borderColor = "blue";
        return true;
    }
}

function validateLastname() {
    var inputName = document.getElementById("Ulastname");
    var name = inputName.value.toUpperCase(); 
    inputName.value = name;

    var regex = /^[A-Z]+(\s[A-Z]+)*$/;

    if (!regex.test(name)) {
        inputName.style.borderColor = "red";
        return false;
    } else {
        inputName.style.borderColor = "blue";
        return true;
    }
}

function validateCredential() {
    var inputLastname = document.getElementById("Ucredential");
    var regex = /^\d{10}$/; // Ajuste aquí para 10 dígitos
    if (!regex.test(inputLastname.value)) {
        inputLastname.style.borderColor = "red";
        return false;
    } else {
        inputLastname.style.borderColor = "blue";
        return true;
    }
}

function validateGender() {
    var selectedGender = document.getElementById("Ugender").value;
    if (selectedGender === "" || selectedGender === "Selecciona el género") {
        document.getElementById("Ugender").style.borderColor = "red";
        return false;
    } else {
        document.getElementById("Ugender").style.borderColor = "blue";
        return true;
    }
}

function validateWhatsapp() {
    var input = document.getElementById("Uwhatsapp");
    var regex = /^09[0-9]{8}$/;
    var inputValue = input.value.replace(/\D/g, '');

    if (regex.test(inputValue)) {
        input.style.borderColor = "blue";
        return true;
    } else {
        input.style.borderColor = "red";
        return false;
    }
}

function validateUEmail() {
    var inputEmail = document.getElementById("Uemail");
    var regex = /^[a-z0-9._%+-]+@(?:gmail|outlook|admin|hotmail|yahoo|live|tsoftec|teampichincha|cdp)\.(?:com|es|org)$/i;
    var email = inputEmail.value.toLowerCase();
    if (!regex.test(email)) {
        inputEmail.style.borderColor = "red";
        return false;
    } else {
        inputEmail.style.borderColor = "blue";
        return true;
    }
}

function validatePasswordRegister() {
    const passwordInput = document.getElementById("Upassword");
    const passwordMessage = document.getElementById("passwordMessage");
    var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*.])[A-Za-z\d!@#$%^&*.]{8,15}$/;
    var password = passwordInput.value.trim();

    if (!regex.test(password)) {
        passwordInput.style.borderColor = "red";
        passwordMessage.innerText = "La contraseña debe contener al menos una mayúscula, una minúscula, un número, un carácter especial y tener entre 6 y 15 caracteres.";
        return false;
    } else {
        passwordInput.style.borderColor = "blue";
        passwordMessage.innerText = "";
        return true;
    }
}

function validatePasswordRepetiRegister() {
    const passwordInput = document.getElementById("Upassword");
    const repeatPasswordInput = document.getElementById("Rpassword");
    const passwordMessageR = document.getElementById("passwordMessageR");

    if (passwordInput.value !== repeatPasswordInput.value) {
        passwordInput.style.borderColor = "red";
        repeatPasswordInput.style.borderColor = "red";
        passwordMessageR.innerText = "Las contraseñas no coinciden.";
        return false;
    } else {
        passwordInput.style.borderColor = "blue";
        repeatPasswordInput.style.borderColor = "blue";
        passwordMessageR.innerText = "";
        return true;
    }
}

function validateUbirthdate() {
    var inputDate = document.getElementById("Ubirthdate").value.trim();
    if (inputDate === "") {
        document.getElementById("Ubirthdate").style.borderColor = "red";
        return false;
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
            title: "No tienes la edad para ser parte de los cursos vacacionales",
            showConfirmButton: false,
            timer: 2500
        });
        document.getElementById("Ubirthdate").style.borderColor = "red";
        return false;
    } else {
        document.getElementById("Ubirthdate").style.borderColor = "blue";
        return true;
    }
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

function validateFormRegister() {
    var isNameValid = validateName();
    var isLastNameValid = validateLastname();
    var isCredentialValid = validateCredential();
    var isDateValid = validateUbirthdate();
    var isGenderValid = validateGender();
    var isWhatsappValid = validateWhatsapp();
    var isEmailValid = validateUEmail();
    var isPasswordValid = validatePasswordRegister();

    var submitButton = document.getElementById("submit_activo");

    if (isNameValid && isLastNameValid && isCredentialValid && isDateValid && isGenderValid && isWhatsappValid && isEmailValid && isPasswordValid) {
        submitButton.removeAttribute("disabled");
        console.log("El formulario es válido y se puede enviar.");
    } else {
        submitButton.setAttribute("disabled", "disabled");
        console.log("El formulario no es válido y no se puede enviar.");
    }
}

document.getElementById("loginFormRegisters").addEventListener("input", validateFormRegister);
















    // LOGIN


    function validateEmail() {
        var inputEmail = document.getElementById("email");
        var regex = /^[a-z0-9._%+-]+@(?:gmail|outlook|admin|hotmail|yahoo|live|tsoftec|teampichincha|cdp|1004|tse)\.(?:com|es|org)$/i;
        var email = inputEmail.value.toLowerCase();
        if (!regex.test(email)) {
            inputEmail.style.borderColor = "red";
            return false;
        } else {
            inputEmail.style.borderColor = "green";
            return true;
        }
    }

    function validatePasswordLogin() {
        var inputPassword = document.getElementById("password");
        var password = inputPassword.value;
        var strength = document.getElementById("passwordStrength");
        var regexUpperCase = /[A-Z]/;
        var regexLowerCase = /[a-z]/;
        var regexNumber = /[0-9]/;
        var regexSpecialChar = /[^A-Za-z0-9]/;

        var lengthMsg = "";
        var upperCaseMsg = "";
        var lowerCaseMsg = "";
        var numberMsg = "";
        var specialCharMsg = "";

        if (!regexUpperCase.test(password)) {
            upperCaseMsg = "La contraseña debe contener al menos una letra mayúscula.";
        }
        if (!regexLowerCase.test(password)) {
            lowerCaseMsg = "La contraseña debe contener al menos una letra minúscula.";
        }
        if (!regexNumber.test(password)) {
            numberMsg = "La contraseña debecontener al menos un número.";
        }
        if (!regexSpecialChar.test(password)) {
            specialCharMsg = "La contraseña debe contener al menos un carácter especial.";
        }
        if (password.length < 8 || password.length > 20) {
            lengthMsg = "La contraseña debe tener entre 8 y 20 caracteres.";
        }

        var isValid = (password.length >= 8 && password.length <= 20 &&
            regexUpperCase.test(password) &&
            regexLowerCase.test(password) &&
            regexNumber.test(password) &&
            regexSpecialChar.test(password));

        if (isValid) {
            inputPassword.style.borderColor = "green";
            return true;
        } else {
            inputPassword.style.borderColor = "red";
            return false;
        }
    }

    function validateForm() {
        var isEmailValid = validateEmail();
        var isPasswordValid = validatePasswordLogin();
        var submitButton = document.getElementById("submit-auth-signin");

        if (isEmailValid && isPasswordValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }


    document.getElementById("loginFormLogin").addEventListener("input", validateForm);
</script>





<!-- RESET PASSWORD -->


<script>
    


    // LOGIN


    function validateEmail() {
        var inputEmail = document.getElementById("email");
        var regex = /^[a-z0-9._%+-]+@(?:gmail|outlook|admin|hotmail|yahoo|live|tsoftec|teampichincha|cdp|1004|tse)\.(?:com|es|org)$/i;
        var email = inputEmail.value.toLowerCase();
        if (!regex.test(email)) {
            inputEmail.style.borderColor = "red";
            return false;
        } else {
            inputEmail.style.borderColor = "green";
            return true;
        }
    }   

    function validateFormReset() {
        var isEmailValid = validateEmail();
        var submitButton = document.getElementById("auth-validation-email");

        if (isEmailValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }


    document.getElementById("validateFormReset").addEventListener("input", validateFormReset);



    
function validatePasswordLockScreen() {
    const passwordInput = document.getElementById("password");
    const passwordMessage = document.getElementById("passwordMessage");
    var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,15}$/;
    var password = passwordInput.value.trim();

    if (!regex.test(password)) {
        passwordInput.style.borderColor = "red";
        passwordMessage.innerText = "La contraseña debe contener al menos una mayúscula, una minúscula, un número, un carácter especial y tener entre 8 y 15 caracteres.";
        return false;
    } else {
        passwordInput.style.borderColor = "blue";
        passwordMessage.innerText = "";
        return true;
    }
}


    function validateFormLockScreen() {
        var isPasswordValid = validatePasswordLockScreen();
        var submitButton = document.getElementById("auth-lock-screen");

        if (isPasswordValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }


    document.getElementById("validateFormLockScreen").addEventListener("input", validateFormLockScreen);
</script>


</script>


<!-- <script>
    function validateEmail() {
        var inputEmail = document.getElementById("email");
        var regex = /^[a-z0-9._%+-]+@(?:gmail|outlook|admin|hotmail|yahoo|tsoftec|teampichincha|cdp)\.(?:com|es|org)$/i;
        var email = inputEmail.value.toLowerCase();
        if (!regex.test(email)) {
            inputEmail.style.borderColor = "red";
            return false;
        } else {
            inputEmail.style.borderColor = "green";
            return true;
        }
    }

    function validatePasswordLogin() {
        var inputPassword = document.getElementById("password");
        var password = inputPassword.value;
        var strength = document.getElementById("passwordStrength");
        var regexUpperCase = /[A-Z]/;
        var regexLowerCase = /[a-z]/;
        var regexNumber = /[0-9]/;
        var regexSpecialChar = /[^A-Za-z0-9]/;

        var lengthMsg = "";
        var upperCaseMsg = "";
        var lowerCaseMsg = "";
        var numberMsg = "";
        var specialCharMsg = "";

        if (!regexUpperCase.test(password)) {
            upperCaseMsg = "La contraseña debe contener al menos una letra mayúscula.";
        }
        if (!regexLowerCase.test(password)) {
            lowerCaseMsg = "La contraseña debe contener al menos una letra minúscula.";
        }
        if (!regexNumber.test(password)) {
            numberMsg = "La contraseña debecontener al menos un número.";
        }
        if (!regexSpecialChar.test(password)) {
            specialCharMsg = "La contraseña debe contener al menos un carácter especial.";
        }
        if (password.length < 8 || password.length > 20) {
            lengthMsg = "La contraseña debe tener entre 8 y 20 caracteres.";
        }

        var isValid = (password.length >= 8 && password.length <= 20 &&
            regexUpperCase.test(password) &&
            regexLowerCase.test(password) &&
            regexNumber.test(password) &&
            regexSpecialChar.test(password));

        if (isValid) {
            inputPassword.style.borderColor = "green";
            return true;
        } else {
            inputPassword.style.borderColor = "red";
            return false;
        }
    }

    function validateForm() {
        var isEmailValid = validateEmail();
        var isPasswordValid = validatePasswordLogin();
        var submitButton = document.getElementById("submit-auth-signin");

        if (isEmailValid && isPasswordValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }

    document.getElementById("loginFormLogin").addEventListener("input", validateForm);
</script> -->