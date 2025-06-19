<?php

// app/Services/Auth/AuthService.php
namespace App\Services\Auth;

// use App\Models\Company;
use Illuminate\Contracts\Foundation\Application;

class AuthService
{
    protected $app;
    protected $drivers = [];
    protected $company;

    public function __construct(Application $app/*, Company $company*/)
    {
        $this->app = $app;
        // $this->company = $company;
    }

    // public function forCompany(Company $company): self
    // {
    //     $this->company = $company;
    //     return $this;
    // }

    public function driver(string $driver)
    {
        if (!isset($this->drivers[$driver])) {
            $this->drivers[$driver] = $this->createDriver($driver);
        }
        return $this->drivers[$driver];
    }

    protected function createDriver(string $driver)
    {
        $drivers = [
            'form' => \App\Services\Auth\Drivers\FormAuth::class,
            'google' => \App\Services\Auth\Drivers\GoogleAuth::class,
        ];

        return $this->app->make($drivers[$driver], [
            'company' => $this->company
        ]);
    }
}