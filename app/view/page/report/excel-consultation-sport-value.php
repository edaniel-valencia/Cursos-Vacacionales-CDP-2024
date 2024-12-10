<?php

header('Content-Type: text/html; charset=utf-8');
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header('Content-Disposition: attachment; filename=Reporte-de-inscripcion-por-deporte-de-los-cursos-vacacionales-CDP.xls');
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
            <th>DEPORTISTA</th>
            <th>CEDULA</th>
            <th>DEPORTE</th>
            <th>HORARIO</th>
            <th>PRECIO</th>
            <th>DESCUENTO</th>
            <th>VALOR PAGADO</th>
            <th>METODO DE PAGO</th>
            <th>BANCO</th>
            <th>NUMERO DE VOUCHER</th>
            <th>FECHA DE PAGO</th>
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
        ?>
            <tr>
                <td><?php echo 'TSE-CDP-CV-' . $row['Iid'] . '-2024'; ?></td>
                <td><?php echo $row['Uname'] . ' ' . $row['Ulastname']; ?></td>
                <td><?php echo $row['Ucredential']; ?></td>
                <td><?php echo $row['Sname']; ?></td>
                <td><?php echo $row['QHstart'] . ' - ' . $row['QHend']; ?></td>
                <td><?php echo  number_format($row['CIprice'], 2); ?></td>
                <td><?php echo number_format($Discount, 2); ?></td>
                <td><?php echo number_format($Total, 2); ?></td>
                <td><?php echo $row['PTname']; ?></td>
                <td><?php echo $row['Ibanco']; ?></td>
                <td><?php echo $row['Ivoucher_number']; ?></td>
                <td><?php echo $row['Idate']; ?></td>
                <td><?php echo $row['PSname']; ?></td>
            </tr>

        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="7">Valor total recaudado es: </th>
            <td><b>$ <?php echo $TotalInscription; ?></b></td>
            <td></td>
            <td></td>
        </tr>
    </tfoot>
</table>
<br><br>
<br><br>

<?php
echo 'Reporte descargado desde el <a href="https://vacacionales.teampichincha.com">Sistema de Cursos vacacionales CDP 2024</a> - <a href="https://tsoftec.com">TSoftware Ecuador</a>';
?>
