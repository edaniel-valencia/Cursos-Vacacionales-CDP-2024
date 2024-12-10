<?php
$posController = new PosController();

$userId = $_SESSION['Uid'];
$itemPage = 50;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;

if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $myregister = $posController->searchMyCourseByIdPOS($name, $userId);
    $total = count($myregister);
    $totalPage = ceil($total / $itemPage);
    $myregister = array_slice($myregister, $start, $itemPage);
} 

else if (isset($_GET['Dstart']) && isset($_GET['Dend'])) {
    $Dstart = $_GET['Dstart'];
    $Dend = $_GET['Dend'];
    $myregister = $posController->dateStartEndMyRegisterByIdPOS($Dstart, $Dend, $userId);
    $total = count($myregister);
    $totalPage = ceil($total / $itemPage);
    $myregister = array_slice($myregister, $start, $itemPage);
}

else if (isset($_GET['module'])) {
    $Modulo = $_GET['module'];
    $myregister = $posController->moduloMyRegisterByIdPOS($Modulo,  $userId);
    $total = count($myregister);
    $totalPage = ceil($total / $itemPage);
    $myregister = array_slice($myregister, $start, $itemPage);
} 

else {
    $myregister = $posController->getAllMyCourseByIdPOS($userId);
    $total   = $posController->countMyCourseByIdPOS($userId);
    $total = count($myregister);

    $totalPage = ceil($total / $itemPage);
    $myregister = array_slice($myregister, $start, $itemPage);
}
