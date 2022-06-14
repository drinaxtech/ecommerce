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
            $query = $this->_db->query("SELECT {$this->table}.* FROM {$this->table} INNER JOIN products ON products.id = {$this->table}.product_id WHERE paid=1", []);
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

        public function getPaidOrders()
        {
            $query = $this->_db->query("SELECT {$this->table}.*, products.name as productName FROM {$this->table} INNER JOIN products ON products.id = {$this->table}.product_id WHERE paid=1", []);

            $orders = $query->results();

            return $orders;
        }


        public function saveOrder($data)
        {
            $lastInsertID = $this->_db->procedure("insertOrderData", $data);

            return $lastInsertID;
        }

        public function updateTransactionId($orderIds, $transactionId)
        {
            $ids = implode(',', $orderIds);
            $data = ['transactionId' => $transactionId];
            return $this->_db->update($this->table, $ids, $data, true);
        }

        public function getOrdersTotalAmount($transactionId = '')
        {
            $query = $this->_db->query("SELECT SUM({$this->table}.amount) as totalAmount FROM {$this->table} WHERE paid = ? GROUP BY transactionId", [1]);
            if($transactionId != '') {
                $query = $this->_db->query("SELECT SUM({$this->table}.amount) as totalAmount FROM {$this->table} WHERE transactionId = ? AND paid = ? GROUP BY transactionId", [$transactionId, 1]);
            }

            $order = $query->first_row();


            return $order->totalAmount;
        }

        public function getOrdersInfo($transactionId)
        {
            $query = $this->_db->query("SELECT {$this->table}.*, products.name as productName, products.image as productImage, price  FROM {$this->table} INNER JOIN products ON products.id = {$this->table}.product_id WHERE transactionId = ?", [$transactionId]);

            $orders = $query->results();

            return $orders;
        }

        public function getOrdersNumberByProductId()
        {
            $query = $this->_db->query("SELECT product_id, SUM(quantity) AS totalOrders  FROM {$this->table} WHERE paid = 1 OR DATE_ADD(order_time, INTERVAL 10 MINUTE) >= NOW() GROUP BY product_id", []);

            $results = $query->results();

            $orders = [];

            if(is_countable($results) && count($results) > 0) {
                foreach($results as $result) {
                    $productId = $result->product_id;
                    $orders[$productId] = intval($result->totalOrders);
                }
            }

            return $orders;
        }

        public function multipleOrdersDelete($orderIds)
        {
            $this->_db->multipleDelete($this->table, $orderIds);
            return true;
        }

    }