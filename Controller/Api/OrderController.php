<?php

// Order status:
// Pending
// Paid
// Delivering
// Delivered
// Cancel

class OrderController extends BaseController
{
        /**
         * "/user/list" Endpoint - Get list of users
         */
        public function listAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $orderModel = new OrderModel();
                ['offset' => $offset, 'limit' => $limit] = $this->getQueryParams();

                return $orderModel->getAll($offset, $limit);
        }

        public function countAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $orderModel = new OrderModel();

                return $orderModel->count();
        }

        public function getOneAction()
        {
                $this->isGET();

                $orderModel = new OrderModel();
                $id = $this->getIdParam();

                return $orderModel->getOne($id);
        }

        public function createAction()
        {
                $this->isPOST();
                $decodedToken = isLoggedIn();
                $data = $this->getPostData();

                if (!isset($data->shipping_fee)) {
                        throw new Exception400("shipping_fee is required.");
                }
                if (!isset($data->total_amount)) {
                        throw new Exception400("total_amount is required.");
                }
                if (!isset($data->quantity)) {
                        throw new Exception400("quantity is required.");
                }
                if (!isset($data->paypal_order_id)) {
                        throw new Exception400("paypal_order_id is required.");
                }

                $orderModel = new OrderModel();
                ["id" => $newOrderID] = $orderModel->create((object)[
                        "user_id" => $decodedToken->data->id,
                        "shipping_fee" => $data->shipping_fee,
                        "total_amount" => $data->total_amount,
                        "quantity" => $data->quantity,
                        "paypal_order_id" => $data->paypal_order_id
                ]);

                $cartController = new CartController();
                $cartItems = $cartController->getAllItems();

                $orderItemModel = new OrderItemModel();
                foreach ($cartItems as &$item) {
                        $orderItemModel->create((object)[
                                'quantity' => $item["quantity"],
                                'name' => $item["name"],
                                'price' => $item["price"],
                                'product_id' => $item["id"],
                                'order_id' => $newOrderID
                        ]);
                }

                return ["id" => $newOrderID];
        }

        // public function updateAction()
        // {
        //         $this->isPUT();
        //         isAdmin();

        //         $orderModel = new OrderModel();

        //         $id = $this->getIdParam();
        //         $data = $this->getPostData();

        //         // TODO: Validate inputs 

        //         return $orderModel->update($id, $data);
        // }

        public function deleteAction()
        {
                $this->isDELETE();
                isAdmin();

                $orderModel = new OrderModel();
                $id = $this->getIdParam();

                return $orderModel->delete($id);
        }
}
