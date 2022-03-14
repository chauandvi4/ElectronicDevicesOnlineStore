<?php
session_start();

define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file
require_once PROJECT_ROOT_PATH . "/inc/config.php";

// include the base controller file
require_once PROJECT_ROOT_PATH . "/Controller/Api/BaseController.php";

// include the use model file
require_once PROJECT_ROOT_PATH . "/Model/UserModel.php";
require_once PROJECT_ROOT_PATH . "/Model/ProductModel.php";
require_once PROJECT_ROOT_PATH . "/Model/BlogModel.php";
require_once PROJECT_ROOT_PATH . "/Model/WishlistModel.php";
require_once PROJECT_ROOT_PATH . "/Model/CouponModel.php";
require_once PROJECT_ROOT_PATH . "/Model/OrderModel.php";
require_once PROJECT_ROOT_PATH . "/Model/OrderItemModel.php";
require_once PROJECT_ROOT_PATH . "/Model/CommentModel.php";
// TODO: import New Model here.

require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/ProductController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/BlogController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/CartController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/ShippingController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/WishlistController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/CouponController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/PayPalController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/OrderController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/CommentController.php";
// TODO: import new Controller here.

// include custom exceptions
require_once PROJECT_ROOT_PATH . "/utils/exceptions/Exception422.php";
require_once PROJECT_ROOT_PATH . "/utils/exceptions/Exception401.php";
require_once PROJECT_ROOT_PATH . "/utils/exceptions/Exception400.php";

// include functions
require_once PROJECT_ROOT_PATH . "/utils/functions.php";

// composer packages
require_once PROJECT_ROOT_PATH . "/vendor/autoload.php";

// class MyLogger
// {
//     const FILENAME = '/tmp/mylog.txt';

//     function Add($error)
//     {
//         file_put_contents(self::FILENAME, $error, FILE_APPEND);
//     }
// }
