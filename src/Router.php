<?php
namespace Project;

//use App\Controllers\UserController;
/** Class Router **/

class Router {

    private string $url;
    private array $routes = [];

    public function __construct(string $url){
        $this->url = $url;
    }

    public function get(string $path, string $callable): Route {
        $route = new Route($path, $callable);
        $this->routes["GET"][] = $route;
        return $route;
    }

    public function post(string $path, string $callable): Route {
        $route = new Route($path, $callable);
        $this->routes["POST"][] = $route;
        return $route;
    }

    public function run() {
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new \Exception('REQUEST_METHOD does not exist');
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($this->url)){
                return $route->call();
            }
        }
        // throw new \Exception('No matching routes');
        echo json_encode(["status" => 404]);
    }

}
