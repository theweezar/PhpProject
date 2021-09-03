<?php
require(SESSION);
require(URL);
require(REQUEST);
require(RESPONSE);
require(NEXT);
require(DATABASE);
require(LAYOUT);
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
                throw new Exception("Controller not found", 500);
            }
            else {
                try {
                    call_user_func_array(
                        [$controller, $methodName],
                        [$req, $res]
                    );
                } catch (Exception $e) {
                    throw new Exception($e->getMessage(), 500);
                }
            }
        } else {
            throw new Exception("Controller not found", 500);
        }
    }

    /**
     * Call a function stored in route
     */
    private function callFunction(object $callback, Request $req, Response $res) {
        call_user_func($callback, $req, $res);
    }

    /**
     * Parse URL, remove everthing after character '?'
     */
    private function parseUrl() {
        if (strpos(URI, '?')) {
            $url = explode('?', filter_var(URI, FILTER_SANITIZE_URL));
            return $url[0];
        }
        return URI;
    }

    /**
     * Start server
     */
    private function execute(array $routes) {
        $req = new Request();
        $res = new Response();
        $uri = METHOD.$this->parseUrl();
        if (isset($routes[$uri])) {
            $route = $routes[$uri];
            // Check request method if it is valid
            if (METHOD == $route['method']) {
                $chains = $route['chains'];
                if (gettype($chains) == 'array') {
                    $chainLength = count($chains) - 1;
                    // Stored last chain in new variable $lastCall
                    $lastCall = $chains[$chainLength];
                    // Remove the last callback in chains
                    unset($chains[$chainLength]);
                    $next = new Next($req, $res, $chains);
                    if ($next->done()) {
                        switch (gettype($lastCall)) {
                            case 'object':
                                $this->callFunction($lastCall, $req, $res);
                                break;
                            case 'array':
                                $this->callController($lastCall, $req, $res);
                                break;
                            default:
                                $res->render('error.php');
                                break;
                        }
                    } else {
                        throw new Exception("Middleware process if not completed", 500);
                    }
                }
            } else {
                throw new Exception("Method not allowed", 405);
            }
        } else {
            throw new Exception("Page not found", 404);
        }
    }
}