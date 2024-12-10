<?php
class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel(ConnectionDB::getInstance());
    }

    public function getAllUsers()
    {
        $response = $this->model->getAllUsers();
        return $response;
    }

    public function getAllUsersPOS()
    {
        $response = $this->model->getAllUsersPOS();
        return $response;
    }

    public function getCountAllUsers()
    {
        $response = $this->model->getCountAllUsers();
        return $response;
    }

   
    public function getUserById($userId)
    {
        $user = $this->model->getUserById($userId);
        return $user;
    }

    public function getDataUserId($userId)
    {
        $userData = $this->model->getDataUserId($userId);

        // Verifica si $userData no está vacío y los campos específicos no están vacíos
        if (
            $userData &&
            !empty($userData['Uname']) &&
            !empty($userData['Ulastname']) &&
            !empty($userData['Ucredential']) &&
            !empty($userData['Uemail']) &&
            !empty($userData['Uwhatsapp']) &&
            !empty($userData['Ubirthdate']) &&
            !empty($userData['Ugender']) &&
            !empty($userData['Ucity']) &&
            !empty($userData['Ublood']) &&
            !empty($userData['Usize']) &&
            !empty($userData['Uaddress'])
        ) {
            return $userData;
        } else {
            echo '<script> setTimeout(function(){ window.location = "auth-complet-register"; }, 500); </script>';
            return null;
        }
    }

    // INICIO DE PAGINACION

    public function getUserPagination($start, $itemPage)
    {
        $getUserPagination = $this->model->getUserPagination($start, $itemPage);
        return $getUserPagination;
    }

    public function countUser()
    {
        $countUser = $this->model->countUser();
        return $countUser;
    }

    public function countUserPOS()
    {
        $countUser = $this->model->countUserPOS();
        return $countUser;
    }

    public function searchUser($name)
    {
        $searchUser = $this->model->searchUser($name);
        return $searchUser;
    }
    public function searchUserPOS($name)
    {
        $searchUser = $this->model->searchUserPOS($name);
        return $searchUser;
    }

    // FIN DE PAGINACION

    public function createUser()
    {
        if (isset($_POST["user-add"])) {

            echo "<script>
                function keepFormUser(){
                    document.getElementById('role').value = '" . htmlspecialchars($_POST['role'], ENT_QUOTES) . "';
                    document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';
                    document.getElementById('lastname').value = '" . htmlspecialchars($_POST['lastname'], ENT_QUOTES) . "';
                    document.getElementById('credentity').value = '" . htmlspecialchars($_POST['credentity'], ENT_QUOTES) . "';
                    document.getElementById('birthdate').value = '" . htmlspecialchars($_POST['birthdate'], ENT_QUOTES) . "';
                    document.getElementById('gender').value = '" . htmlspecialchars($_POST['gender'], ENT_QUOTES) . "';
                    document.getElementById('city').value = '" . htmlspecialchars($_POST['city'], ENT_QUOTES) . "';
                    document.getElementById('size').value = '" . htmlspecialchars($_POST['size'], ENT_QUOTES) . "';
                    document.getElementById('blood').value = '" . htmlspecialchars($_POST['blood'], ENT_QUOTES) . "';
                    document.getElementById('address').value = '" . htmlspecialchars($_POST['address'], ENT_QUOTES) . "';
                    document.getElementById('nickname').value = '" . htmlspecialchars($_POST['nickname'], ENT_QUOTES) . "';
                    document.getElementById('email').value = '" . htmlspecialchars($_POST['email'], ENT_QUOTES) . "';
                    document.getElementById('password').value = '" . htmlspecialchars($_POST['password'], ENT_QUOTES) . "';
                    document.getElementById('repeat-password').value = '" . htmlspecialchars($_POST['repeat-password'], ENT_QUOTES) . "';
                    document.getElementById('whatsapp').value = '" . htmlspecialchars($_POST['whatsapp'], ENT_QUOTES) . "';
                    document.getElementById('facebook').value = '" . htmlspecialchars($_POST['facebook'], ENT_QUOTES) . "';
                    document.getElementById('tiktok').value = '" . htmlspecialchars($_POST['tiktok'], ENT_QUOTES) . "';
                }
            </script>";

            $role = $_POST['role'];
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $credential = $_POST['credentity'];
            $birthdate = $_POST['birthdate'];
            $gender = $_POST['gender'];
            $city = $_POST['city'];
            $size = $_POST['size'];
            $blood = $_POST['blood'];
            $address = $_POST['address'];
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $whatsapp = $_POST['whatsapp'];
            $facebook = $_POST['facebook'];
            $tiktok = $_POST['tiktok'];
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $defaultImage = "users.jpg";

            if ($this->model->uniqueEmail($email)) {
                echo '<script src="./alert/duplicateEmail.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                return;
            } else if ($this->model->uniqueNickname($nickname)) {
                echo '<script src="./alert/duplicateNickname.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                return;
            } else if ($this->model->uniqueCredential($credential)) {
                echo '<script src="./alert/duplicateCredential.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                return;
            }

            if (!empty($_FILES['imagen']['name'])) {
                $nameTypeImage = $_FILES['imagen']['name'];
                $routeImage = $_FILES['imagen']['tmp_name'];
                $directory = "./../assets/image/system/user/";
                $routeDestination = $directory . $nameTypeImage;

                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }

                if (move_uploaded_file($routeImage, $routeDestination)) {
                    $nameRoute = $routeDestination;
                    echo $nameRoute;
                } else {
                    echo '<script src="./alert/registerError.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                }
            } else {
                $nameTypeImage = $defaultImage;
            }
            $userId = $this->model->createUsers($name, $lastname, $credential, $birthdate, $gender, $city, $address, $nickname, $email, $passwordHash, $whatsapp, $facebook, $tiktok, $nameTypeImage, $size, $blood);
            if ($userId) {
                $this->model->addUserRole($userId, $role);
                echo '<script src="./alert/registerSuccess.js"></script>';
            } else {
                echo '<script src="./alert/registerError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
            }
        }
    }
   
   
   
    public function createUserPOS()
    {
        if (isset($_POST["submit-create-user-pos"])) {

            echo "<script>
                function keepFormUser(){
                    document.getElementById('name').value = '" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "';
                    document.getElementById('lastname').value = '" . htmlspecialchars($_POST['lastname'], ENT_QUOTES) . "';
                    document.getElementById('credentity').value = '" . htmlspecialchars($_POST['credentity'], ENT_QUOTES) . "';
                    document.getElementById('birthdate').value = '" . htmlspecialchars($_POST['birthdate'], ENT_QUOTES) . "';
                    document.getElementById('gender').value = '" . htmlspecialchars($_POST['gender'], ENT_QUOTES) . "';
                    document.getElementById('city').value = '" . htmlspecialchars($_POST['city'], ENT_QUOTES) . "';
                    document.getElementById('size').value = '" . htmlspecialchars($_POST['size'], ENT_QUOTES) . "';
                    document.getElementById('blood').value = '" . htmlspecialchars($_POST['blood'], ENT_QUOTES) . "';
                    document.getElementById('address').value = '" . htmlspecialchars($_POST['address'], ENT_QUOTES) . "';
                    document.getElementById('email').value = '" . htmlspecialchars($_POST['email'], ENT_QUOTES) . "';
                    document.getElementById('Upassword').value = '" . htmlspecialchars($_POST['Upassword'], ENT_QUOTES) . "';
                    document.getElementById('whatsapp').value = '" . htmlspecialchars($_POST['whatsapp'], ENT_QUOTES) . "';
                }
            </script>";

            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $credential = $_POST['credentity'];
            $birthdate = $_POST['birthdate'];
            $gender = $_POST['gender'];
            $city = $_POST['city'];
            $size = $_POST['size'];
            $blood = $_POST['blood'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $password = $_POST['Upassword'];
            $whatsapp = $_POST['whatsapp'];
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $defaultImage = "users.jpg";

            if ($this->model->uniqueEmail($email)) {
                echo '<script src="./alert/duplicateEmail.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                return;
            
            } else if ($this->model->uniqueCredential($credential)) {
                echo '<script src="./alert/duplicateCredential.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                return;
            }

           
                $nameTypeImage = $defaultImage;
           
            $userId = $this->model->createUsersPOS($name, $lastname, $credential, $birthdate, $gender, $city, $address, $email, $passwordHash, $whatsapp, $nameTypeImage, $size, $blood);
            if ($userId) {
                $role = 6;
                $this->model->addUserRole($userId, $role);
                echo '<script src="./alert/registerSuccess.js"></script>';
                echo '<script> setTimeout(function(){ window.location = "pos-web"; }, 500); </script>';

            } else {
                echo '<script src="./alert/registerError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
            }
        }
    }

    public function deleteUser($id)
    {
        if (isset($_POST["submit-btn-delete-user"])) {
            echo $id = $_POST['Uid'];

            $getByIdUserRole = $this->model->getByIdUserRole($id);
            if ($getByIdUserRole > 0) {
                echo '<script src="./alert/deleteErrorRelation.js"></script>';
            } else {
                $result = $this->model->deleteUser($id);
                if ($result) {
                    echo '<script src="./alert/deleteSuccess.js"></script>';
                } else {

                    echo '<script src="./alert/deleteError.js"></script>';
                }
                echo '<script> setTimeout(function(){ window.location = "user-list"; }, 1500); </script>';
            }
        }
    }

    public function updateUserInfo()
    {
        if (isset($_POST["submit-btn-update-info"])) {
            $Uid = $_POST['Uid'];
            $Uname = $_POST['name'];
            $Ulastname = $_POST['lastname'];
            $Ubirthdate = $_POST['birthdate'];
            $Ugender = $_POST['gender'];
            $Ucity = $_POST['city'];
            $Uaddress = $_POST['address'];
            $Uwhatsapp = $_POST['whatsapp'];
            $Ufacebook = $_POST['facebook'];
            $Utiktok = $_POST['tiktok'];
            $Usize = $_POST['size'];
            $Ublood = $_POST['blood'];

            $response = $this->model->updateUserInfo($Uid, $Uname, $Ulastname, $Ubirthdate, $Ugender, $Ucity, $Uaddress, $Uwhatsapp, $Ufacebook, $Utiktok, $Usize, $Ublood);
            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "user-detail?user-id=' . $Uid . '"; }, 1000); </script>';
        }
    }

    public function updateUserStatus()
    {
        if (isset($_POST["submit-btn-status-update"])) {
            echo $id = $_POST['Uid'];
            echo $status = $_POST['Ustatus'];


            $response = $this->model->updateUserStatus($id, $status);
            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "user-detail?user-id=' . $id . '"; }, 1000); </script>';
            return $response;
        }
    }

    public function updateUserKey()
    {
        if (isset($_POST["submit-btn-update-key"])) {
            $id = $_POST['Uid'];
            $password = $_POST['password'];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $response = $this->model->updateUserKey($id, $passwordHash);

            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "user-detail?user-id=' . $id . '"; }, 1000); </script>';

            return $response;
        }
    }

    public function updateUserImage()
    {
        if (isset($_POST["submit-btn-update-image"])) {

            $id = $_POST['Uid'];
            $defaultImage = "TSoftec.jpg";

            if (!empty($_FILES['imagen']['name'])) {
                $nameTypeImage = $_FILES['imagen']['name'];
                $routeImage = $_FILES['imagen']['tmp_name'];
                $directory = "./../assets/image/system/user/";
                $routeDestination = $directory . $nameTypeImage;

                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                if (move_uploaded_file($routeImage, $routeDestination)) {
                    $nameRoute = $routeDestination;
                    echo $nameRoute;
                } else {
                    echo '<script src="./alert/registerError.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                }
            } else {
                $nameTypeImage = $defaultImage;
            }

            $response = $this->model->updateUseImage($id, $nameTypeImage);

            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "user-detail?user-id=' . $id . '"; }, 1000); </script>';

            return $response;
        }
    }

    public function updateUserRole()
    {
        if (isset($_POST["submit-btn-update-role"])) {
            echo $Uid = $_POST['Uid'];
            echo $role = $_POST['role'];
            $response = $this->model->addUserRole($Uid, $role);

            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "user-detail?user-id=' . $Uid . '"; }, 1000); </script>';

            return $response;
        }
    }


    public function updateUserProfileInfo()
    {
        if (isset($_POST["submit-btn-update-info"])) {
            echo $Uid = $_POST['Uid'];
            echo $Uname = $_POST['name'];
            echo $Ulastname = $_POST['lastname'];
            echo $Ubirthdate = $_POST['birthdate'];
            echo $Ugender = $_POST['gender'];
            echo $Ucity = $_POST['city'];
            echo $Uaddress = $_POST['address'];
            echo $Uwhatsapp = $_POST['whatsapp'];
            echo $Ufacebook = $_POST['facebook'];
            echo $Utiktok = $_POST['tiktok'];
            echo $Usize = $_POST['size'];
            echo $Ublood = $_POST['blood'];

            $response = $this->model->updateUserInfo($Uid, $Uname, $Ulastname, $Ubirthdate, $Ugender, $Ucity, $Uaddress, $Uwhatsapp, $Ufacebook, $Utiktok, $Usize, $Ublood);
            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "user-profile"; }, 1000); </script>';
        }
    }

    public function updateUserProfileStatus()
    {
        if (isset($_POST["submit-btn-status-update"])) {
            echo $id = $_POST['Uid'];
            echo $status = $_POST['Ustatus'];


            $response = $this->model->updateUserStatus($id, $status);
            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "user-profile"; }, 1000); </script>';
            return $response;
        }
    }

    public function updateUserProfileKey()
    {
        if (isset($_POST["submit-btn-update-key"])) {
            $id = $_POST['Uid'];
            $password = $_POST['password'];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $response = $this->model->updateUserKey($id, $passwordHash);

            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "user-profile"; }, 1000); </script>';

            return $response;
        }
    }

    public function updateUserProfileImage()
    {
        if (isset($_POST["submit-btn-update-image"])) {

            $id = $_POST['Uid'];
            $defaultImage = "TSoftec.jpg";

            if (!empty($_FILES['imagen']['name'])) {
                $nameTypeImage = $_FILES['imagen']['name'];
                $routeImage = $_FILES['imagen']['tmp_name'];
                $directory = "./../assets/image/system/user/";
                $routeDestination = $directory . $nameTypeImage;

                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                if (move_uploaded_file($routeImage, $routeDestination)) {
                    $nameRoute = $routeDestination;
                    echo $nameRoute;
                } else {
                    echo '<script src="./alert/registerError.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                }
            } else {
                $nameTypeImage = $defaultImage;
            }

            $response = $this->model->updateUseImage($id, $nameTypeImage);

            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "user-profile"; }, 1000); </script>';

            return $response;
        }
    }

    public function updateUserProfileRole()
    {
        if (isset($_POST["submit-btn-update-role"])) {
            echo $Uid = $_POST['Uid'];
            echo $role = $_POST['role'];
            $response = $this->model->addUserRole($Uid, $role);

            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "user-profile"; }, 1000); </script>';

            return $response;
        }
    }

    /////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////   register


    public function updateUserProfileInfoUser()
    {
        if (isset($_POST["submit-btn-update-info-user"])) {
            echo $Uid = $_POST['Uid'];
            echo $Uname = $_POST['Uname'];
            echo $Ulastname = $_POST['Ulastname'];
            echo $Ubirthdate = $_POST['Ubirthdate'];
            echo $Ugender = $_POST['Ugender'];
            echo $Ucity = $_POST['Ucity'];
            echo $Uaddress = $_POST['Uaddress'];
            echo $Uwhatsapp = $_POST['Uwhatsapp'];
            echo $Ublood = $_POST['Ublood'];
            echo $Usize = $_POST['Usize'];

          

            $response = $this->model->updateUserInfoUsers($Uid, $Uname, $Ulastname, $Ubirthdate, $Ugender, $Ucity, $Uaddress,  $Uwhatsapp, $Ublood, $Usize);
            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "course-available"; }, 1000); </script>';
        }
    }


    public function updateUserProfileImagen()
    {
        if (isset($_POST["submit-btn-update-image"])) {

            $id = $_POST['Uid'];
            $defaultImage = "TSoftec.jpg";

            if (!empty($_FILES['Uimage']['name'])) {
                $nameTypeImage = $_FILES['Uimage']['name'];
                $routeImage = $_FILES['Uimage']['tmp_name'];
                $directory = "./../assets/image/system/user/";
                $routeDestination = $directory . $nameTypeImage;

                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                if (move_uploaded_file($routeImage, $routeDestination)) {
                    $nameRoute = $routeDestination;
                    echo $nameRoute;
                } else {
                    echo '<script src="./alert/registerError.js"></script>';
                    echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                }
            } else {
                $nameTypeImage = $defaultImage;
            }

            $response = $this->model->updateUseImage($id, $nameTypeImage);

            if ($response) {
                echo '<script src="./alert/updateSuccess.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            } else {
                echo '<script src="./alert/updateError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormCRol(); });</script>';
            }
            echo '<script> setTimeout(function(){ window.location = "home"; }, 1000); </script>';

            return $response;
        }
    }

    public function createRegisterUser()
    {
        if (isset($_POST["user-register"])) {

            echo "<script>
                function keepFormUser(){
                    document.getElementById('Uname').value = '" . htmlspecialchars($_POST['Uname'], ENT_QUOTES) . "';
                    document.getElementById('Ulastname').value = '" . htmlspecialchars($_POST['Ulastname'], ENT_QUOTES) . "';
                    document.getElementById('Ucredential').value = '" . htmlspecialchars($_POST['Ucredential'], ENT_QUOTES) . "';
                    document.getElementById('Ubirthdate').value = '" . htmlspecialchars($_POST['Ubirthdate'], ENT_QUOTES) . "';
                    document.getElementById('Ugender').value = '" . htmlspecialchars($_POST['Ugender'], ENT_QUOTES) . "';
                    document.getElementById('Uwhatsapp').value = '" . htmlspecialchars($_POST['Uwhatsapp'], ENT_QUOTES) . "';
                    document.getElementById('Uemail').value = '" . htmlspecialchars($_POST['Uemail'], ENT_QUOTES) . "';
                    document.getElementById('Upassword').value = '" . htmlspecialchars($_POST['Upassword'], ENT_QUOTES) . "';
                   
                }
            </script>";

            $Uname = $_POST['Uname'];
            $Ulastname = $_POST['Ulastname'];
            $Ucredential = $_POST['Ucredential'];
            $Ubirthdate = $_POST['Ubirthdate'];
            $Ugender = $_POST['Ugender'];
            $Uwhatsapp = $_POST['Uwhatsapp'];
            $Uemail = $_POST['Uemail'];
            $Upassword = $_POST['Upassword'];

            $passwordHash = password_hash($Upassword, PASSWORD_DEFAULT);



            if ($this->model->uniqueEmail($Uemail)) {
                echo '<script src="./alert/duplicateEmail.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                return;
                // } 
                // else if ($this->model->uniqueWhatpsapp($Uwhatsapp)) {
                //     echo '<script src="./alert/duplicateWhatpsapp.js"></script>';
                //     echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                //     return;
            } else if ($this->model->uniqueCredential($Ucredential)) {
                echo '<script src="./alert/duplicateCredential.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
                return;
            }


            $userId = $this->model->createRegisterUsers($Uname, $Ulastname, $Ucredential,  $Ubirthdate, $Ugender, $Uemail, $passwordHash, $Uwhatsapp);
            if ($userId) {
                $this->model->addUserRole($userId, 6);
                echo '<script src="./alert/registerSuccess.js"></script>';
                echo '<script> setTimeout(function(){ window.location = "auth-signin?email='.$Uemail.'&password='.$Upassword.'"; }, 1500); </script>';
            } else {
                echo '<script src="./alert/registerError.js"></script>';
                echo '<script> document.addEventListener("DOMContentLoaded", function() {keepFormUser(); });</script>';
            }
        }
    }
}
