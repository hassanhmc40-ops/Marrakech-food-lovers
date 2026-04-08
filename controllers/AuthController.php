<?php
require_once __DIR__ ."/../models/User.php";

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];

            $success = false;
            
             if (empty($username) || empty($email) || empty($password)) {
                $error = "Tous les champs obligatoires ne sont pas remplis.";
            } elseif ($password !== $password_confirm) {
                $error = "Les deux mots de passe sont différents.";
            } elseif ($this->userModel->findByEmail($email)) {
                $error = "Ce nom d'utilisateur ou cet email est déjà existant";
            } else {
                $success = $this->userModel->register($username, $email, $password);
            }

            if ($success){
                header('Location: login.php?msg=account_created');
                exit();
            } else {
                include 'views/register.php';
            }   
        }     
     
    }
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->login($email, $password);

            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header('Location: index.php');
                exit();
            } else {
                $error = "Email ou mot de passe incorrect.";
                include 'views/login.php';
            }
    
        }  
    }    
    public function logout() {
        session_start();
        session_destroy();
        header('Location: login.php');
        exit();
    }      
}


?>