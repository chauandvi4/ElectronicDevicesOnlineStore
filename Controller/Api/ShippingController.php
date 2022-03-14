<?php

use GuzzleHttp\Client;
use PayPal\Api\Order;

class ShippingController extends BaseController
{
        private $client;

        public function __construct()
        {
                $this->client = new Client([
                        'base_uri' => 'https://dev-online-gateway.ghn.vn/',
                        'timeout'  => 10,
                        'headers' => [
                                'Content-Type' => 'application/json',
                                'Token' => GHN_TOKEN,
                                // 'ShopId' => GHN_SHOP_ID,
                        ]
                ]);
        }

        public function listProvinceAction()
        {
                $this->isGET();

                $response = $this->client->request(
                        'GET',
                        '/shiip/public-api/master-data/province',
                );

                return json_decode($response->getBody());
        }

        public function listDistrictAction()
        {
                $this->isGET();

                $province_id = filter_input(INPUT_GET, "province_id", FILTER_VALIDATE_INT);

                if (!isset($province_id)) {
                        throw new Exception400("Please provide province_id params");
                }

                $response = $this->client->request(
                        'GET',
                        '/shiip/public-api/master-data/district',
                        ['query' => ['province_id' => $province_id]]
                );

                return json_decode($response->getBody());
        }

        public function listWardAction()
        {
                $this->isGET();

                $district_id = filter_input(INPUT_GET, "district_id", FILTER_VALIDATE_INT);

                if (!isset($district_id)) {
                        throw new Exception400("Please provide district_id params");
                }

                $response = $this->client->request(
                        'GET',
                        '/shiip/public-api/master-data/ward',
                        ['query' => ['district_id' => $district_id]]
                );

                return json_decode($response->getBody());
        }

        public function getServiceAction()
        {
                $this->isGET();

                $to_district_id = filter_input(INPUT_GET, "to_district_id", FILTER_VALIDATE_INT);
                if (!isset($to_district_id)) {
                        throw new Exception400("Please provide to_district_id params");
                }

                $data = array(
                        "shop_id" => GHN_SHOP_ID,
                        "from_district" => GHN_SHOP_DISTRICT_ID,
                        "to_district" => $to_district_id
                );

                $response = $this->client->request(
                        'POST',
                        '/shiip/public-api/v2/shipping-order/available-services',
                        [
                                'json' => $data
                        ],
                );

                return json_decode($response->getBody());
        }

        public function calculateFeeAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $to_district_id = filter_input(INPUT_GET, "to_district_id", FILTER_VALIDATE_INT);
                if (!isset($to_district_id)) {
                        throw new Exception400("Please provide to_district_id params");
                }

                $to_ward_code = filter_input(INPUT_GET, "to_ward_code", FILTER_SANITIZE_SPECIAL_CHARS);
                if (!isset($to_ward_code)) {
                        throw new Exception400("Please provide to_ward_code params");
                }

                $service_id = filter_input(INPUT_GET, "service_id", FILTER_VALIDATE_INT);
                if (!isset($service_id)) {
                        throw new Exception400("Please provide service_id params");
                }

                $data = array(
                        "from_district_id" => GHN_SHOP_DISTRICT_ID,
                        "service_id" => $service_id,
                        "to_district_id" => $to_district_id,
                        "to_ward_code" => $to_ward_code,
                        "height" => 50,
                        "length" => 20,
                        "weight" => 1000,
                        "width" => 20,
                        "insurance_value" => 10000
                );

                $response = $this->client->request(
                        'POST',
                        '/shiip/public-api/v2/shipping-order/fee',
                        [
                                'json' => $data
                        ],
                );

                return json_decode($response->getBody());
        }

        public function createOrderAction()
        {
                $this->isPOST();

                $input = $this->getPostData();

                if (!isset($input->order_id)) {
                        throw new Exception400("Please provide order_id params");
                }

                $data = array(
                        "to_name" => "Duong Quang Tuan",
                        "to_phone" => "0944304773",
                        "to_address" => "85 Nguyễn Ái Quốc, Phường Tân Biên, TP. Biên Hòa, Đồng Nai",
                        "to_ward_code" => '480113',
                        "to_district_id" => 1536,
                        "weight" => 1000,
                        "length" => 20,
                        "width" => 20,
                        "height" => 50,
                        "service_type_id" => 1,
                        "service_id" => 53320,
                        "payment_type_id" => 2,
                        "required_note" => 'CHOXEMHANGKHONGTHU',
                        "items" => [0 => [
                                'name' => 'iPad Pro M1 12.9 inch WiFi + Cellular',
                                'quantity' => 1
                        ]],
                );

                $response = $this->client->request(
                        'POST',
                        '/shiip/public-api/v2/shipping-order/create',
                        [
                                'json' => $data
                        ],
                );

                $shippingData = json_decode($response->getBody());

                $orderModel = new OrderModel();
                $orderModel->setStatusShipping((object)['id' => $input->order_id, 'shipping_id' => $shippingData->data->order_code]);

                return $shippingData;
        }
}
