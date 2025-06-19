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
                ->driver($this->getAuthDriver($request))
                ->register($request->all());
            if (empty($result)) {
                throw new \Exception('Registration failed.');
            }
            return successResponse($result);
            
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }
    }

    private function getAuthDriver($request){
        if ($request->has('google_token')) return 'google';
        return 'form';
    }
}
