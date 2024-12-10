<?php
$posController = new PosController();

$itemPage = 50;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;

if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $myregister = $posController->searchRegisterPOS($name);
    $total = count($myregister);
    $totalPage = ceil($total / $itemPage);
    $myregister = array_slice($myregister, $start, $itemPage);
} 

else if (isset($_GET['Dstart']) && isset($_GET['Dend'])) {
    $Dstart = $_GET['Dstart'];
    $Dend = $_GET['Dend'];
    $myregister = $posController->dateStartEndRegisterPOS($Dstart, $Dend);
    $total = count($myregister);
    $totalPage = ceil($total / $itemPage);
    $myregister = array_slice($myregister, $start, $itemPage);
}

else if (isset($_GET['module'])) {
    $Modulo = $_GET['module'];
    $myregister = $posController->moduloRegisterPOS($Modulo);
    $total = count($myregister);
    $totalPage = ceil($total / $itemPage);
    $myregister = array_slice($myregister, $start, $itemPage);
} 

else {
    $myregister = $posController->getAllRegisterPOS();
    $total   = $posController->countRegisterPOS();
    $total = count($myregister);

    $totalPage = ceil($total / $itemPage);
    $myregister = array_slice($myregister, $start, $itemPage);
}
