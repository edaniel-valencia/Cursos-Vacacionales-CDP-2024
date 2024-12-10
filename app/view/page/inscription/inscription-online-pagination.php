<?php

$invoiceController = new InvoiceController();

$userId = $_SESSION['Uid'];

$itemPage = 10;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;
if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $invoiceOnline = $invoiceController->searchInvoiceOnline($name);
    $total = count($invoiceOnline);
    $totalPage = ceil($total / $itemPage);
    $invoiceOnline = array_slice($invoiceOnline, $start, $itemPage);
}
else if (isset($_GET['Dstart']) && isset($_GET['Dend'])) {
    $Dstart = $_GET['Dstart'];
    $Dend = $_GET['Dend'];
    $invoiceOnline = $invoiceController->onlineRangerDateonllline($Dstart, $Dend);
    $total = count($invoiceOnline);
    $totalPage = ceil($total / $itemPage);
    $invoiceOnline = array_slice($invoiceOnline, $start, $itemPage);
}
else {
    $invoiceOnline = $invoiceController->getAllInvoiceOnline();
    $total   = $invoiceController->countInvoiceOnline();
    $totalPage = ceil($total / $itemPage);
    $invoiceOnline = array_slice($invoiceOnline, $start, $itemPage);
}