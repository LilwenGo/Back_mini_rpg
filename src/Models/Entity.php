<?php
namespace Project\Models;

class Entity {
    private int $id;
    private int $id_player;
    private string $type;
    private string $name;
    private string $data;

    public function getId(): int {
        return $this->id;
    }
    
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function getId_player(): int {
        return $this->id_player;
    }
    
    public function setId_player(int $id_player): void {
        $this->id_player = $id_player;
    }
    
    public function getType(): string {
        return $this->type;
    }
    
    public function setType(string $type): void {
        $this->type = $type;
    }
    
    public function getName(): string {
        return $this->name;
    }
    
    public function setName(string $name): void {
        $this->name = $name;
    }
    
    public function getData(): string {
        return $this->data;
    }
    
    public function setData(string $data): void {
        $this->data = $data;
    }
}