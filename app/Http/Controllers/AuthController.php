<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}
    //
    public function register(Request $request){
        try {
            $result = $this->authService
                ->driver($this->_getAuthDriver($request))
                ->register($request->all());
            if (empty($result)) {
                throw new \Exception('Registration failed.');
            }
            return successResponse($result);
            
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }
    }

    public function login(Request $r){
        try {
            $result = $this->authService
                ->driver('form')
                ->login($r->all());
            if (empty($result)) {
                throw new \Exception('Login failed.');
            }
            return successResponse($result);
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }
    }

    private function _getAuthDriver($request){
        if ($request->has('google_token')) return 'google';
        return 'form';
    }
}
