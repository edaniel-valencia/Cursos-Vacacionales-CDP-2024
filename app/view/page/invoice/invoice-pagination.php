<?php
$invoiceController = new InvoiceController();

$itemPage = 10;
$userId = $_SESSION['Uid'];

$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $mycourses = $invoiceController->searchMyCourseUser($search, $userId);
    $total = count($mycourses);
    $totalPage = ceil($total / $itemPage);
    $mycourses = array_slice($mycourses, $start, $itemPage);
} else {
    $mycourses = $invoiceController->getAllMyCourse($userId);
    $total   = $invoiceController->countMyCourseUser($userId);
    $totalPage = ceil($total / $itemPage);
    $mycourses = array_slice($mycourses, $start, $itemPage);
}

// $itemPage = 10;
// $page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
// $start = ($page - 1) * $itemPage;
// if (isset($_GET['search'])) {
//     $name = $_GET['search'];
//     $users = $userController->searchUser($name);
//     $total = count($users);
//     $totalPage = ceil($total / $itemPage);
//     $users = array_slice($users, $start, $itemPage);
// } else {
//     $users = $userController->getAllUsers();
//     $total = $userController->countUser();
//     $totalPage = ceil($total / $itemPage);
//     $users = array_slice($users, $start, $itemPage);
// }   

