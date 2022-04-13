<?php

    namespace App\Controllers;
    use Core\Controller;
    use Core\Session;
    use Core\Router;
    use App\Models\Products;

    class ProductController extends Controller {

        public function __construct($controller, $action){
            parent::__construct($controller, $action);
            $this->load_model('Products');
            $this->load_model('Categories');
        }

        public function index() {
            //$sql = "SELECT * FROM test";
            //$results = $db->query($sql);
            $products = $this->ProductsModel->getAllProducts();
            $data['categories'] = $this->CategoriesModel->getAllCategories();
            $data['products'] = $products;

            $this->view->render('products/index', $data);
        }

        public function item($productId = false) {
            if(!$productId) Router::redirect('');
            $product = $this->ProductsModel->getProduct($productId);
            if(!$product) Router::redirect('');
            $data['product'] = $product;
            $this->view->render('products/product', $data);
        }

        public function add_to_basket() {
            $products = Session::exists('products') ? Session::get('products') : [];
            $productId = $_POST['id'];
            $productName = $_POST['name'];
            $productQuantity = $_POST['quantity'];
            $productPrice = $_POST['price'];

            $productAmount = intval($productQuantity) * floatval($productPrice);

            unset($products[$productId]);
            
            $products[$productId] = [
                'id' => $productId,
                'productName' => $productName,
                'productQuantity' => $productQuantity,
                'productPrice' => $productPrice,
                'productAmount' => $productAmount
            ];

            $basketQuantity = 0;
            foreach($products as $product){
                $basketQuantity += intval($product['productQuantity']);
            }

            Session::set('products', $products);

            echo $basketQuantity;


        }
    }