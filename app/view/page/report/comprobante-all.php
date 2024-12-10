<?php
require('./../../../fpdf/fpdf.php');
require "./../../../controller/invoices.php";
require_once "./../../../model/invoices.php";
// $key = 'mysecretkey12345'; // Debe ser de una longitud adecuada según el método de cifrado
// $method = 'aes-256-cbc';

// // Generar un IV (vector de inicialización) para el cifrado
// $iv_length = openssl_cipher_iv_length($method);
// $iv = openssl_random_pseudo_bytes($iv_length);

if (isset($_GET["invoiceId"])) {

    $invoiceId =  $_GET["invoiceId"];
    // $ciphertext_base64 =  $_GET["invoiceId"];
    // $ciphertext_decoded = base64_decode($ciphertext_base64);
    // $iv_decoded = substr($ciphertext_decoded, 0, $iv_length);
    // $ciphertext_decoded = substr($ciphertext_decoded, $iv_length);
    // $invoiceId = openssl_decrypt($ciphertext_decoded, $method, $key, 0, $iv_decoded);

    // $invoiceIdEncrypt = $_GET["invoiceId"];
    $invoiceController = new InvoiceController();;

    $data = $invoiceController->getMyCourseOnlineById($invoiceId);



    $fechaNacimientoObj = new DateTime($data['Ubirthdate']);
    $fechaActualObj = new DateTime('now');
    $diferencia = $fechaActualObj->diff($fechaNacimientoObj);
    $Ubithdate = $diferencia->y;

    $image =        './../../../../assets/image/system/sport/' . $data["Simage"];
    $imageVoucher = './../../../../assets/image/system/voucher/' . $data["Ivoucher"];

    $Mname          = $data['Mname'];
    $Myear          = $data['Myear'];

    $IDname         = $data['IDname'];
    $IDlastname     = $data['IDlastname'];
    $IDruc          = $data['IDruc'];
    $IDcanton       = $data['IDcanton'];
    $IDphone        = $data['IDphone'];
    $IDemail        = $data['IDemail'];

    $Uname          = $data['Uname'];
    $Ulastname      = $data['Ulastname'];
    $Uwhatsapp    = $data['Uwhatsapp'];
    $Uemail     = $data['Uemail'];
    $Ucredential    = $data['Ucredential'];
    $Usize    = $data['Usize'];
    $Ugender    = $data['Ugender'];
    $Ublood    = $data['Ublood'];
    $Uaddress    = $data['Uaddress'];

    $Sname    = $data['Sname'];
    $PSname    = $data['PSname'];

    $Ename    = $data['Ename'];

    $QHday    = $data['QHday'];
    $QHstart    = $data['QHstart'];
    $QHend    = $data['QHend'];

    $CIprice    = $data['CIprice'];
    $Dpercentage    = $data['Dpercentage'];
    $Ddescription   = $data['Ddescription'];
    $Total = $CIprice - ($CIprice * ($Dpercentage / 100));
    $TotalWithDecimal = number_format($Total, 2, ',', '.');

    $PSid    = $data['PSid'];
    $KDid    = $data['KDid'];
    $Uaddress    = $data['Uaddress'];
    $Uaddress    = $data['Uaddress'];
    $Kname    = $data['Kname'];
    $Did    = $data['Did'];
}



$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetMargins(17, 17, 17);
$pdf->AddPage();

# Logo de la empresa formato png #
$pdf->Image("$image", 163, 10, 30, 30);

# Encabezado y datos de la empresa #
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(32, 100, 210);
$pdf->Image('./../../../../assets/image/report/logo-dorado-h.png', 15, 10, 45, 25, 'PNG');

