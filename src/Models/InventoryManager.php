<?php
namespace Project\Models;
use Project\Models\Inventory;

class InventoryManager extends Manager {
    public function getFromPlayer(string $id_player): array {
        $stmt = $this->db->prepare("SELECT * FROM inventory WHERE id_player = ?");
        $stmt->execute([
            $id_player
        ]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Inventory::class);
    }

    public function find(string $id_player, int $id_entity): Inventory|bool {
        $stmt = $this->db->prepare("SELECT * FROM inventory WHERE id_player = ? AND id_entity = ?");
        $stmt->execute([
            $id_player,
            $id_entity
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Inventory::class);
        return $stmt->fetch();
    }

    public function create(string $id_player, int $id_entity, int $count): int {
        $stmt = $this->db->prepare("INSERT INTO inventory(id_player, id_entity, count) VALUES (?,?,?)");
        $stmt->execute([
            $id_player,
            $id_entity,
            $count
        ]);
        return $stmt->rowCount();
    }

    public function update(string $id_player, int $id_entity, int $count): int {
        $stmt = $this->db->prepare("UPDATE inventory SET count = ? WHERE id_player = ? AND id_entity = ?");
        $stmt->execute([
            $count,
            $id_player,
            $id_entity
        ]);
        return $stmt->rowCount();
    }

    public function delete(string $id_player, int $id_entity): int {
        $stmt = $this->db->prepare("DELETE FROM inventory WHERE id_player = ? AND id_entity = ?");
        $stmt->execute([
            $id_player,
            $id_entity
        ]);
        return $stmt->rowCount();
    }
}