<?php

$invoiceController = new InvoiceController();

$userId = $_SESSION['Uid'];

$itemPage = 10;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;
if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $invoiceOnline = $invoiceController->searchInvoiceGeneral($name);
    $total = count($invoiceOnline);
    $totalPage = ceil($total / $itemPage);
    $invoiceOnline = array_slice($invoiceOnline, $start, $itemPage);
}
else if (isset($_GET['Dstart']) && isset($_GET['Dend']) && isset($_GET['moduleD'])) {
    $Dstart = $_GET['Dstart'];
    $Dend = $_GET['Dend'];
    $Modulo = $_GET['moduleD'];
    $invoiceOnline = $invoiceController->generalRangerDate($Dstart, $Dend, $Modulo);
    $total = count($invoiceOnline);
    // $totalPage = ceil($total / $itemPage);
    // $invoiceOnline = array_slice($invoiceOnline, $start, $itemPage);
}
else if (isset($_GET['module'])) {
    $Modulo = $_GET['module'];
    $invoiceOnline = $invoiceController->moduloMyRegisterGenerales($Modulo);
    $total = count($invoiceOnline);
    // $totalPage = ceil($total / $itemPage);
    // $invoiceOnline = array_slice($invoiceOnline, $start, $itemPage);
}
else {
    $invoiceOnline = $invoiceController->getAllInvoiceGenerales();
    $total   = $invoiceController->countInvoiceOnline();
    $totalPage = ceil($total / $itemPage);
    $invoiceOnline = array_slice($invoiceOnline, $start, $itemPage);
}