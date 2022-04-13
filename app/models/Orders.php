<?php
    namespace App\Models;
    use Core\Model;
    //use App\Models\Users;

    class Orders extends Model {

        private $table = "Orders";
        public function __construct()
        {
            parent::__construct($this->table);
        }

        public function getTotalOrders()
        {
            $query = $this->_db->query("SELECT {$this->table}.* FROM {$this->table} INNER JOIN products ON products.id = {$this->table}.product_id", []);
            if($query->num_rows() < 1){
                return 0;
            }

            $orders = count($query->results());

            return $orders;
        }

        public function getOrders()
        {
            $query = $this->_db->query("SELECT {$this->table}.*, products.name as productName FROM {$this->table} INNER JOIN products ON products.id = {$this->table}.product_id", []);

            $orders = $query->results();

            return $orders;
        }

        public function saveOrder($data)
        {
            $lastInsertID = $this->_db->insert($this->table, $data);
            return $lastInsertID;
        }


    }