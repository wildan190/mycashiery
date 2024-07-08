<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll()
    {
        return $this->product->paginate(10);
    }

    public function find($id)
    {
        return $this->product->find($id);
    }

    public function create(array $data)
    {
        return $this->product->create($data);
    }

    public function update($id, array $data)
    {
        return $this->product->find($id)->update($data);
    }

    public function delete($id)
    {
        $product = $this->product->find($id);

        if ($product->picture) {
            Storage::disk('public')->delete($product->picture);
        }

        return $product->delete();
    }
    
}