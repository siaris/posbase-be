<?php
// app/Services/Auth/Drivers/GoogleAuth.php
namespace App\Services\Auth\Drivers;

// use Laravel\Socialite\Facades\Socialite;
use App\Services\Auth\Contracts\AuthProviderInterface;
use App\Services\Auth\Contracts\AuthProviderTrait;


class GoogleAuth implements AuthProviderInterface 
{  
    protected $data = [];
    use AuthProviderTrait;

    // Implementasi mirip FormAuth dengan penyesuaian OAuth
    public function register(array $data): array
    {
        //lakukan curl
        $response = \Illuminate\Support\Facades\Http::get('https://oauth2.googleapis.com/tokeninfo?id_token='.$data['google_token']);
        $info = $response->json();
        if($response->failed()) return [];
        if(!isset($info['email']))return [];

        // use userTrait;
        $tokenLogin = $this->makeToken($this->cekUser($info['email']));

        return ['token'=>$tokenLogin];
    }

    private function checkUser(){

    }
}