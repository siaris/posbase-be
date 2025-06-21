<?php
// app/Services/Auth/Contracts/AuthProviderInterface.php
namespace App\Services\Auth\Contracts;

use \App\Models\User;

trait AuthProviderTrait
{
    public function cekUser(string $id, $password = null): string {
        $ada = $password !== null ? $this->_cekUser($id,$password) : User::where('email',$id)->first();
        if(!$ada)
            if (!User::insert([
                'email' => $id,
                'firstname' => $id,
                'lastname' => $id,
                'password' => md5(config('auth.default_password')),
                ])) throw new \Exception('Failed to insert user');
        return $id;
    }

    private function _cekUser(string $id, string $password): ?User {
        $r = User::where('email', $id)
            ->where('password', md5($password))
            ->first();
        if(!$r) {
            throw new \Exception('Invalid credentials');
        }
        return $r;
    }

    public function makeToken(string $id): string {
        $key = config('app.key');
        $iat = time();
        $exp = $iat + 3600; // expired dalam 1 jam
        $payload = [
            'id' => $id,
            'iat' => $iat,
            'exp' => $exp,
        ];
        $header = ['alg' => 'HS256', 'typ' => 'JWT'];

        $base64UrlHeader = rtrim(strtr(base64_encode(json_encode($header)), '+/', '-_'), '=');
        $base64UrlPayload = rtrim(strtr(base64_encode(json_encode($payload)), '+/', '-_'), '=');
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $key, true);
        $base64UrlSignature = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');

        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }
}