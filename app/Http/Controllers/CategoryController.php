<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_deleted', false)->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        //return redirect()->route('categories.index');
        return response()->json($category, 201);
    }

    public function destroy(string $id)
    {
            $category = Category::findOrFail($id);
            $category->delete();


            return redirect()->route('categories.index');

        }

    public function createCategoryApi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'name' => $request->input('name'),
        ]);

        return response()->json($category, 201);
    }

    public function destroyCategoryApi($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        if ($category->product()->exists()) {
            return response()->json(['error' => 'Cannot delete category, it is attached to products.'], 400);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }



}

