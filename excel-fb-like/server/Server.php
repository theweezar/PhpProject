<?php

require(REQUEST);
require(RESPONSE);
/**
 * Server will handle all the requests coming
 */
class Server {
    /**
     * Route URL path function
     */
    public function route() {
        require(ROUTE);
        require(APP);
        $this->execute(Route::$routes);
    }

    /**
     * Construct new class and call it method
     */
    private function callController(array $callback, Request $req, Response $res) {
        $controllerName = $callback[0];
        $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
        $methodName = $callback[1];
        if (file_exists($controllerFile)) {
            $controller = new $controllerName;
            if (!method_exists($controller, $methodName)){
                $res->render('404.php');
            }
            else {
                try {
                    call_user_func_array(
                        [$controller, $methodName], 
                        [$req, $res]
                    );
                } catch (Exception $e) {
                    Response::json(array(
                        'error' => true,
                        'message' => $e->getMessage()
                    ));
                }
            }
        } else {
            $res->render('404.php');
        }
    }

    private function callFunction(object $callback, Request $req, Response $res) {
        call_user_func($callback, $req, $res);
    }

    /**
     * Start server
     */
    private function execute($routes) {
        $req = new Request();
        $res = new Response();
        if (isset($routes[URI])) {
            $route = $routes[URI];
            if (METHOD != $route['method']) {
                $res->render('404.php', array(
                    'statusCode' => 405,
                    'message' => 'Method not allowed'
                ));
            } else {
                $callback = $route['callback'];
                switch (gettype($callback)) {
                    case 'object':
                        $this->callFunction($callback, $req, $res);
                        break;
                    case 'array':
                        $this->callController($callback, $req, $res);
                        break;
                    default:
                        $res->render('404.php');
                        break;
                }
            }
        } else {
            $res->render('404.php', array(
                'statusCode' => 500,
                'message' => 'Route not found'
            ));
        }
    }
}