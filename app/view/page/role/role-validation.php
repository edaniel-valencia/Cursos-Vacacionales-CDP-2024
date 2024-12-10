<script>
    function validateFormCreateRole() {
        var isValid = true;
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }
        var submitButton = document.getElementById("submit-role-add");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }

    // document.addEventListener("input", validateForm);

    function validateNameCreateRole() {
        var inputName = document.getElementById("name");
        var regex = /^[A-Z]+(\s[A-Z]+)*$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }



    function validateFormUpdateRole() {
        var isValid = true;
        validateNameUpdateRole();
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }
        var submitButton = document.getElementById("submit-btn-update");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }

    // document.addEventListener("input", validateForm);

    function validateNameUpdateRole() {
        var inputName = document.getElementById("Uname");
        var regex = /^[A-Z]+(\s[A-Z]+)*$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }
</script>