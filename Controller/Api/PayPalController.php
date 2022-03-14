<?php

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class PayPalController extends BaseController
{
        private $apiContext;
        private $client;

        public function __construct()
        {
                $this->apiContext = new \PayPal\Rest\ApiContext(
                        new \PayPal\Auth\OAuthTokenCredential(
                                PAYPAL_CLIENT_ID,     // ClientID
                                PAYPAL_CLIENT_SECRET      // ClientSecret
                        )
                );

                $this->client = new \GuzzleHttp\Client([
                        'timeout'  => 10,
                        'headers' => [
                                'Content-Type' => 'application/json',
                                'Authorization' => "Bearer " . PAYPAL_TOKEN,
                        ]
                ]);
        }

        public function createPaymentAction()
        {
                $this->isPOST();

                $data = $this->getPostData();

                if (!isset($data->order_id)) {
                        throw new Exception400("order_id is required");
                }

                $orderModel = new OrderModel();
                $order = $orderModel->getOne($data->order_id);

                $orderItemModel = new OrderItemModel();
                $items = $orderItemModel->getItemsOfOrder($order["id"]);

                $payer = new Payer();
                $payer->setPaymentMethod("paypal");

                $paymentItems = array_map(function ($item) {
                        $paymentItem = new Item();
                        $paymentItem->setName($item['name'])
                                // ->setCurrency('USD')
                                ->setQuantity($item['quantity'])
                                // ->setSku($item['product_id']) // Similar to `item_number` in Classic API
                                ->setPrice(number_format($item['price'] / 23000, 2, '.', ''));
                        return $paymentItem;
                }, $items);

                $itemList = new ItemList();
                $itemList->setItems($paymentItems);

                $details = new Details();
                $details->setShipping(number_format($order['shipping_fee'] / 23000, 2, '.', ''))
                        ->setTax(1.1)
                        ->setSubtotal(17.50);

                $amount = new Amount();
                $amount->setCurrency("USD")
                        ->setTotal(20);
                // ->setDetails($details);

                $transaction = new Transaction();
                $transaction->setAmount($amount)
                        ->setItemList($itemList)
                        ->setDescription("Payment description")
                        ->setInvoiceNumber(uniqid());

                $redirectUrls = new RedirectUrls();
                $redirectUrls->setReturnUrl("http://localhost/paypal-callback.php?order_id=" . $order["id"])
                        ->setCancelUrl("http://localhost/paypal-cancel-callback.php");

                $payment = new Payment();
                $payment->setIntent("sale")
                        ->setPayer($payer)
                        ->setRedirectUrls($redirectUrls)
                        ->setTransactions(array($transaction));

                try {
                        $payment->create($this->apiContext);
                } catch (Exception $ex) {
                        echo $payment, $ex;
                        throw new Exception("Cannot make Paypal payment!");
                }

                $approvalUrl = $payment->getApprovalLink();

                return ["redirect" => $approvalUrl];
        }

        public function createWebhookAction()
        {
        }

        public function testAction()
        {
                // Create a new instance of Webhook object
                $webhook = new \PayPal\Api\Webhook();

                $webhook->setUrl(DOMAIN_URL . "api.php/paypal/callback");
                // $webhook->setUrl('https://051c197a2c74ada9f51b3d87992438a4.m.pipedream.net');

                // # Event Types
                // Event types correspond to what kind of notifications you want to receive on the given URL.
                $webhookEventTypes = array();
                $webhookEventTypes[] = new \PayPal\Api\WebhookEventType(
                        '{
                                "name":"PAYMENT.CAPTURE.COMPLETED"
                        }'
                );
                $webhook->setEventTypes($webhookEventTypes);

                try {
                        $output = $webhook->create($this->apiContext);
                } catch (Exception $ex) {
                        // ^ Ignore workflow code segment
                        if ($ex instanceof \PayPal\Exception\PayPalConnectionException) {
                                $data = $ex->getData();
                                if (strpos($data, 'WEBHOOK_NUMBER_LIMIT_EXCEEDED') !== false) {
                                        $this->deleteAllWebhooksAction();

                                        try {
                                                $output = $webhook->create($this->apiContext);
                                        } catch (Exception $ex) {
                                                throw new Exception("ERROR!");
                                                exit(1);
                                        }
                                } else if (strpos($data, 'WEBHOOK_URL_ALREADY_EXISTS') !== false) {
                                        throw new Exception("Webhook url already exists!");
                                } else {
                                        echo $ex;
                                        throw new Exception("ERROR!");
                                }
                        } else {
                                throw new Exception("ERROR!");
                        }
                        // Print Success Result
                }

                return $output;
        }

        public function callbackAction()
        {
                $json = file_get_contents('php://input');
                $action = json_decode($json, true);

                try {
                        $orderLink = $action['resource']['links'][2]['href'];

                        $response = $this->client->request(
                                'GET',
                                $orderLink
                        );


                        $order = json_decode($response->getBody());

                        $file = 'payments.txt';
                        file_put_contents($file, json_encode($order) . "\r\n", FILE_APPEND | LOCK_EX);

                        $orderModel = new OrderModel();

                        return $orderModel->setStatusPaid((object)[
                                'payment_id' => $order->purchase_units[0]->payments->captures[0]->id,
                                'payer_id' => $order->payer->payer_id,
                                'paypal_order_id' => $order->id
                        ]);
                } catch (Exception $ex) {
                        $file = 'payments-errors.txt';
                        file_put_contents($file, $ex->getMessage() . "\r\n", FILE_APPEND | LOCK_EX);
                }

                return true;
        }

        public function listWebhooksAction()
        {
                try {
                        $output = \PayPal\Api\Webhook::getAll($this->apiContext);
                } catch (Exception $ex) {
                        throw new Exception("ERROR!");
                }

                return json_decode($output)->webhooks;
        }

        public function deleteAllWebhooksAction()
        {
                try {
                        $webhooks = \PayPal\Api\Webhook::getAll($this->apiContext)->webhooks;
                } catch (Exception $ex) {
                        throw new Exception("ERROR!");
                }

                try {
                        foreach ($webhooks as $webhook) {
                                $webhook->delete($this->apiContext);
                        }
                } catch (Exception $ex) {
                        throw new Exception("ERROR!");
                        exit(1);
                }

                return true;
        }
}
