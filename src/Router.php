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

    public function put(string $path, string $callable): Route {
        $route = new Route($path, $callable);
        $this->routes["PUT"][] = $route;
        return $route;
    }

    public function patch(string $path, string $callable): Route {
        $route = new Route($path, $callable);
        $this->routes["PATCH"][] = $route;
        return $route;
    }

    public function delete(string $path, string $callable): Route {
        $route = new Route($path, $callable);
        $this->routes["DELETE"][] = $route;
        return $route;
    }

    public function prefix(string $prefix, array $routes): void {
        foreach($routes as $route) {
            $route->setPrefix($prefix);
        }
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
        respond(404, ['error' => 'Route not found !']);
    }

}
