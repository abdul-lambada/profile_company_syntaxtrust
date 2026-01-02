<?php
class Login extends Controller {
    private $userModel;

    public function __construct(){
        $this->userModel = $this->model('UserModel');
    }

    public function index(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => ''
            ];

            // Validate Username
            if(empty($data['username'])){
                $data['username_err'] = 'Silakan masukkan username';
            }

            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Silakan masukkan password';
            }

            // Check if errors are empty
            if(empty($data['username_err']) && empty($data['password_err'])){
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if($loggedInUser){
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password atau username salah';
                    $this->view('login/index', $data);
                }
            } else {
                // Load view with errors
                $this->view('login/index', $data);
            }

        } else {
            // Init data
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];

            // Load view
            $this->view('login/index', $data);
        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['user_name'] = $user->username; // Or real name if added later
        header('location: ' . URLROOT . '/dashboard');
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_username']);
        unset($_SESSION['user_name']);
        session_destroy();
        header('location: ' . URLROOT . '/login');
    }
}
