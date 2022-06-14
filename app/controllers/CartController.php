<?php

namespace App\Controllers;

use Core\Controller;
use Core\Router;
use Core\Session;

require __DIR__  . '/../libraries/PayPal-PHP-SDK/autoload.php';

class CartController extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
        $this->load_model('Orders');
    }

    public function index()
    {
        $products = Session::exists('products') ? Session::get('products') : [];
        if (count($products) < 1) Router::redirect('');
        $data['products'] = $products;
        $totalQuantity = 0;
        foreach ($products as $product) {
            $totalQuantity += intval($product['productQuantity']);
        }
        $data['totalQuantity'] = $totalQuantity;
        $this->view->render('cart/index', $data);
    }

    public function save_order()
    {
        $buyerInfo = $_POST;
        $products = Session::get('products');
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                PAYPAL_CLIENT_ID,     // ClientID
                PAYPAL_CLIENT_SECRET_CODE      // ClientSecret
            )
        );

        $orderIds = [];
        $productItems = [];
        $totalAmount = 0;
        $orderSoldout = false;

        foreach ($products as $product) {
            $totalAmount += floatval($product['productAmount']);
            $insertData = [
                'name' => $buyerInfo['name'],
                'surname' => $buyerInfo['surname'],
                'email' => $buyerInfo['email'],
                'address' => $buyerInfo['address'],
                'city' => $buyerInfo['city'],
                'country'  => $buyerInfo['country'],
                'zip_code' => $buyerInfo['zip_code'],
                'payment_method' => 'paypal',
                'amount' => $product['productAmount'],
                'quantity' => $product['productQuantity'],
                'paid' => 0,
                'product_id' => $product['id'],
            ];


            $item = new \PayPal\Api\Item();
            $item->setName($product['productName'])
            ->setCurrency('USD')
            ->setQuantity(intval($product['productQuantity']))
            ->setSku(strval($product['id'])) // Similar to `item_number` in Classic API
            ->setPrice(floatval($product['productPrice']));

            $productItems[] = $item;

            $orderId = $this->OrdersModel->saveOrder($insertData);

            if($orderId == 0) {
                $orderSoldout = true;
                break;
            }

            $orderIds[] = $orderId;

            
        }

        if($orderSoldout) {
            unset($_SESSION['products']);

            if(count($orderIds) > 0) $this->OrdersModel->multipleOrdersDelete($orderIds);

            $response = [
                'status' => 0,
                'message' => 'Something went wrong! Please try again later.'
            ];
            echo json_encode($response);
            return ;
        }



        $payer = new \PayPal\Api\Payer();

        $payer->setPaymentMethod('paypal');



        $itemList = new \PayPal\Api\ItemList();
        $itemList->setItems($productItems);

        /*
        $details = new \PayPal\Api\Details();
        $details->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(17.50);

        */

        $amount = new \PayPal\Api\Amount();
        $amount->setCurrency("USD")
            ->setTotal($totalAmount);
        //    ->setDetails($details);

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(BASE_URL . "payment/exchange_payment")
                ->setCancelUrl(BASE_URL . "ecommerce/payment/error");
    

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

            try {
                $payment->create($apiContext);
                //echo $payment;

                $response = [
                    'status' => 1,
                    'paypalLink' => $payment->getApprovalLink()
                ];

                $this->OrdersModel->updateTransactionId($orderIds, $payment->getId());
            
                echo json_encode($response);
            }
            catch (\PayPal\Exception\PayPalConnectionException $ex) {
                // This will print the detailed information on the exception.
                //REALLY HELPFUL FOR DEBUGGING
                echo $ex->getData();
            }
    }
}
