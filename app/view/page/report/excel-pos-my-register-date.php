<?php

$fecha = date('d-m-Y');
require_once "./../../../controller/pos.php";
require_once "./../../../model/pos.php";

$posController = new PosController();

if (isset($_GET['Dstart']) && isset($_GET['Dend']) && isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    $Dstart = $_GET['Dstart'];
    $Dend = $_GET['Dend'];
    $data = $posController->dateStartEndMyRegisterPOS($Dstart, $Dend, $userId);
    $dataUser = $posController->userPOS($userId);
}

header('Content-Type: text/html; charset=utf-8');
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header('Content-Disposition: attachment; filename=Reporte-de-inscripcion-diaria-cursos-vacacionales-CDP-' . $Dstart . '.xls');
header("Pragma: no-cache");
header("Expires: 0");

$dateStart = new DateTime($Dstart);
$dateStart = $dateStart->format('d-m-Y');
$dateEnd = new DateTime($Dend);
$dateEnd = $dateEnd->format('d-m-Y');


?>

<img src="https://teampichincha.com/wp-content/uploads/2024/06/Logo-escudo-dorado-H-1-400x225.png" alt="" width="15%"> <br><br><br><br>
<?php
if ($fecha === $dateStart &&  $fecha === $dateEnd) {
    echo "<h3>Reporte de inscripciones de  $dateStart </h3>";
} else {
    echo "<h3>Reporte de inscripciones de  $dateStart a $dateEnd </h3>";
}

?>

<table border="1">
    <thead>
        <tr>
            <th>REFERENCIA</th>
            <th>DEPORTISTA</th>
            <th>CEDULA</th>
            <th>MODULO</th>
            <th>DEPORTE</th>
            <th>HORARIO</th>
            <th>PRECIO</th>
            <th>DESCUENTO</th>
            <th>VALOR PAGADO</th>
            <th>METODO DE PAGO</th>
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
                <td><?php echo $row['Mname']; ?></td>
                <td><?php echo $row['Ucredential']; ?></td>
                <td><?php echo $row['Sname']; ?></td>
                <td><?php echo $row['QHstart'] . ' - ' . $row['QHend']; ?></td>
                <td><?php echo  number_format($row['CIprice'], 2); ?></td>
                <td><?php echo number_format($Discount, 2); ?></td>
                <td><?php echo number_format($Total, 2); ?></td>
                <td><?php echo $row['PTname']; ?></td>
                <td><?php echo $row['PSname']; ?></td>
            </tr>

        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="8">Valor total recaudado es: </th>
            <td><b>$ <?php echo $TotalInscription; ?></b></td>
            <td></td>
            <td></td>
        </tr>
    </tfoot>
</table>
<br><br>
<br><br>
<table>
    <tr>
        <td></td>
        <th colspan="3">________________________________________ </th>
        <td></td>
        <th colspan="3">________________________________________ </th>
        <td></td>
    </tr>
    <tr>
        <?php foreach ($dataUser as $Urow) { ?>
            <td></td>
            <td colspan="3">
                <center><?php echo $Urow['Uname'] . ' ' . $Urow['Ulastname'] ?><br>Entrega</center>
            </td>
            <td></td>
            <td colspan="3">
                <center><?php echo utf8_decode('Departamento Contable') ?><br>Recibe</center>
            </td>
            <td></td>
        <?php  } ?>
    </tr>
</table>
<?php

?>