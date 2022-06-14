<?php
    namespace App\Models;
    use Core\Model;
    //use App\Models\Users;

    class Transactions extends Model {

        private $table = "Transactions";
        public function __construct()
        {
            parent::__construct($this->table);
        }

        public function saveTransaction($data)
        {
            $lastInsertID = $this->_db->insert($this->table, $data);
            return $lastInsertID;
        }


    }