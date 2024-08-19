<?php

namespace App\Http\Controllers;

use App\Models\UserLog;
use App\Notifications\UserActionNotification;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Logging
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'details' => 'Created category: '.$categories['name'],
        ]);

        $request->user()->notify(new UserActionNotification('created', 'Created category: '.$categories['name']));

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

        // Logging
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'details' => 'Updated category: '.$categories['name'],
        ]);

        $request->user()->notify(new UserActionNotification('updated', 'Updated category: '.$categories['name']));

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);

        // Logging
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'details' => 'Deleted category: '.$id,
        ]);

        $this->user()->notify(new UserActionNotification('deleted', 'Deleted category: '.$id));

        return redirect()->route('categories.index');
    }
}
