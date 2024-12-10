<?php

header('Content-Type: text/html; charset=utf-8');
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header('Content-Disposition: attachment; filename=Reporte-de-inscripcion-por-modulo-de-los-cursos-vacacionales-CDP-para-el-seguro.xls');
header("Pragma: no-cache");
header("Expires: 0");

require_once "./../../../controller/consultation.php";
require_once "./../../../model/consultation.php";

$consultationController = new ConsultationController();

if (isset($_GET['moduleId'])) {

    $module = $_GET['moduleId'];

    $data = $consultationController->MRegisterConsultationS($module);
    $dataM = $consultationController->MRegisterConsultationS($module);

    if (!empty($dataM) && is_array($dataM)) {
        $dataM = $dataM[0];
        $Modulo = $dataM['Mname'];
        $Year = $dataM['Myear'];
    }
}




?>

<img src="https://teampichincha.com/wp-content/uploads/2024/06/Logo-escudo-dorado-H-1-400x225.png" alt="" width="12%">
<h3><br> Reporte de inscripciones del <?php echo $Modulo ?> de los cursos vacacionales <?php echo $Year ?></h3>
<table border="1">
    <thead>
        <tr>
            <th>REFERENCIA</th>
            <th>NOMBRES COMPLETOS</th>
            <th>CEDULA</th>
            <th>FECHA DE NACIMIENTO</th>

        </tr>
    </thead>
    <tbody>
        <?php
     
        foreach ($data as $row) {
           

            // SACAR LA EDAD DEL DEPORTISTA
            $birthdate = $row['Ubirthdate'];
            $birthDateObj = new DateTime($birthdate);
            $currentDateObj = new DateTime();
            $ageInterval = $currentDateObj->diff($birthDateObj);
            $age = $ageInterval->y;
        ?>
            <tr>
                <td><?php echo 'TSE-CDP-CV-' . $row['Iid'] . '-2024'; ?></td>
                <td><?php echo $row['Ulastname'] . ' ' . $row['Uname']; ?></td>
                <td><?php echo $row['Ucredential']; ?></td>
                <td><?php echo $row['Ubirthdate']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<br><br>
