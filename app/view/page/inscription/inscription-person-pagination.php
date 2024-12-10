<?php

$invoiceController = new InvoiceController();

$userId = $_SESSION['Uid'];

$itemPage = 10;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;
if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $invoicePerson = $invoiceController->searchInvoicePerson($name);
    $total = count($invoicePerson);
    $totalPage = ceil($total / $itemPage);
    $invoicePerson = array_slice($invoicePerson, $start, $itemPage);


} else if (isset($_GET['Dstart']) && isset($_GET['Dend'])) {
    
    $Dstart = $_GET['Dstart'];
    $Dend = $_GET['Dend'];
    $invoicePerson = $invoiceController->onlineRangerDatePresencial($Dstart, $Dend);
    $total = count($invoicePerson);
    $totalPage = ceil($total / $itemPage);
    $invoicePerson = array_slice($invoicePerson, $start, $itemPage);


} else {
    $invoicePerson = $invoiceController->getAllInvoicePerson();
    $total   = $invoiceController->countInvoicePerson();
    $totalPage = ceil($total / $itemPage);
    $invoicePerson = array_slice($invoicePerson, $start, $itemPage);
}