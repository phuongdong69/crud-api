<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryservice;
    protected $transformer;

    public function __construct(CategoryService $categoryservice, CategoryTransformer $transformer)
    {
        $this->categoryservice = $categoryservice;
        $this->transformer = $transformer;
    }
    public function index()
    {
        $categories = $this->categoryservice->getAll();
        return response()->json($this->transformer->collection($categories));
    }
    public function store(CategoryRequest $request)
    {
        $category = $this->categoryservice->create($request->validated());
        return response()->json($this->transformer->cate($category));
    }
    public function show(int $id)
    {
        $category = $this->categoryservice->getById($id);
        return response()->json($this->transformer->cate($category));
    }
    public function update(CategoryRequest $request, int $id)
    {
        $category = $this->categoryservice->update($id,$request->validated());
        return response()->json($this->transformer->cate($category));
    }
    public function destroy(int $id)
    {
        $this->categoryservice->delete($id);
        return response()->json(['message'=>'Category deleted successfully.'], 204);
    }
    public function getByName(string $name)
    {
        $category = $this->categoryservice->getByName($name);
        if (!$category) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($this->transformer->cate($category));
    }
}
