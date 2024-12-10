<script>
    function validateFormCreate() {
        var isValid = true;
        validatePercentage();
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }
        var submitButton = document.getElementById("submit-discount-add");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }

    document.getElementById("formCreate").addEventListener("input", validateFormCreate);


    function validatePercentage() {
        var inputName = document.getElementById("percentage");
        var regex = /^[0-9]+$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }

    function validateFormUpdatediscount() {
        var isValid = true;
        validateNameUpdate();
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].style.borderColor === "red") {
                isValid = false;
                break;
            }
        }
        var submitButton = document.getElementById("submit-discount-update");
        if (isValid) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "disabled");
        }
    }

    function validateNameUpdate() {
        var inputName = document.getElementById("name");
        var regex = /^[0-9]+$/;
        var name = inputName.value.toUpperCase();
        if (!regex.test(name)) {
            inputName.style.borderColor = "red";
        } else {
            inputName.style.borderColor = "green";
        }
        inputName.value = name;
    }
</script>