<?php
    namespace App\Models;
    use Core\Model;
    //use App\Models\Users;

    class Users extends Model {

        public function __construct()
        {
            $table = "Users";
            parent::__construct($table);
        }

        public function login($username, $password)
        {
            $param = (!filter_var($username, FILTER_VALIDATE_EMAIL)) ? 'username' : 'email';
            $query = $this->_db->query("SELECT * FROM users WHERE {$param} = ?", [$username]);
            if($query->num_rows() < 1){
                return false;
            }
            $user = $query->first_row();
            if (password_verify($password, $user->password)) {
                return $user;
            }

            return false;
        }

    }