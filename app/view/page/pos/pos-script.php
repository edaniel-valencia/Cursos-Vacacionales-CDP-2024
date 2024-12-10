
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        // $('.js-example-basic-single-1').select2();
    });

    function showSelectedValuesCourse() {
        var select = document.getElementById('sport');
        var selectedOption = select.options[select.selectedIndex];
        var selectedValuesDiv = document.getElementById('selectedValues');
        var selectedValuesDivT = document.getElementById('selectedValuesT');

        if (selectedOption.value !== '') {
            var cid = selectedOption.getAttribute('data-cid');
            var qhid = selectedOption.getAttribute('data-qhid');
            var sname = selectedOption.getAttribute('data-sname');
            var ename = selectedOption.getAttribute('data-ename');
            var qhstart = selectedOption.getAttribute('data-qhstart');
            var qhend = selectedOption.getAttribute('data-qhend');
            var ciprice = selectedOption.getAttribute('data-ciprice');
            var mname = selectedOption.getAttribute('data-mname');
            var mstart = selectedOption.getAttribute('data-mstart');
            var mend = selectedOption.getAttribute('data-mend');

            document.getElementById('selectedCid').textContent = cid;
            document.getElementById('selectedQHid').textContent = qhid;
            document.getElementById('selectedSname').textContent = sname;
            document.getElementById('selectedEname').textContent = ename;
            document.getElementById('selectedQHstart').textContent = qhstart;
            document.getElementById('selectedQHend').textContent = qhend;
            document.getElementById('selectedMname').textContent = mname;
            document.getElementById('selectedMstart').textContent = mstart;
            document.getElementById('selectedMend').textContent = mend;



            var cipriceT = selectedOption.getAttribute('data-ciprice');


            document.getElementById('selectedQHpriceT').textContent = cipriceT;

            // Muestra el contenedor con los detalles
            selectedValuesDiv.style.display = 'block';

            selectedValuesDivT.style.display = 'block';
        } else {
            // Oculta el contenedor si no hay opción seleccionada
            selectedValuesDiv.style.display = 'none';

            selectedValuesDivT.style.display = 'none';
        }
    }

    function showSelectedValuesUser() {
        var select = document.getElementById('users');
        var selectedOption = select.options[select.selectedIndex];
        var selectedValuesUser = document.getElementById('selectedValuesUser');

        if (selectedOption.value !== '') {
            var uid = selectedOption.getAttribute('data-uid');
            var uname = selectedOption.getAttribute('data-uname');
            var ulastname = selectedOption.getAttribute('data-ulastname');
            var ucredential = selectedOption.getAttribute('data-ucredential');
            var uemail = selectedOption.getAttribute('data-uemail');
            var ubirthdate = selectedOption.getAttribute('data-ubirthdate');
            var ugender = selectedOption.getAttribute('data-ugender');

            document.getElementById('selectedUid').textContent = uid;
            document.getElementById('selectedUname').textContent = uname;
            document.getElementById('selectedUlastname').textContent = ulastname;
            document.getElementById('selectedUcredential').textContent = ucredential;
            document.getElementById('selectedUemail').textContent = uemail;
            document.getElementById('selectedUbirthdate').textContent = ubirthdate;
            document.getElementById('selectedUgender').textContent = ugender;

            selectedValuesUser.style.display = 'block';
        } else {
            selectedValuesUser.style.display = 'none';
        }
    }

    function showSelectedValuesDiscount() {
        var select = document.getElementById('discount');
        var selectedOption = select.options[select.selectedIndex];
        var selectedValuesDiscount = document.getElementById('selectedValuesDiscount');
        var selectedValuesDiscountP = document.getElementById('selectedValuesDiscountP');

        if (selectedOption.value !== '') {
            var did = selectedOption.getAttribute('data-did');
            var dpercentage = selectedOption.getAttribute('data-dpercentage');
            var ddescription = selectedOption.getAttribute('data-ddescription');

            document.getElementById('selectedDid').textContent = did;
            document.getElementById('selectedDpercentage').textContent = dpercentage;
            document.getElementById('selectedDdescription').textContent = ddescription;

            var dpercentageP = selectedOption.getAttribute('data-dpercentage');

            document.getElementById('selectedDpercentageP').textContent = dpercentageP;

            selectedValuesDiscount.style.display = 'block';
            selectedValuesDiscountP.style.display = 'block';
        } else {
            selectedValuesDiscount.style.display = 'none';
            selectedValuesDiscountP.style.display = 'none';
        }
    }
</script>