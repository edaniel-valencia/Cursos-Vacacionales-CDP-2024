<?php
$userController = new UserController();

$itemPage = 10;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;

if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $users = $userController->searchUserPOS($name);
    $total = count($users);
    $totalPage = ceil($total / $itemPage);
    $users = array_slice($users, $start, $itemPage);
} else {
    $users = $userController->getAllUsersPOS();
    $total = $userController->countUserPOS();
    $totalPage = ceil($total / $itemPage);
    $users = array_slice($users, $start, $itemPage);
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
//     $users = $userController->getUserPagination($start, $itemPage);
//     $total = $userController->countUser();
//     $totalPage = ceil($total / $itemPage);
// }

?>
