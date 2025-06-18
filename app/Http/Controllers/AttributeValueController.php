<?php

namespace App\Http\Controllers;

use App\Models\AttributeValue;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeValueRequest;
use App\Http\Requests\StoreAttributeValueRequest;
use App\Http\Requests\UpdateAttributeValueRequest;
use App\Http\Resources\AttributeValueResource;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AttributeValueResource::collection(AttributeValue::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeValueRequest $request)
    {
        $value = AttributeValue::create($request->validated());
        return new AttributeValueResource($value);
    }

    /**
     * Display the specified resource.
     */
    public function show(AttributeValue $attributeValue)
    {
        return new AttributeValueResource($attributeValue);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttributeValueRequest $request, AttributeValue  $attributeValue)
    {
        $attributeValue->update($request->validated());
        return new AttributeValueResource($attributeValue);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttributeValue  $attributeValue)
    {
        $attributeValue->delete();
        return response()->json(null, 204);
    }
}
