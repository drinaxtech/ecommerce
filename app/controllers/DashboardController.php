<?php
    namespace App\Controllers;
    use Core\Controller;
    use Core\Router;
    use Core\Session;
    use App\Models\Users;
    //use App\Models\Login;

    
    class DashboardController extends Controller {
        
        public function __construct($controller, $action){
            parent::__construct($controller, $action);
            $this->load_model('Users');
            $this->load_model('Orders');
            $this->load_model('Products');
            $this->load_model('Categories');
            $this->view->setLayout('dashboard');
            if(!Session::exists('isLoggedIn')){
                Router::redirect('auth/login');
            }
        }

        public function index()
        {
            $data['totalOrders'] = $this->OrdersModel->getTotalOrders();
            $data['totalOrdersAmount'] = $this->OrdersModel->getOrdersTotalAmount();
            
            $data['currentUrl'] = 'dashboard';
            $this->view->render('dashboard/index', $data, 'dashboard');
        }

        public function products()
        {
            $products = [];
            if(Session::get('roleId') == '1'){
                $products = $this->ProductsModel->getAllProducts();
            }

            $data['products'] = $products;
            $data['categories'] = $this->CategoriesModel->getAllCategories();
            $data['currentUrl'] = 'products';
            $this->view->render('dashboard/products', $data, 'dashboard');
        }

        public function categories()
        {
            $data['categories'] = $this->CategoriesModel->getAllCategories();
            $data['currentUrl'] = 'categories';
            $this->view->render('dashboard/categories', $data, 'dashboard');

        }

        public function orders()
        {
            $data['currentUrl'] = 'orders';
            $this->view->render('dashboard/orders', $data, 'dashboard');

        }

        public function get_products()
        {
            $products = $this->ProductsModel->getAllProducts();
            echo json_encode($products);

        }

        public function get_categories()
        {
            $categories = $this->CategoriesModel->getAllCategories();
            echo json_encode($categories);
        }

        public function get_orders()
        {
            $orders = $this->OrdersModel->getOrders();
            echo json_encode($orders);
        }

        public function add_product()
        {
            $data = $_POST;
            $destinationpath = realpath(__DIR__ . '/../../assets/images/products');
            $path = $_FILES['image']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $newFilename = md5(uniqid(rand(), true)) . '.' . $ext;
            
            $moveImage = $destinationpath . '/' . $newFilename;

            if(move_uploaded_file($_FILES['image']['tmp_name'], $moveImage)) {

                $insertData = [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'quantity' => $data['quantity'],
                    'image' => $newFilename,
                    'category_id' => $data['category_id']
                ];

                $lastId = $this->ProductsModel->saveProduct($insertData);

                if($lastId !== null){
                    $insertData['id'] = $lastId;
                    $response = [
                        'status' => 'success',
                        'message' => 'Product is saved successfully!'
                    ];
    
                    echo json_encode($response);
                    return ;
                }
                
                
            } 


            $response = [
                'status' => 'error',
                'message' => 'Something went wrong!'
            ];

            echo json_encode($response);
            return ;

        }

        public function update_product()
        {
            $data = $_POST;
            $product_id = $data['id'];

            if(!isset($data['img_changed'])){
                $updateData = [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'quantity' => $data['quantity'],
                    'category_id' => $data['category_id']
                ];

                $update = $this->ProductsModel->updateProduct($product_id, $updateData);

                if($update){
                    $response = [
                        'status' => 'success',
                        'message' => 'Product is updated successfully!'
                    ];
    
                    echo json_encode($response);
                    return ;
                }

                $response = [
                    'status' => 'error',
                    'message' => 'Something went wrong!'
                ];
    
                echo json_encode($response);
                return ;

            }
            $destinationpath = realpath(__DIR__ . '/../../assets/images/products');
            $path = $_FILES['image']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $newFilename = md5(uniqid(rand(), true)) . '.' . $ext;
            
            $moveImage = $destinationpath . '/' . $newFilename;

            if(move_uploaded_file($_FILES['image']['tmp_name'], $moveImage)) {

                $updateData = [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'quantity' => $data['quantity'],
                    'image' => $newFilename,
                    'category_id' => $data['category_id']
                ];

                $update = $this->ProductsModel->updateProduct($product_id, $updateData);

                if($update !== null){
                    $response = [
                        'status' => 'success',
                        'message' => 'Product is updated successfully!'
                    ];
    
                    echo json_encode($response);
                    return ;
                }
                
                
            } 


            $response = [
                'status' => 'error',
                'message' => 'Something went wrong!'
            ];

            echo json_encode($response);
            return ;

        }

        public function save_category()
        {
            $insertData = [
                'name' => $_POST['name'],
                'user_id' => Session::get('userId')
            ];
            

            if($this->CategoriesModel->saveCategory($insertData)){
                $response = [
                    'status' => 'success',
                    'message' => 'Category is saved successfully!'
                ];

                echo json_encode($response);
                return ;
            }

            $response = [
                'status' => 'error',
                'message' => 'Something went wrong!'
            ];

            echo json_encode($response);
            return ;

        }

        public function update_category()
        {
            $id = $_POST['id'];
            $updateData = [
                'name' => $_POST['name'],
            ];

            if($this->CategoriesModel->updateCategory($id, $updateData)){
                $response = [
                    'status' => 'success',
                    'message' => 'Category is updated successfully!'
                ];

                echo json_encode($response);
                return ;
            }

            $response = [
                'status' => 'error',
                'message' => 'Something went wrong!'
            ];

            echo json_encode($response);
            return ;

        }

        public function delete_product()
        {
            $id = $_POST['id'];
            $this->ProductsModel->deleteProduct($id);
            return true;
        }

        public function delete_category()
        {
            $id = $_POST['id'];
            $this->CategoriesModel->deleteCategory($id);
            return true;
        }


    }