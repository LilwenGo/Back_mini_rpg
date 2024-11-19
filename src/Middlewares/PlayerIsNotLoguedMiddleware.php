<?php
namespace Project\Middlewares;

class PlayerIsNotLoguedMiddleware implements Middleware {
    public function run(): bool {
        if(!isset($_SESSION['player']['id'])) {
            return true;
        } else {
            echo json_encode(["status" => 403, "message" => "Vous êtes déja connecté !"]);
            return false;
        }
    }
}