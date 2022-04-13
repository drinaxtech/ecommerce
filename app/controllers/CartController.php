<?php
    namespace App\Controllers;
    use Core\Controller;
    use Core\Router;
    use Core\Session;

    
    class CartController extends Controller {
        
        public function __construct($controller, $action){
            parent::__construct($controller, $action);
            $this->view->setLayout('default');
            $this->load_model('Orders');
        }

        public function index()
        {
            $products = Session::exists('products') ? Session::get('products') : [];
            if(count($products) < 1) Router::redirect('');
            $data['products'] = $products;
            $totalQuantity = 0;
            foreach($products as $product){
                $totalQuantity += intval($product['productQuantity']);
            }
            $data['totalQuantity'] = $totalQuantity;
            $this->view->render('cart/index', $data);
        }

        public function save_order()
        {
            $buyerInfo = $_POST;
            $products = Session::get('products');
            var_dump($products);
            $orderIds = [];

            foreach($products as $product) {
                $insertData = [
                    'name' => $buyerInfo['name'],
                    'surname' => $buyerInfo['surname'],
                    'email' => $buyerInfo['email'],
                    'address' => $buyerInfo['address'],
                    'city' => $buyerInfo['city'],
                    'country'  => $buyerInfo['country'],
                    'zip_code' => $buyerInfo['zip_code'],
                    'payment_method' => 'paypal',
                    'quantity' => $product['productQuantity'],
                    'paid' => 2,
                    'product_id' => $product['id']
                ];
                $orderIds[] = $this->OrdersModel->saveOrder($insertData);
            }

            var_dump($orderIds);

        }


    }