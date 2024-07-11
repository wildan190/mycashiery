<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\UserLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAll();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'product_name' => 'required|string|max:50',
            'product_stock' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $this->processPicture($request, $data);
        $this->productRepository->create($data);

        // Logging
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'details' => 'Created product: ' . $data['product_name'],
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update($id, Request $request)
    {
        $data = $this->validate($request, [
            'product_name' => 'required|string|max:50',
            'product_stock' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $this->processPicture($request, $data);
        $this->productRepository->update($id, $data);

        // Logging
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'details' => 'Updated product: ' . $data['product_name'],
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = $this->productRepository->find($id);
        $this->deletePicture($product);
        $this->productRepository->delete($id);

        // Logging
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'details' => 'Deleted product: ' . $product->product_name,
        ]);
        
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    private function processPicture($request, &$data)
    {
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('pictures', 'public');
            $data['picture'] = $path;
        }
    }

    private function deletePicture($product)
    {
        if ($product->picture) {
            Storage::disk('public')->delete($product->picture);
        }
    }
}
