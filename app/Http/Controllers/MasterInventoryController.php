<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\MasterKatalog;
use App\Models\MasterFormularium;
use App\Models\MasterSatuan;

use App\Services\CRUDService as CRUD;

class MasterInventoryController extends Controller
{

    public function formularium(Request $request, $company, ?string $action = 'index', ?string $id = null)
    {
        try{
            $crud = new CRUD(new MasterFormularium, 
            ['nama' => 'required|string',]);

            return $crud->handle($request, $action, $id);
        } catch(Exception $e){
            return errorResponse($e->getMessage());
        }
    }

    public function satuan(Request $request, ?string $action = 'index', ?string $id = null){
        try{
            $crud = new CRUD(new MasterSatuan, 
            ['nama' => 'required|string',]);

            return $crud->handle($request, $action, $id);
        } catch(Exception $e){
            return errorResponse($e->getMessage());
        }
    }
}