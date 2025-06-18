<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Http\Resources\AttributeResource;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AttributeResource::collection(Attribute::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeRequest $request)
    {
        $attribute = Attribute::create($request->validated());
        return new AttributeResource($attribute);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        return new AttributeResource($attribute);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        $attribute->update($request->validated());
        return new AttributeResource($attribute);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return response()->json(null, 204);
    }
}
