<?php
namespace Project;

class Route {

    private string $path;
    private string $prefix;
    private ?string $middleware = null;
    private string $callable;
    private array $matches = [];
    private array $params = [];

    public function __construct(string $path, string $callable){
        $this->path = trim($path, '/');
        $this->prefix = '';
        $this->callable = $callable;
    }

    public function match(string $url): bool {
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', trim($this->prefix.$this->path, '/'));
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches)){
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    public function call() {
        if($this->middleware !== null) {
            try {
                $controller = "Project\\Middlewares\\".$this->middleware."Middleware";
                $controller = new $controller();
                if(!call_user_func_array([$controller, 'run'], [])) {
                    return;
                }
            } catch (\Exception $e) {
                echo json_encode(['status' => 500, 'error' => "Erreur lors de l'appel du middleware: ".$this->middleware]);
            }
        }
        $rep = explode("@", $this->callable);
        $controller = "Project\\Controllers\\".$rep[0];
        $controller = new $controller();

        return call_user_func_array([$controller, $rep[1]], $this->matches);
    }

    public function middleware(string $middleware): Route {
        $this->middleware = $middleware;
        return $this;
    }

    public function setPrefix(string $prefix): Route {
        $this->prefix = trim($prefix, '/').'/';
        return $this;
    }
}
