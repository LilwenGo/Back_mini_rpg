<?php
namespace Project\Middlewares;

class PlayerIsLoguedMiddleware implements Middleware {
    public function run(): bool {
        if(isset($_SESSION['player']['id'])) {
            return true;
        } else {
            respond(403,["message" => "Vous n'êtes pas connécté !"] );
            return false;
        }
    }
}