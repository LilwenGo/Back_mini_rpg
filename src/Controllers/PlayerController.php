<?php
namespace Project\Controllers;
use Project\Models\PlayerManager;

class PlayerController extends Controller {
    public function __construct() {
        $this->manager = new PlayerManager();
        parent::__construct();
    }

    public function login(): void {
        $this->validator->validate([
            "username" => ['required', 'min:3', 'max:40', 'alphaDashAccent'],
            "password" => ['required', 'min:6', 'max:20', 'alphaNumDash']
        ]);

        if(!$this->validator->errors()) {
            $player = $this->manager->getByUsername($_POST['username']);
            if($player) {
                if(password_verify($_POST['password'], $player->getPassword())) {
                    $_SESSION['player'] = [
                        'id' => $player->getId(),
                        'username' => $player->getUsername(),
                    ];
                    respond(200, []);
                } else {
                    respond(422, ["message" => "Une erreur est survenue lors de la conéxion !"]);
                }
            } else {
                respond(400, ["message" => "L'utilisateur spécifié n'a pas été trouvé !"]);
            }
        } else {
            respond(400, ["errors" => $this->validator->errors(), "message" => "Erreur sur les champs !"]);
        }
    }

    public function register(): void {
        $this->validator->validate([
            "username" => ['required', 'min:3', 'max:40', 'alphaDashAccent'],
            "password" => ['required', 'min:6', 'max:20', 'alphaNumDash']
        ]);

        if(!$this->validator->errors()) {
            $player = $this->manager->getByUsername($_POST['username']);
            if(!$player) {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $res = $this->manager->create($_POST['username'], $password);
                if($res['rowCount'] !== 0) {
                    $_SESSION['player'] = [
                        'id' => $res['id'],
                        'username' => $_POST['username'],
                    ];
                    respond(200, ["data" => ['id' => $res['id']]]);
                } else {
                    respond(422, ["message" => "Une erreur est survenue lors de la création du compte !"]);
                }
            } else {
                respond(400, ["message" => "Le nom d'utilisateur est déja pris !"]);
            }
        } else {
            respond(400, ["errors" => $this->validator->errors(), "message" => "Erreur sur les champs !"]);
        }
    }

    public function logout(): void {
        session_start();
        session_destroy();
        respond(200, []);
    }
}