$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 17);
$pdf->SetTextColor(39, 39, 51);
$pdf->MultiCell(0, 7, mb_convert_encoding("CURSOS VACACIONALES", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
$pdf->SetFont('Arial', 'B', 15);
$pdf->MultiCell(0, 5, mb_convert_encoding("$Mname", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 8, mb_convert_encoding("TSE-CDP-CV-$invoiceId-2024", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);

$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(17, 7, mb_convert_encoding("Datos de la factura", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(25, 7, mb_convert_encoding("Nombre:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(134, 7, mb_convert_encoding("$IDname $IDlastname", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 7, mb_convert_encoding("Cédula:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(134, 7, mb_convert_encoding("$IDruc", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 7, mb_convert_encoding("Dirección:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(134, 7, mb_convert_encoding("$IDcanton", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 7, mb_convert_encoding("Teléfono:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(134, 7, mb_convert_encoding("$IDphone", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 7, mb_convert_encoding("Correo:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(134, 7, mb_convert_encoding("$IDemail", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Line(18, 105, 200, 105);


$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(17, 7, mb_convert_encoding("Datos del deportista", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(20, 7, mb_convert_encoding("Nombre:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(75, 7, mb_convert_encoding("$Uname", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(20, 7, mb_convert_encoding("Apellido:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(75, 7, mb_convert_encoding("$Ulastname", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(20, 7, mb_convert_encoding("Cédula:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 7, mb_convert_encoding("$Ucredential", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(20, 7, mb_convert_encoding("Teléfono:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 7, mb_convert_encoding("$Uwhatsapp", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(20, 7, mb_convert_encoding("Correo:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 7, mb_convert_encoding("$Uemail ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Ln(7);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(20, 7, mb_convert_encoding("Edad:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 7, mb_convert_encoding("$Ubithdate años", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(20, 7, mb_convert_encoding("Talla:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 7, mb_convert_encoding("$Usize", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(20, 7, mb_convert_encoding("Género:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 7, mb_convert_encoding("$Ugender", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Ln(7);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(30, 7, mb_convert_encoding("Tipo de sangre:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 7, mb_convert_encoding("$Ublood", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(20, 7, mb_convert_encoding("Dirección:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(100, 7, mb_convert_encoding("$Uaddress", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Ln(7);
$pdf->Line(18, 145, 200, 145);
$pdf->Ln(7);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(17, 7, mb_convert_encoding("Datos del curso vacional", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Ln(9);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(20, 5, mb_convert_encoding("Deporte:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(150, 5, mb_convert_encoding("$Sname", 'ISO-8859-1', 'UTF-8'), 0, 'L', false);
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(20, 5, mb_convert_encoding("Escenario:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(150, 5, mb_convert_encoding("$Ename", 'ISO-8859-1', 'UTF-8'), 0, 'L', false);
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(40, 5, mb_convert_encoding("Días de entrenamiento:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(150, 5, mb_convert_encoding("$QHday", 'ISO-8859-1', 'UTF-8'), 0, 'L', false);
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(45, 5, mb_convert_encoding("Horario de entrenamiento:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(150, 5, mb_convert_encoding("$QHstart hasta $QHend", 'ISO-8859-1', 'UTF-8'), 0, 'L', false);
$pdf->Ln(7);
$pdf->Line(18, 187, 200, 187);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->MultiCell(0, 3, mb_convert_encoding("*** VALOR DEL CURSO ***", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 20);
$pdf->MultiCell(0, 3, mb_convert_encoding("$TotalWithDecimal", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
$pdf->Ln(5);

if ($PSid == 1) {
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->MultiCell(0, 1, mb_convert_encoding("$PSname", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
} else if ($PSid == 2) {
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->SetTextColor(255, 165, 0); // Cambiar el color del texto a naranja
    $pdf->MultiCell(0, 1, mb_convert_encoding("$PSname", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
} else {
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->SetTextColor(0, 0, 255);
    $pdf->MultiCell(0, 1, mb_convert_encoding("$PSname", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
}




$pdf->Ln(7);
$pdf->Image('./../../../../assets/image/report/qr.png', 85, 210, 40, 40, 'PNG');
$pdf->Image('./../../../../assets/image/report/logo-100.png', 92, 262, 23, 12, 'PNG');
$pdf->Ln(40);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(255, 0, 0);

if ($Did == 11) {
    $pdf->SetFont('Arial', 'b', 14);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->MultiCell(0, 0, mb_convert_encoding("No se entrega el KIT.", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
} else if ($Did == 12) {
    $pdf->SetFont('Arial', 'b', 14);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->MultiCell(0, 0, mb_convert_encoding("No se entrega el KIT pero si Balón", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
} else if ($Did == 13) {
    $pdf->SetFont('Arial', 'b', 14);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->MultiCell(0, 0, mb_convert_encoding("No se entrega el KIT pero si las Zapatillas.", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
} else {
    if ($KDid == 1) {
        if ($Sname == "NATACION") {
            $pdf->SetFont('Arial', 'b', 14);
            $pdf->SetTextColor(255, 0, 0);
            $pdf->MultiCell(0, 0, mb_convert_encoding("Con este documento puedes retirar en la  $Ename", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
            $pdf->MultiCell(0, 11, mb_convert_encoding("tu $Kname", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
        } else {
            $pdf->SetFont('Arial', 'b', 14);
            $pdf->SetTextColor(255, 0, 0);
            $pdf->MultiCell(0, 0, mb_convert_encoding("Con este documento puedes pasar por bodega para retirar tu", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
            $pdf->MultiCell(0, 11, mb_convert_encoding("$Kname", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
        }
    } else {
        $pdf->SetFont('Arial', 'b', 14);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->MultiCell(0, 0, mb_convert_encoding("$Kname", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
        $pdf->MultiCell(0, 11, mb_convert_encoding("ENTREGADO", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);
    }
}

$pdf->Ln(11);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->MultiCell(0, 0, mb_convert_encoding("www.teampichincha.com", 'ISO-8859-1', 'UTF-8'), 0, 'C', false);

# Nombre del archivo PDF #
$pdf->Output("I", "COMPROBANTE-DE-INSCRIPCION-NRO-TSE-CDP-CV-$invoiceId-2024.pdf", true);

// Establecer encabezados HTTP para cambiar el ícono de la pestaña y el nombre del archivo
header('Content-Type: application/pdf'); // Tipo de contenido
header('Content-Disposition: inline; filename="./../../../../assets/image/report/logo-100.png"'); // Nombre del archivo
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');

// Enviar el contenido del PDF al navegador
readfile('./../../../../assets/image/report/logo-100.png'); // Ruta al archivo PDF generado