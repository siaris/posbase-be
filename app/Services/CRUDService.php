<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class CRUDService
{
    protected Model $model;
    protected array $rules;

    public function __construct(Model $model, array $rules)
    {
        $this->model = $model;
        $this->rules = $rules;
    }

    public function handle(Request $request, ?string $action = 'index', ?string $id = null)
    {
        return match ($action) {
            'index' => $this->index(),
            'show' => $this->show($id),
            'create' => $this->store($request),
            'edit' => $this->update($request, $id),
            default => response()->json(['error' => 'Invalid action'], 400),
        };
    }

    protected function index()
    {
        return response()->json($this->model->all());
    }

    protected function show($id)
    {
        return response()->json($this->model->findOrFail($id));
    }

    protected function store(Request $request)
    {
        if (!$request->isMethod('post')) return response()->json(['error' => 'Invalid request method'], 405);
        
        $data = $request->validate($this->rules);
        $item = $this->model->create($data);
        return response()->json(['message' => 'created', 'data' => []]);
    }

    protected function update(Request $request, $id)
    {
        if (!$request->isMethod('post')) return response()->json(['error' => 'Invalid request method'], 405);
        
        $data = $request->validate($this->rules);
        $item = $this->model->findOrFail($id);
        $item->update($data);
        return response()->json($item);
    }
}