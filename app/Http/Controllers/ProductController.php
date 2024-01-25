<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;

use App\Services\ProductService\Service;
use Illuminate\Http\Request;



class ProductController extends Controller
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $products = Product::with('categories')->get();
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));

    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
        ]);
        $product->categories()->attach($request->input('category_id'));
        return redirect()->route('products.index');
        //JSON response
        //return response()->json($product, 201);
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        $updatedProduct = $this->service->update($product, $data);

        //return redirect()->route('products.index');
        //JSON response
        return response()->json($updatedProduct, 201);
    }

    public function destroy(string $id)
    {
        $category = Product::findOrFail($id);
        $category->delete();
        //return redirect()->route('products.index');
        //JSON response
        return response()->json($category, 201);
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function indexApi(Request $request)
    {
        $products = Product::with('categories:id,name')->select('id', 'name', 'price')->get();
        return response()->json($products, 200);
    }


    public function searchByName(Request $request)
    {
        $name = $request->input('name', null);

        if ($name) {
            $products = Product::where('name', 'like', "%$name%")->get();
            return response()->json($products);
        }

        $products = Product::all();
        return response()->json($products);
    }

    public function getByCategoryId($category_id)
    {
        $category = Category::with(['product:id,name'])->find($category_id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json($category, 200);
    }

    public function getByCategoryName(Request $request)
    {
        $categoryName = $request->input('category_name');

        $category = Category::with(['product:id,name'])->where('name', $categoryName)->first();

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json($category, 200);
    }
    public function getByPriceRange(Request $request)
    {
        $prices = $request->input('prices');

        list($minPrice, $maxPrice) = explode(',', $prices);

        $products = Product::whereBetween('price', [$minPrice, $maxPrice])->get();

        return response()->json($products, 200);
    }

    public function getByPublishedStatus(Request $request)
    {
        $isPublished = $request->input('is_published');

        $products = Product::where('is_published', $isPublished)->select('id', 'name', 'is_published')->get();

        return response()->json($products, 200);
    }

    public function createApi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'categories' => 'required|array|min:2|max:10',
        ]);

        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
        ]);

        $categories = $request->input('categories', []);
        $product->categories()->attach($categories);

        $categoryIds = $product->categories->pluck('id');

        $response = $product->only(['name', 'price', 'updated_at', 'created_at', 'id']);
        $response['category_ids'] = $categoryIds;

        return response()->json($response, 201);
    }


    public function updateApi(Request $request, $productId)
    {
        $request->validate([
            'name' => 'string|max:255',
            'price' => 'numeric',
            'categories' => 'array|min:2|max:10',
        ]);

        $product = Product::findOrFail($productId);

        $data = [
            'name' => $request->input('name', $product->name),
            'price' => $request->input('price', $product->price),
            'categories' => $request->input('categories', []),
        ];

        $updatedProduct = $this->service->updateApi($product, $data);

        $responseData = [
            'product' => $updatedProduct->only(['name', 'price', 'id']),
            'categories' => $updatedProduct->categories->map->only(['id', 'name']),
        ];

        return response()->json($responseData, 200);
    }


    public function destroyApi($productId)
    {
        $product = Product::findOrFail($productId);

        $product->delete();

        return response()->json([
            'message' => 'Product marked as deleted successfully',
            'deleted_at' => $product->deleted_at,
        ], 200);
    }



}
