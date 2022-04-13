<?php
    namespace App\Controllers;
    use Core\Controller;
    use Core\Router;
    use Core\Session;
    use App\Models\Login;

    
    class AuthController extends Controller {
        
        public function __construct($controller, $action){
            parent::__construct($controller, $action);
            $this->load_model('Users');
            
            //$this->view->setLayout('auth');
        }

        public function login(){

            if(Session::exists('isLoggedIn')){
                Router::redirect('dashboard');
            }
            
            $this->view->render('auth/login', [], 'auth');
        }

        public function loginAction(){

            if(Session::exists('isLoggedIn')){
                Router::redirect('dashboard');
            }

            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->UsersModel->login($username, $password);
            if(!$user){
                $response = [
                    'status' => 'error',
                    'message' => 'The user name and password combination you entered does not correspond to a registered user.'
                ];
                echo json_encode($response);
                return ;
            }

            $response = [
                'status' => 'success',
                'message' => 'Login successfully!'
            ];

            Session::set('userId', $user->id);
            Session::set('username', $user->username);
            Session::set('roleId', $user->role_id);
            Session::set('isLoggedIn', true);

            echo json_encode($response);
            
            
        }

        public function logout(){
            Session::delete('userId');
            Session::delete('username');
            Session::delete('roleId');
            Session::delete('isLoggedIn');
            Router::redirect('auth/login');
        }


    }