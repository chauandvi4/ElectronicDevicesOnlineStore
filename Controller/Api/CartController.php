<?php
class CartController extends BaseController
{
        public function listAction()
        {
                $this->isGET();

                return $this->getAllItems();
        }

        public function clearCartAction()
        {
                $this->isPOST();

                unset($_SESSION['cart']);

                return true;
        }

        public function addAction()
        {
                $this->isPOST();

                // If the user clicked the add to cart button on the product page we can check for the form data
                $data = $this->getPostData();
                if (isset($data->product_id, $data->quantity) && is_numeric($data->quantity) && is_numeric($data->quantity)) {
                        // Set the post variables so we easily identify them, also make sure they are integer
                        $product_id = (int)$data->product_id;
                        $quantity = (int)$data->quantity;

                        $productModel = new ProductModel();
                        $product = $productModel->getOne($product_id);

                        // Check if the product exists (array is not empty)
                        if ($product) {
                                // Product exists in database, now we can create/update the session variable for the cart
                                if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                                        if (array_key_exists($product_id, $_SESSION['cart'])) {
                                                // Product exists in cart so just update the quanity
                                                // var_dump($quantity);
                                                $_SESSION['cart'][$product_id] += $quantity;
                                        } else {
                                                // Product is not in cart so add it
                                                $_SESSION['cart'][$product_id] = $quantity;
                                        }

                                        if ($_SESSION['cart'][$product_id] == 0) {
                                                unset($_SESSION['cart'][$product_id]);
                                        }
                                } else {
                                        // There are no products in cart, this will add the first product to cart
                                        $_SESSION['cart'] = array($product_id => $quantity);
                                }
                        }

                        return true;
                }

                return false;
        }

        public function getAllItems()
        {
                // Check the session variable for products in cart
                $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

                // If there are products in cart
                if ($products_in_cart) {
                        $productModel = new ProductModel();
                        $products = $productModel->getManyIds(array_keys($products_in_cart));

                        foreach ($products as $key => $product) {
                                $products[$key]['quantity'] = $products_in_cart[$product['id']];
                        }

                        return $products;
                }

                return [];
        }
}
