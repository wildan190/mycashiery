<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return $this->category->paginate(10);
    }

    public function find($id)
    {
        return $this->category->find($id);
    }

    public function create(array $data)
    {
        return $this->category->create($data);
    }

    public function update($id, array $data)
    {
        return $this->category->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->category->find($id)->delete();
    }
}
