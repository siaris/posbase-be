<?php
// app/Services/Auth/Drivers/FormAuth.php
namespace App\Services\Auth\Drivers;

use App\Models\User;
// use App\Models\Company;
use App\Services\Auth\Contracts\AuthProviderInterface;
use App\Services\Auth\Contracts\AuthProviderTrait;

class FormAuth implements AuthProviderInterface
{
    protected $company;
    use AuthProviderTrait;

    // public function __construct(Company $company) 
    // {
    //     $this->company = $company;
    // }

    public function register(array $data): array
    {
        if (!User::insert([
                'email' => $data['email'],
                'firstname' => $data['email'],
                'lastname' => $data['email'],
                'password' => md5($data['password']),
            ])) throw new \Exception('Failed to create user');
        return ['email' => $data['email']];
    }

    public function login(array $credentials): array
    {
        $tokenLogin = $this->makeToken($this->cekUser($credentials['email'],$credentials['password'] ));
        return ['token'=>$tokenLogin];
    }
}