<?php

$fecha = date('d-m-Y');

header('Content-Type: text/html; charset=utf-8');
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header('Content-Disposition: attachment; filename=Reporte-de-inscripcion-por-modulo-de-los-cursos-vacacionales-CDP-' . $fecha . '.xls');
header("Pragma: no-cache");
header("Expires: 0");

require_once "./../../../controller/pos.php";
require_once "./../../../model/pos.php";

$posController = new PosController();

if (isset($_GET['Mname']) && isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    $Mname = $_GET['Mname'];
    $data = $posController->moduleMyRegisterPOS($Mname);
    $dataM = $posController->moduleMyRegisterPOS($Mname, $userId);
    $dataUser = $posController->userPOS($userId);
    if (!empty($dataM) && is_array($dataM)) {
        $dataM = $dataM[0];
        $Modulo = $dataM['Mname'];
    }
}

?>

<img src="http://localhost/TSoftware-SGVC/assets/image/icons/logo-dorado.png" width="7%">
<h3><br> Reporte de inscripciones por <?php echo $Modulo ?> </h3>
<table border="1">
    <thead>
        <tr>
            <th>N.</th>
            <th>REFERENCE</th>
            <th>FECFAC</th>
            <th>CODCLI</th>
            <th>C COSTO</th>
            <th>CODART</th>
            <th>NOMART</th>
            <th>PORIVA</th>
            <th>CODIVA</th>
            <th>CANTID</th>
            <th>SUBTOTAL</th>
            <th>IVA</th>
            <th>TOTAL</th>
            <th>METODO DE PAGO</th>
            <th>COMPROBANTE</th>
            <th>OTRO COMPROBANTE</th>
            <th>FECHA DE PAGO</th>
            <th>OBSERV</th>
            <th>NOMCLI</th>
            <th>DIRCLI</th>
            <th>EMACLI</th>
            <th>TELCLI</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        $TotalInscription = 0;
        $SubTotal = 0;
        $Total = 0;
        $IVA = 0;
        $Amount = 0;
        $AmounTotal = 0;

        foreach ($data as $row) {
            $count = $count + 1;
            $Discount = $row['Dvalue'] * $row['CIprice'];
            $Total = $row['CIprice'] - $Discount;
            $SubTotal = ($Total/1.15);
            $IVA = $Total - $SubTotal;
            $Amount = $SubTotal + $IVA;
            $AmounTotal = $AmounTotal + $Amount;
        ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo 'TSE-CDP-CV-'.$row['Iid'].'-'.$row['Myear']; ?></td>
                <td><?php echo $row['IdateCreated']; ?></td>
                <td><?php echo  "&nbsp;"  .$row['IDruc']; ?></td>
                <td><?php echo $row['Scostos']; ?></td>
                <td> 90900001</td>
                <td><?php echo 'CURSO VACACIONAL 2024 DE '.$row['Sname'].' DEL '.$row['Mname']; ?></td>
                <td>15</td>
                <td>4</td>
                <td>1</td>
                <td><?php echo  number_format($SubTotal, 2); ?></td>
                <td><?php echo number_format($IVA, 2); ?></td>
                <td><?php echo number_format($Amount, 2); ?></td>
                <td><?php echo $row['PTname']; ?></td>
                <td><?php echo  "&nbsp;"  .$row['Ivoucher_number']; ?></td>
                <td><?php echo  "&nbsp;"  .$row['InewVoucherNumber']; ?></td>            
                <td><?php echo $row['Idate']; ?></td>
                <td><?php echo 'CURSO VACACIONAL 2024 DE '.$row['Sname'].' DEL '.$row['Mname'].' TOMANDO POR EL DEPORTISTA '.$row['Ulastname'].' ' .$row['Uname'].' CON CEDULA ' .$row['Ucredential']; ?></td>
                <td><?php echo $row['IDlastname']. ' ' .$row['IDname']; ?></td>
                <td><?php echo $row['IDcanton']; ?></td>
                <td><?php echo $row['IDemail']; ?></td>
                <td><?php echo  "&nbsp;"  .$row['IDphone']; ?></td>
            </tr>

        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="11">Valor total recaudado es: </th>
            <td><b>$ <?php echo $AmounTotal; ?></b></td>
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
                <center><?php echo 'Departamento Contable' ?><br>Recibe</center>
            </td>
            <td></td>
        <?php  } ?>
    </tr>
</table>
<?php

?>