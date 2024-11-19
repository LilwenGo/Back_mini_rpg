<?php
namespace Project\Middlewares;

interface Middleware {
    public function run(): bool;
}