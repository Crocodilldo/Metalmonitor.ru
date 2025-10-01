<?php

namespace App\Http\Controllers\ApiControllers\AdminControllers;

use App\Http\Controllers\Controller;

abstract class BaseCRUDController extends Controller
{
    protected $model;
    protected $storeRequest;
    protected $updateRequest;
    protected $resource;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->model::all();
        return $this->resource::collection($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $request = app($this->storeRequest);
        $result = $this->model::create($request->all());
        return new $this->resource($result);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = $this->model::findOrFail($id);
        return new $this->resource($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $request = app($this->updateRequest);
        $item = $this->model::findOrFail($id);
        $item->update($request->all());
        return new $this->resource($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = $this->model::findOrFail($id);
        $model->delete();
        return response()->json(['message' => 'It was deleted'], 200);
    }
}
