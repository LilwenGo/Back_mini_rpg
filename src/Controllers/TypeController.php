<?php
namespace Project\Controllers;

use Project\Models\TypeManager;

class TypeController extends Controller {
    public function __construct() {
        $this->manager = new TypeManager();
        parent::__construct();
    }

    public function getTypes(): void {
        $types = $this->manager->getAll();
        respond(200, ["data" => $types]);
    }

    public function create(): void {
        $this->validator->validate([
            "name" => ['required', 'min:3', 'max:50', 'entityName']
        ]);

        if(!$this->validator->errors()) {
            $type = $this->manager->getByName($_POST['name']);
            if(!$type) {
                $res = $this->manager->create($_POST['name']);
                if($res['rowCount'] !== 0) {
                    respond(200, ["data" => ['id' => $res['id']]]);
                } else {
                    respond(422, ["message" => "Une erreur est survenue lors de la création du type !"]);
                }
            } else {
                respond(400, ["message" => "Le type éxiste déja !"]);
            }
        } else {
            respond(400, ["message" => "Erreur sur les champs !", "errors" => $this->validator->errors()]);
        }
    }

    public function delete(int $id): void {
        $res = $this->manager->delete($id);
        if($res !== 0) {
            respond(200, ["message" => "Suppression réussie !"]);
        } else {
            respond(500, ["message" => "Erreur lors de la suppression !"]);
        }
    }
}