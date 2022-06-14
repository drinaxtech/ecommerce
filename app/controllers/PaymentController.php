<?php

    namespace App\Controllers;
    use Core\Controller;
    use Core\Session;
    use Core\Router;
    use App\Models\Transactions;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require __DIR__  . '/../libraries/PHPmailer/vendor/autoload.php';
    class PaymentController extends Controller {

        public function __construct($controller, $action){
            parent::__construct($controller, $action);
            $this->load_model('Transactions');
            $this->load_model('Orders');
        }

        public function index() {

            $data['categories'] = '';

            $this->view->render('payment/index', $data);
        }

        public function success() {

            $transactionId = $_GET['paymentId'];
            $data['totalAmount'] = $this->OrdersModel->getOrdersTotalAmount($transactionId);


            $this->view->render('payment/success', $data, 'landing_page');
        }

        public function error() {

            $data['categories'] = '';

            $this->view->render('payment/error', $data, 'landing_page');
        }

        public function exchange_payment() 
        {
            unset($_SESSION['products']);
            $transactionData = [
                'paymentId' => $_GET['paymentId'],
                'token' => $_GET['token'],
                'PayerID' => $_GET['PayerID']
            ];

            $this->TransactionsModel->saveTransaction($transactionData);
            $this->send_mail($transactionData['paymentId']);

            header("Location: " . BASE_URL . "payment/success?paymentId=" . $_GET['paymentId']);
            return ;
        }

        private function send_mail($transactionId) {
            $mail = new PHPMailer(true);

            $totalAmount = $this->OrdersModel->getOrdersTotalAmount($transactionId);
            $products = $this->OrdersModel->getOrdersInfo($transactionId);

            $mailContent = file_get_contents(__DIR__  . '/../views/email_template/index.php');

            ob_start();
            include(__DIR__  . '/../views/email_template/index.php');
            $mailContent  = ob_get_clean();

            try {
                $mail->isSMTP();
                $mail->Host       = MAIL_HOST;
                $mail->SMTPAuth   = true;
                $mail->Username   = MAIL_USERNAME;
                $mail->Password   = MAIL_PASSWORD;
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                
                //Recipients
                $mail->setFrom('support@bestautoparts.online', 'Ecommerce Shop');
                $mail->addAddress($products[0]->email);

                
                
                //Content
                $mail->isHTML(true); 
                $mail->Subject = 'Payment Confirmation _ drxshop';
                $mail->AddEmbeddedImage(__DIR__ . '/../../assets/images/logo.png', 'logoimg', 'logo.png');
                foreach($products as $product) {
                    $mail->AddEmbeddedImage(__DIR__ . '/../../assets/images/products/' . $product->productImage, strval($product->product_id), $product->productImage);
                }
                
                $mail->Body    = $mailContent;
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }

        public function testemail(){
            $test = 'PAYID-MKR5WMA7RM92184PE897281V';
            $this->send_mail($test);
        }

    }