<?php
namespace Project\Middlewares;

class PlayerIsAdminMiddleware implements Middleware {
    public function run(): bool {
        if($_SESSION['player']['id'] === 'admin') {
            return true;
        } else {
            respond(403,["message" => "Accès non autorisé !"] );
            return false;
        }
    }
}