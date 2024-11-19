<?php
namespace Project\Middlewares;

class PlayerIsLoguedMiddleware implements Middleware {
    public function run(): bool {
        if(isset($_SESSION['player']['id'])) {
            return true;
        } else {
            echo json_encode(["status" => 403, "message" => "Vous n'êtes pas connecté !"]);
            return false;
        }
    }
}