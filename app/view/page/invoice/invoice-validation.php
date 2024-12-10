<script>
// FUNCION POR SEPARADO
function validateName() {
    var input = document.getElementById("name");
    var regex = /^[A-Z]+(\s[A-Z]+)*$/;
    var name = input.value.toUpperCase(); // Convertir el valor del campo a mayúsculas
    if (!regex.test(name)) {
        input.style.borderColor = "red";
        return false;
    } else {
        input.style.borderColor = "green";
        input.value = name;
        return true;
    }
}

function validateLastname() {
    var input = document.getElementById("lastname");
    var regex = /^[A-Z]+(\s[A-Z]+)*$/;
    var lastname = input.value.toUpperCase(); // Convertir el valor del campo a mayúsculas
    if (!regex.test(lastname)) {
        input.style.borderColor = "red";
        return false;
    } else {
        input.style.borderColor = "green";
        input.value = lastname;
        return true;
    }
}

function validateCredential() {
    var input = document.getElementById("ruc");
    var regex = /^\d{10,13}$/; // Expresión regular para validar que solo sean números y máximo 13 dígitos
    if (!regex.test(input.value)) {
        input.style.borderColor = "red";
        return false;
    } else {
        input.style.borderColor = "green";
        return true;
    }
}

function validateCanton() {
    var input = document.getElementById("canton");
    var regex = /.+/; // Expresión regular para validar que el campo no esté vacío
    var city = input.value.toUpperCase();
    if (!regex.test(city)) {
        input.style.borderColor = "red";
        return false;
    } else {
        input.style.borderColor = "green";
        input.value = city;
        return true;
    }
}

function validateEmail() {
    var input = document.getElementById("email");
    var regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
    var email = input.value.toLowerCase();
    if (!regex.test(email)) {
        input.style.borderColor = "red";
        return false;
    } else {
        input.style.borderColor = "green";
        input.value = email;
        return true;
    }
}

function validatePhone() {
    var input = document.getElementById("phone");
    var regex = /^(?:\+[0-9]{1,3}(?:[ -]*[0-9])?|[0-9]{1,4})(?:[ -]*[0-9]){9,16}$/;
    if (!regex.test(input.value)) {
        input.style.borderColor = "red";
        return false;
    } else {
        input.style.borderColor = "green";
        return true;
    }
}

function validateFormUpdate() {
    var isValid = true;
    isValid = validateName() && isValid;
    isValid = validateLastname() && isValid;
    isValid = validateCredential() && isValid;
    isValid = validateEmail() && isValid;
    isValid = validatePhone() && isValid;
    isValid = validateCanton() && isValid;

    var submitButton = document.getElementById("submit-invoice-data-update");
    if (isValid) {
        submitButton.removeAttribute("disabled");
    } else {
        submitButton.setAttribute("disabled", "disabled");
    }
}

document.getElementById("validationFormUpdate").addEventListener("input", validateFormUpdate);

function validateFormCreate() {
    var isValid = true;
    isValid = validateName() && isValid;
    isValid = validateLastname() && isValid;
    isValid = validateCredential() && isValid;
    isValid = validateEmail() && isValid;
    isValid = validatePhone() && isValid;
    isValid = validateCanton() && isValid;

    var submitButton = document.getElementById("submit-invoice-data-add");
    if (isValid) {
        submitButton.removeAttribute("disabled");
    } else {
        submitButton.setAttribute("disabled", "disabled");
    }
}

document.getElementById("validateFormCreate").addEventListener("input", validateFormCreate);



function validateFormPOSCreate() {
    var isValid = true;
    isValid = validateName() && isValid;
    isValid = validateLastname() && isValid;
    isValid = validateCredential() && isValid;
    isValid = validateEmail() && isValid;
    isValid = validatePhone() && isValid;
    isValid = validateCanton() && isValid;

    var submitButton = document.getElementById("submit-invoice-data-pos-add");
    if (isValid) {
        submitButton.removeAttribute("disabled");
    } else {
        submitButton.setAttribute("disabled", "disabled");
    }
}

document.getElementById("validateFormPOSCreate").addEventListener("input", validateFormPOSCreate);



</script>