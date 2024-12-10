<?php

$itemPage = 10;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;

// Obtener datos de PERMISOS
if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $permissions = $permissionController->searchPermissions($name);
    $total = count($permissions); // Actualizar el total para la búsqueda
} else {
    $permissions = $permissionController->getPermissionsPagination($start, $itemPage);
    $total = $permissionController->countPermissions();
}

$totalPage = ceil($total / $itemPage);
