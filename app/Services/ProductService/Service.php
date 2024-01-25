<?php

namespace App\Services\ProductService;

use App\Models\Product;

class Service
{
    public function store($data)
    {
        $category = $data['categories'];
        $product = Product::create($data);
        $product->categories()->attach($category);
        return $product;
    }

    public function update(Product $product, $data)
    {
        $category = $data['category_id'];
        unset($data['category_id']);
        $product->update($data);
        $product->categories()->sync($category);
        return $product;
    }

    public function updateApi(Product $product, array $data): Product
    {
        $product->name = $data['name'] ?? $product->name;
        $product->price = $data['price'] ?? $product->price;

        if (isset($data['categories'])) {
            $categories = $data['categories'];
            if (!empty($categories)) {
                $product->categories()->sync($categories);
            }
        }

        $product->save();

        return $product;
    }
}
