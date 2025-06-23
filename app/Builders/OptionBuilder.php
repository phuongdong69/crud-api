<?php

namespace App\Builders;

use Illuminate\Http\Request;

class OptionBuilder
{
    public static function fromRequest(Request $request, array $defaultJoins = [])
    {
        return [
            'join' => $defaultJoins,
            'filters' => array_filter($request->only([
                'category_name',
                'sort',
                'order',
                'min_price',
                'max_price',
                'brand',
                'status',
                'name'
            ])),
            'sort' => [
                $request->get('sort_by', 'created_at') =>
                $request->get('sort_dir', 'desc')
            ],
            'paginate' => true,
            'per_page' => $request->get('per_page', 10)

        ];
    }
}
