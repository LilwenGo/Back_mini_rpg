<?php
namespace Project\Models;
use Project\Models\Entity;

class EntityManager extends Manager {
    public function getDefault(): array {
        $stmt = $this->db->query("SELECT entity.id AS id, id_player, type.name AS type, entity.name AS name, data FROM entity JOIN type ON entity.id_type = type.id WHERE id_player = 'default");
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Entity::class);
    }

    public function getFromPlayer(string $id_player): array {
        $stmt = $this->db->prepare("SELECT entity.id AS id, id_player, type.name AS type, entity.name AS name, data FROM entity JOIN type ON entity.id_type = type.id WHERE id_player = ?");
        $stmt->execute([
            $id_player
        ]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Entity::class);
    }

    public function find(int $id): Entity|bool {
        $stmt = $this->db->prepare("SELECT entity.id AS id, id_player, type.name AS type, entity.name AS name, data FROM entity JOIN type ON entity.id_type = type.id WHERE entity.id = ?");
        $stmt->execute([
            $id
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Entity::class);
        return $stmt->fetch();
    }

    public function create(string $name, string $data, int $id_player, int $id_type): int {
        $stmt = $this->db->prepare("INSERT INTO entity(id_player, id_type, name, data) VALUES (?,?,?,?)");
        $stmt->execute([
            $id_player,
            $id_type,
            $name,
            $data
        ]);
        return $this->db->lastInsertId();
    }

    public function update(int $id, string $name, string $data, int $id_player, int $id_type): int {
        $stmt = $this->db->prepare("UPDATE entity SET id_player = ?, id_type = ?, name = ?, data = ? WHERE id = ?");
        $stmt->execute([
            $id_player,
            $id_type,
            $name,
            $data,
            $id
        ]);
        return $stmt->rowCount();
    }

    public function delete(int $id): int {
        $stmt = $this->db->prepare("DELETE FROM entity WHERE id = ?");
        $stmt->execute([
            $id
        ]);
        return $stmt->rowCount();
    }
}