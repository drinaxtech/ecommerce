<?php
    namespace App\Models;
    use Core\Model;
    //use App\Models\Users;

    class Categories extends Model {

        private $table = "Categories";
        public function __construct()
        {
            
            parent::__construct($this->table);
        }

        public function getAllCategories()
        {
            $query = $this->_db->query("SELECT * FROM categories", []);
            if($query->num_rows() < 1){
                return [];
            }

            $products = $query->results();

            return $products;
        }

        public function saveCategory($data)
        {
            $query = $this->_db->insert($this->table, $data);
            

            return true;
        }

        public function updateCategory($id, $data)
        {
            return $this->_db->update($this->table, $id, $data);
        }

        public function deleteCategory($id)
        {
            $query = $this->_db->delete($this->table, $id);

            return true;
        }



    }