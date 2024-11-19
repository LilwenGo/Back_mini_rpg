<?php
namespace Project\Models;
use Project\Models\Player;

class PlayerManager extends Manager {
    public function find(string $id): Player|bool {
        $stmt = $this->db->prepare("SELECT * FROM player WHERE id = ?");
        $stmt->execute([
            $id
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Player::class);
        return $stmt->fetch();
    }

    public function getByUsername(string $username): Player|bool {
        $stmt = $this->db->prepare("SELECT * FROM player WHERE username = ?");
        $stmt->execute([
            $username
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Player::class);
        return $stmt->fetch();
    }

    public function create(string $username, string $password): array {
        $stmt = $this->db->prepare("INSERT INTO player(id, username, password) VALUES (?,?,?)");
        $id = uniqid();
        $stmt->execute([
            $id,
            $username,
            $password
        ]);
        return ['rowCount' => $stmt->rowCount(), 'id' => $id];
    }

    public function update(string $id, string $username, string $password): int {
        $stmt = $this->db->prepare("UPDATE player SET username = ?, password = ? WHERE id = ?");
        $stmt->execute([
            $username,
            $password,
            $id
        ]);
        return $stmt->rowCount();
    }

    public function delete(string $id): int {
        $stmt = $this->db->prepare("DELETE FROM player WHERE id = ?");
        $stmt->execute([
            $id
        ]);
        return $stmt->rowCount();
    }
}