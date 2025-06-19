<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DetectCompany
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Ambil segmen pertama URL sebagai identifier
        $companySlug = $request->segment(1);
        
        // 2. Jika tidak ada segmen, gunakan default
        if (empty($companySlug)) {
            $this->bindCompanyToContainer(config('companies.default'));
            return $next($request);
        }
        
        // 3. Cari company di config
        $companies = config('companies.companies');
        $company = $companies[$companySlug] ?? null;
        
        // 4. Validasi company
        if (!$company || $company['is_active'] === false) {
            // Jika company tidak ditemukan atau tidak aktif
            if (config('app.debug')) {
                return response()->json([
                    'error' => 'Company not found or inactive',
                    'available_companies' => array_keys($companies)
                ], 404);
            }
            
            abort(404, 'Company not found');
        }
        
        // 5. Bind data company ke container
        $this->bindCompanyToContainer($company);
        
        return $next($request);
    }
    
    protected function bindCompanyToContainer(array $company)
    {
        // Bind ke container Laravel
        app()->instance('current.company', $company);
        
        // Tambahkan ke request untuk akses mudah
        request()->merge(['currentCompany' => $company]);
        
        // Set config dinamis
        config(['app.company' => $company]);
    }
}