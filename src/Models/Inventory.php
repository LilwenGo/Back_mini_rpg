<?php
namespace Project\Models;

class Inventory {
    private string $id_player;
    private int $id_entity;
    private int $count;

    public function getId_player(): string {
        return $this->id_player;
    }
    
    public function setId_player(string $id_player): void {
        $this->id_player = $id_player;
    }

    public function getId_entity(): int {
        return $this->id_entity;
    }
    
    public function setId_entity(int $id_entity): void {
        $this->id_entity = $id_entity;
    }
    
    public function getCount(): int {
        return $this->count;
    }
    
    public function setCount(int $count): void {
        $this->count = $count;
    }
}