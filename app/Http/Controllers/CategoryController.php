<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use Yajra\DataTables\Contracts\DataTables;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $categories = $this->validate($request, [
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
        ]);

        $categories = $this->categoryRepository->create($categories);
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        return view('categories.edit', compact('category'));
    }

    public function update($id, Request $request)
    {
        $categories = $this->validate($request, [
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
        ]);

        $categories = $this->categoryRepository->update($id, $categories);
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect()->route('categories.index');
    }
    
}
