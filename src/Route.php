<?php
namespace Project;

class Route {

    private string $path;
    private string $callable;
    private array $matches = [];
    private array $params = [];

    public function __construct(string $path, string $callable){
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    public function match(string $url): bool {
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches)){
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    public function call() {
         $rep = explode("@", $this->callable);
         $controller = "Project\\Controllers\\".$rep[0];
         $controller = new $controller();

        return call_user_func_array([$controller, $rep[1]], $this->matches);
    }

}
