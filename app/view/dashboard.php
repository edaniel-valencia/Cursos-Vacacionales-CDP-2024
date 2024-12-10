<?php

session_start();
$inactive_time = 1800; // 30 minutos = 1800 segundos

if (isset($_SESSION["LAST_ACTIVITY"]) && (time() - $_SESSION["LAST_ACTIVITY"] > $inactive_time)) {
    // Si el usuario ha estado inactivo durante más del tiempo permitido, destruye la sesión y redirige al inicio de sesión
    session_unset();     // Elimina todas las variables de sesión
    session_destroy();   // Destruye la sesión actual
    require_once "page/auth/auth-logout.php";
    exit();
}

// Actualiza el tiempo de actividad
$_SESSION["LAST_ACTIVITY"] = time();

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {

    require_once "include/header.php";

    $permission_roleId = $_SESSION["Rid"];
    $authenticateController = new AuthenticateController();
    $rutas = $authenticateController->routesPermmisionsRole($permission_roleId);
    $user_roleIdU = $_SESSION["Uid"];
    $authenticateController = new AuthenticateController();
    $userRoleData = $authenticateController->userIdRole($user_roleIdU);
    foreach ($userRoleData as $row) {
        $roleName = $row['Rname'];
        $roleId = $row['Rid'];
    }

    require_once "include/navbarV.php";
    require_once "include/navbarH.php";

    if (isset($_GET["ruta"])) {
        $ruta = $_GET["ruta"];
        if (in_array($ruta, $rutas)) {
            if (strpos($ruta, 'auth-') === 0) {
                require_once "page/auth/{$ruta}.php";
            } else if (strpos($ruta, 'course-') === 0) {
                require_once "page/course/{$ruta}.php";
            } else if (strpos($ruta, 'consultation-') === 0) {
                require_once "page/consultation/{$ruta}.php";
            } else if (strpos($ruta, 'discount-') === 0) {
                require_once "page/discount/{$ruta}.php";
            } else if (strpos($ruta, 'home-') === 0) {
                require_once "page/home/{$ruta}.php";
            } else if (strpos($ruta, 'invoice-') === 0) {
                require_once "page/invoice/{$ruta}.php";
            } else if (strpos($ruta, 'inscription-') === 0) {
                require_once "page/inscription/{$ruta}.php";
            } else if (strpos($ruta, 'kit-') === 0) {
                require_once "page/kit/{$ruta}.php";
            }
            // else if (strpos($ruta, 'hour') === 0)          { require_once "page/hour/{$ruta}.php"; } 
            else if (strpos($ruta, 'module-') === 0) {
                require_once "page/module/{$ruta}.php";
            } else if (strpos($ruta, 'report-') === 0) {
                require_once "page/report/{$ruta}.php";
            } else if (strpos($ruta, 'order-') === 0) {
                require_once "page/order/{$ruta}.php";
            } else if (strpos($ruta, 'permission-') === 0) {
                require_once "page/permission/{$ruta}.php";
            } else if (strpos($ruta, 'pos-') === 0) {
                require_once "page/pos/{$ruta}.php";
            }
            // else if (strpos($ruta, 'price') === 0)         { require_once "page/price/{$ruta}.php"; } 
            else if (strpos($ruta, 'scenery') === 0) {
                require_once "page/scenery/{$ruta}.php";
            } else if (strpos($ruta, 'role-') === 0) {
                require_once "page/role/{$ruta}.php";
            } else if (strpos($ruta, 'sport-') === 0) {
                require_once "page/sport/{$ruta}.php";
            } else if (strpos($ruta, 'user-') === 0) {
                require_once "page/user/{$ruta}.php";
            } else {
                require_once "page/{$ruta}.php";
            }
        } else {
            require_once "page/404.php";
        }
    }
    require_once "include/footer.php";
    require_once "include/script.php";
} else {
    require_once "include/header.php";
    // require_once "include/navbarP.php";
    if (isset($_GET["ruta"])) {
        $ruta = $_GET["ruta"];
        $public = array("auth-signin", "auth-signup",  "auth-reset", "auth-lock-screen");
        if (in_array($ruta, $public)) {
            if (strpos($ruta, 'auth-') === 0) {
                require_once "page/auth/" . $ruta . ".php";
            }
            //  else if (strpos($ruta, 'home') === 0) {
            //     require_once "page/public/" . $ruta . ".php";
            // }
        }
    } else {
        // If the route is not public, require the signin page by default
        require_once "page/auth/auth-signin.php";
        // require_once "page/public/inicio.php";
    }
    // require_once "include/footer.php";
    require_once "include/script.php";
    exit();
}

?>
