<?php

header('Content-Type: text/html; charset=utf-8');
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header('Content-Disposition: attachment; filename=Reporte-de-inscripcion-por-modulo-y-deportes-en-los-cursos-vacacionales-CDP.xls');
header("Pragma: no-cache");
header("Expires: 0");

require_once "./../../../controller/consultation.php";
require_once "./../../../model/consultation.php";

$consultationController = new ConsultationController();

if (isset($_GET['sportId'])) {

    $sport = $_GET['sportId'];

    $data = $consultationController->SRegisterConsultation($sport);
    $dataM = $consultationController->SRegisterConsultation($sport);

    if (!empty($dataM) && is_array($dataM)) {
        $dataM = $dataM[0];
        $Sport = $dataM['Sname'];
        $Year = $dataM['Myear'];
    }
}




?>

<img src="https://teampichincha.com/wp-content/uploads/2024/06/Logo-escudo-dorado-H-1-400x225.png" alt="" width="12%">
<h3><br> Reporte de inscripciones por <?php echo $Sport ?> de los cursos vacacionales <?php echo $Year?></h3>
<table border="1">
    <thead>
        <tr>
            <th>REFERENCIA</th>
            <th>APELLIDOS</th>
            <th>NOMBRES</th>
            <th>CEDULA</th>
            <th>EDAD</th>
            <!-- <th>A&Ntilde;O</th> -->
            <th>TALLA</th>
            <th>TIPO DE SANGRE</th>
            <th>MODULO</th>            
            <th>ESTADO</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        $TotalInscription = 0;
        foreach ($data as $row) {
            $count = $count + 1;
            $Discount = $row['Dvalue'] * $row['CIprice'];
            $Total = $row['CIprice'] - $Discount;
            $TotalInscription = $TotalInscription + $Total;

            // SACAR LA EDAD DEL DEPORTISTA
            $birthdate = $row['Ubirthdate'];
            $birthDateObj = new DateTime($birthdate);
            $currentDateObj = new DateTime();
            $ageInterval = $currentDateObj->diff($birthDateObj);
            $age = $ageInterval->y;
        ?>
            <tr>
                <td><?php echo 'TSE-CDP-CV-' . $row['Iid'] . '-2024'; ?></td>
                <td><?php echo $row['Ulastname'] ; ?></td>
                <td><?php echo $row['Uname']; ?></td>
                <td><?php echo $row['Ucredential']; ?></td>
                <td><?php echo $age; ?></td>
                <td><?php echo $row['Usize']; ?></td>
                <td><?php echo $row['Ublood']; ?></td>
                <td><?php echo $row['Mname']; ?></td>
                <td><?php echo $row['PSname']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<br><br>
<br><br>

<?php
echo 'Reporte descargado desde el <a href="https://vacacionales.teampichincha.com">Sistema de Cursos vacacionales CDP 2024</a> - <a href="https://tsoftec.com">TSoftware Ecuador</a>';
?>