<?php
namespace Project\Models;
use Project\Models\Type;

class TypeManager extends Manager {
    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM type WHERE NOT name = 'player_data'");
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Type::class);
    }

    public function find(int $id): Type|bool {
        $stmt = $this->db->prepare("SELECT * FROM type WHERE id = ?");
        $stmt->execute([
            $id
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Type::class);
        return $stmt->fetch();
    }

    public function create(string $name): int {
        $stmt = $this->db->prepare("INSERT INTO type(name) VALUES (?)");
        $stmt->execute([
            $name
        ]);
        return $this->db->lastInsertId();
    }

    public function update(int $id, string $name): int {
        $stmt = $this->db->prepare("UPDATE type SET name = ? WHERE id = ?");
        $stmt->execute([
            $name,
            $id
        ]);
        return $stmt->rowCount();
    }

    public function delete(int $id): int {
        $stmt = $this->db->prepare("DELETE FROM type WHERE id = ?");
        $stmt->execute([
            $id
        ]);
        return $stmt->rowCount();
    }
}