<?php
// include_once "./model/users.php";
class AuthenticateController
{
    private $model;

    public function __construct()
    {
        $this->model = new AuthenticateModel(ConnectionDB::getInstance());
    }


    public function updateLockScreen()
    {
        if (isset($_POST['auth-lock-screen'])) {
            $Uid = $_POST['Uid'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $response = $this->model->updateLockScreen($passwordHash, $Uid);
            if ($response) {
                echo '<script src="./alert/updateLockScreen.js"></script>';
                echo '<script> setTimeout(function(){ window.location = "auth-signin?email=' . $email . '&password=' . $password . '"; }, 500); </script>';
                return true;
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                return false;
            }
        }
    }

    public function validationEmail()
    {
        if (isset($_POST['auth-validation-email'])) {
            $email = $_POST['email'];
            echo "<script>function keepFormEmail(){
                document.getElementById('email').value = '" . htmlspecialchars($_POST['email'], ENT_QUOTES) . "';
            }</script>";
            $data = $this->model->validationEmail($email);
            if ($data) {
                if ($data['Ustatus'] == 0) {
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormEmail(); });</script>';
                    echo '<script src="./alert/emailDesactive.js"></script>';
                    return false;
                } else {
                    if ($data['Rid'] == 6) {
                        $name = $data['Uname'];
                        $lastname = $data['Ulastname'];
                        $credential = $data['Ucredential'];
                        $image = $data['Uimage'];
                        $Uid = $data['Uid'];
                        echo '<script src="./alert/verifiedEmail.js"></script>';
                        echo '<script> setTimeout(function(){ window.location = "auth-lock-screen?Uid=' . $Uid . '&emailByUser=' . $email . '&imageByUser=' . $image . '&nameByUser=' . $name . '&lastnameByUser=' . $lastname . '&credentialByUser=' . $credential . '"; }, 500); </script>';
                        return true;
                    } else  {
                        echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormEmail(); });</script>';
                    echo '<script src="./alert/resetAdmin.js"></script>';
                    return false;
                    }
                }
            } else {
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormEmail(); });</script>';
                echo '<script src="./alert/emailError.js"></script>';
                return false;
            }
        }
        return false;
    }
    public function checkEmail()
    {
        if (isset($_POST['auth-checkEmail'])) {
            $emailInput = $_POST['email'];
            echo "<script>function keepFormEmail(){
                document.getElementById('email').value = '" . htmlspecialchars($_POST['email'], ENT_QUOTES) . "';
            }</script>";
            $emailData = $this->model->checkEmail($emailInput);
            if ($emailData) {
                if ($emailData['Ustatus'] == 0) {

                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormEmail(); });</script>';
                    echo '<script src="./alert/emailDesactive.js"></script>';
                    return false;
                } else {
                    echo '<script src="./alert/emailSuccess.js"></script>';
                    return true;
                }
            } else {
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormEmail(); });</script>';
                echo '<script src="./alert/emailError.js"></script>';
                return false;
            }
        }
        return false;
    }

    public function signin()
    {
        if (isset($_POST['submit-auth-signin'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];
            echo "<script>function keepFormPassword(){
                    document.getElementById('email').value = '" . htmlspecialchars($_POST['email'], ENT_QUOTES) . "';
                    document.getElementById('password').value = '" . htmlspecialchars($_POST['password'], ENT_QUOTES) . "';
                }</script>";
            $login = $this->model->signin($email, $password);

            if ($login) {

                echo '<script src="./alert/loading.js"></script>';
                $this->model->loginHistory($email);
                $this->startSession($login);

                if (
                    empty($_SESSION['Uname'])
                    || empty($_SESSION['Ulastname'])
                    || empty($_SESSION['Ucredential'])
                    || empty($_SESSION['Uemail'])
                    || empty($_SESSION['Uwhatsapp'])
                    || empty($_SESSION['Ubirthdate'])
                    || empty($_SESSION['Ugender'])
                    || empty($_SESSION['Ucity'])
                    || empty($_SESSION['Uaddress'])
                    || empty($_SESSION['Ublood'])
                    || empty($_SESSION['Usize'])

                ) {

                    echo '<script> setTimeout(function(){ window.location = "auth-complet-register"; }, 500); </script>';
                } else {
                    echo '<script> setTimeout(function(){ window.location = "home"; }, 500); </script>';
                }
            } else {
                echo '<script src="./alert/accessError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormPassword(); });</script>';
                return false;
            }
        }
        return false;
    }

    private function startSession($login)
    {
        if (!is_array($login)) {
            // Manejar error si $login no es un array
            return false;
        }

        $_SESSION["login"] = true;
        foreach ($login as $key => $value) {
            // Filtrar datos sensibles antes de almacenarlos en la sesión
            if ($key !== 'Upassword' && $key !== 'UdateCreated' && $key !== 'UdateUpdated') {
                $_SESSION[$key] = $value;
            }
        }
    }


    function routesPermmisionsRole($permission_roleId)
    {
        $routes = $this->model->routesPermmisionsRole($permission_roleId);
        if (!empty($routes)) {
            return $routes;
        } else {
            return array('message' => 'No se encontraron rutas para el rol de usuario proporcionado.');
        }
    }


    public function userIdRole($userId_role)
    {
        $userRoleData = $this->model->userIdRole($userId_role);
        if (!empty($userRoleData)) {
            return $userRoleData;
        } else {
            return array('message' => 'No se encontraron rutas para el rol de usuario proporcionado.');
        }
    }

    public function ViewRoles()
    {
        $response = $this->model->getAllRoles();
        return $response;
    }
}
