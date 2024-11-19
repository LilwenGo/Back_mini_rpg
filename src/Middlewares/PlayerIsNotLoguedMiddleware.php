<?php
namespace Project\Middlewares;

class PlayerIsNotLoguedMiddleware implements Middleware {
    public function run(): bool {
        if(!isset($_SESSION['player']['id'])) {
            return true;
        } else {
            respond(403, ["message" => "Vous êtes déja connécté !"]);
            return false;
        }
    }
}