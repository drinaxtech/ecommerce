<?php
    namespace App\Models;
    use Core\Model;
    //use App\Models\Users;

    class Products extends Model {

        private $table = "Products";
        public function __construct()
        {
            parent::__construct($this->table);
        }

        public function getAllProducts()
        {
            $query = $this->_db->query("SELECT *, products.id AS product_id, products.name AS product_name, categories.name AS category_name
            FROM products INNER JOIN categories ON products.category_id = categories.id", []);
            if($query->num_rows() < 1){
                return [];
            }

            $products = $query->results();

            return $products;
        }

        public function getProduct($id)
        {
            $query = $this->_db->query("SELECT *, products.id AS product_id, products.name AS product_name FROM products
             INNER JOIN categories ON products.category_id = categories.id WHERE products.id = ?", [$id]);
            if($query->num_rows() < 1){
                return false;
            }

            $product = $query->first_row();

            return $product;
        }

        public function saveProduct($data)
        {
            $lastInsertID = $this->_db->insert($this->table, $data);
            

            return $lastInsertID;
        }

        public function updateProduct($id, $data)
        {
            return $this->_db->update($this->table, $id, $data);
        }
        
        public function deleteProduct($id)
        {
            $query = $this->_db->delete($this->table, $id);

            return true;
        }


    }