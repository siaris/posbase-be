<?php
// app/Services/Auth/Contracts/AuthProviderInterface.php
namespace App\Services\Auth\Contracts;

interface AuthProviderInterface
{
    public function register(array $data): array;
    // public function login(array $credentials): array;
    // public function getUser(): ?\App\Models\User;

    public function cekUser(string $id): string; 
    public function makeToken(string $id): string; 
}