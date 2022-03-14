<?php
require __DIR__ . "/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
if (!isset($uri[2]) || !isset($uri[3])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$controller = dashesToCamelCase($uri[2], true) . "Controller";

if (class_exists($controller)) {
    try {
        try {
            $objFeedController = new $controller();
            $strMethodName = dashesToCamelCase($uri[3]) . 'Action';
            $data = $objFeedController->{$strMethodName}();
            // var_dump("api");
            // var_dump($data);

            sendOutputOk(json_encode($data));
        } catch (PDOException $e) {
            // handle PDO errors
            if ($e->errorInfo[1] == 1062) {
                throw new Exception400(explode("key ", $e->getMessage())[1] . " is already taken");
            }
        }
    } catch (Exception400 $e) {
        sendOutput(
            json_encode(array('error' => $e->getMessage())),
            $e->get_headers()
        );
    } catch (Exception401 $e) {
        sendOutput(
            json_encode(array('error' => $e->getMessage())),
            $e->get_headers()
        );
    } catch (Exception422 $e) {
        sendOutput(
            json_encode(array('error' => $e->getMessage())),
            $e->get_headers()
        );
    } catch (Exception $e) {
        $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';

        sendOutput(
            json_encode(array('error' => $strErrorDesc)),
            array('Content-Type: application/json', $strErrorHeader)
        );
    }
} else {
    header("HTTP/1.1 404 Not Found");
    exit();
}
