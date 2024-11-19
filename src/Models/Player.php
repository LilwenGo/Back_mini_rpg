<?php
namespace Project\Models;

class Player {
    private string $id;
    private string $username;
    private string $password;

    public function getId(): string {
        return $this->id;
    }
    
    public function setId(string $id): void {
        $this->id = $id;
    }
    
    public function getUsername(): string {
        return $this->username;
    }
    
    public function setUsername(string $username): void {
        $this->username = $username;
    }
    
    public function getPassword(): string {
        return $this->password;
    }
    
    public function setPassword(string $password): void {
        $this->password = $password;
    }
}