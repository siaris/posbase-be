<?php
// app/Services/Auth/Drivers/FormAuth.php
namespace App\Services\Auth\Drivers;

// use App\Models\User;
// use App\Models\Company;
use App\Services\Auth\Contracts\AuthProviderInterface;

class FormAuth implements AuthProviderInterface
{
    protected $company;

    // public function __construct(Company $company) 
    // {
    //     $this->company = $company;
    // }

    public function register(array $data): array
    {
        // $user = User::create([
        //     'company_id' => $this->company->id,
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password'])
        // ]);

        // return $this->generateToken($user);
        return [];
    }

    // public function login(array $credentials): array
    // {
    //     if (!auth()->attempt($credentials)) {
    //         throw new \Exception('Invalid credentials');
    //     }

    //     return $this->generateToken(auth()->user());
    // }

    // protected function generateToken(User $user): array
    // {
    //     return [
    //         'user' => $user,
    //         'token' => $user->createToken('API Token')->plainTextToken
    //     ];
    // }

    // public function getUser(): ?User
    // {
    //     return auth()->user();
    // }
}