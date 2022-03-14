<?php
class BaseController
{
    /**
     * __call magic method.
     */
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }

    /**
     * Get URI elements.
     * 
     * @return array
     */
    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);

        return $uri;
    }

    protected function getPostData()
    {
        $data = json_decode(file_get_contents("php://input"));
        // var_dump("get post data");
        // var_dump($data);
        return $data;
    }

    protected function getIdParam()
    {
        $intId = -1;
        if (!empty($_GET['id'])) {
            $intId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (false === $intId) {
                $intId = -1;
            }
        }
        return $intId;
    }

    protected function getIntQueryParam($name)
    {
        // if (!empty($_GET[$name])) {
        return filter_input(INPUT_GET, $name, FILTER_VALIDATE_INT);
        // }

        // return null;
    }

    protected function getStringQueryParam($name)
    {
        $value = null;
        if (!empty($_GET[$name])) {
            $value = filter_input(INPUT_GET, $name, FILTER_SANITIZE_SPECIAL_CHARS);
            if (false === $value ||  $value == "undefined") {
                $value = null;
            }
        }

        return $value;
    }

    /**
     * Get query params.
     * 
     * @return array
     */
    protected function getQueryParams()
    {
        $intLimit = DEFAULT_PAGE_SIZE;
        if (!empty($_GET['limit'])) {
            $intLimit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
            if (false === $intLimit) {
                $intLimit = DEFAULT_PAGE_SIZE;
            }
        }

        $page = DEFAULT_PAGE;
        if (!empty($_GET['page'])) {
            $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
            if (false === $page) {
                $page = DEFAULT_PAGE;
            }
        }

        $offset = ($page - 1) * $intLimit;

        $priceFrom = null;
        if (!empty($_GET['priceFrom'])) {
            $priceFrom = filter_input(INPUT_GET, 'priceFrom', FILTER_VALIDATE_INT);
            if (false === $priceFrom && $priceFrom !== 0) {
                $priceFrom = null;
            }
        }

        $priceTo = null;
        if (!empty($_GET['priceTo'])) {
            $priceTo = filter_input(INPUT_GET, 'priceTo', FILTER_VALIDATE_INT);
            if (false === $priceTo) {
                $priceTo = null;
            }
        }

        $category = null;
        if (!empty($_GET['category'])) {
            $category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
            if (false === $category ||  $category == "undefined") {
                $category = null;
            }
        }

        $userId = null;
        if (!empty($_GET['user_id'])) {
            $userId = filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_SPECIAL_CHARS);
            if (false === $userId) {
                $category = null;
            }
        }

        $productId = null;
        if (!empty($_GET['product_id'])) {
            $productId = filter_input(INPUT_GET, 'product_id', FILTER_SANITIZE_SPECIAL_CHARS);
            if (false === $productId) {
                $productId = null;
            }
        }

        $name = null;
        if (!empty($_GET['name'])) {
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            if (false === $name ||  $name == "undefined") {
                $name = null;
            }
        }

        return [
            "offset" => $offset,
            "limit" => $intLimit,
            "priceFrom" => $priceFrom,
            "priceTo" => $priceTo,
            "category" => $category,
            "userId" => $userId,
            "productId" => $productId,
            "name" => $name,
         
        ];
    }


       /**
     * Get blog query params.
     * 
     * @return array
     */
    protected function getBlogQueryParams()
    {
        $intLimit = DEFAULT_PAGE_SIZE;
        if (!empty($_GET['limit'])) {
            $intLimit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
            if (false === $intLimit) {
                $intLimit = DEFAULT_PAGE_SIZE;
            }
        }

        $page = DEFAULT_PAGE;
        if (!empty($_GET['page'])) {
            $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
            if (false === $page) {
                $page = DEFAULT_PAGE;
            }
        }

        $offset = ($page - 1) * $intLimit;

        $title = null;
        if (!empty($_GET['title'])) {
            $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            if (false === $title ||  $title == "undefined") {
                $title = null;
            }
        }

        $topic_id = null;
        if (!empty($_GET['topic_id'])) {
            $topic_id = filter_input(INPUT_GET, 'topic_id', FILTER_SANITIZE_SPECIAL_CHARS);
            if (false === $topic_id ||  $topic_id == "undefined") {
                $topic_id = null;
            }
        }
        // var_dump("base controller");
        // var_dump("title");
        // var_dump($title);
        // var_dump("topic_id");
        // var_dump($topic_id);
        
        return [
            "offset" => $offset,
            "limit" => $intLimit,
            "title" => $title,
            "topic_id"=>$topic_id
        ];
    }

    /**
     * check if REQUEST_METHOD == 'GET'
     * 
     * @return boolean
     */
    protected function isGET()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (!(strtoupper($requestMethod) == 'GET')) {
            throw new Exception422();
        }
    }

    /**
     * check if REQUEST_METHOD == 'POST'
     * 
     * @return boolean
     */
    protected function isPOST()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (!(strtoupper($requestMethod) == 'POST')) {
            throw new Exception422();
        }
    }

    /**
     * check if REQUEST_METHOD == 'PUT'
     * 
     * @return boolean
     */
    protected function isPUT()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (!(strtoupper($requestMethod) == 'PUT')) {
            throw new Exception422();
        }
    }

    /**
     * check if REQUEST_METHOD == 'DELETE'
     * 
     * @return boolean
     */
    protected function isDELETE()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (!(strtoupper($requestMethod) == 'DELETE')) {
            throw new Exception422();
        }
    }
}
