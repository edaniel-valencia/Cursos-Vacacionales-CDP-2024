<?php

$consultationController = new ConsultationController();


$itemPage = 100;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;
if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $consultation = $consultationController->searchRegisterConsultation($name);
    $total = count($consultation);
    $totalPage = ceil($total / $itemPage);
    $consultation = array_slice($consultation, $start, $itemPage);
}

else if (isset($_GET['module']) && isset($_GET['sport']) && isset($_GET['QHid']) ) {
    
    $module = $_GET['module'];
    $sport  = $_GET['sport'];
    $QHid   = $_GET['QHid'];
    
    $consultation = $consultationController->MSHQRegisterConsultation($module, $sport, $QHid);
    $total = count($consultation);
}

else if (isset($_GET['module']) && isset($_GET['sport']) && isset($_GET['start']) && isset($_GET['end'])) {
    
    $module = $_GET['module'];
    $sport  = $_GET['sport'];
    $start  = $_GET['start'];
    $end    = $_GET['end'];
    
    $consultation = $consultationController->MSSERegisterConsultation($module, $sport, $start, $end);
    $total = count($consultation);
}
else if (isset($_GET['module']) && isset($_GET['sport'])) {

    $module = $_GET['module'];
    $sport  = $_GET['sport'];
    
    $consultation = $consultationController->MSRegisterConsultationByHour($module, $sport);
    $total = count($consultation);
}
else if (isset($_GET['module'])) {

    $module = $_GET['module'];
    
    $consultation = $consultationController->MRegisterConsultation($module);
    $total = count($consultation);
}
else if (isset($_GET['moduleSure'])) {

    $moduleSure = $_GET['moduleSure'];
    
    $consultation = $consultationController->MRegisterConsultationS($moduleSure);
    $total = count($consultation);
}
else if (isset($_GET['sport'])) {

    $sport = $_GET['sport'];
    
    $consultation = $consultationController->SRegisterConsultation($sport);
    $total = count($consultation);
}
else {
    $consultation = $consultationController->getAllRegisterConsultation();
    $total   = $consultationController->countRegisterConsultation();
    $totalPage = ceil($total / $itemPage);
    $consultation = array_slice($consultation, $start, $itemPage);
}