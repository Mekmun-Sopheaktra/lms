<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [
            'categories' => CategoryRepository::query()->withTrashed()->latest('id')->get(),
        ]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        CategoryRepository::storeByRequest($request);

        return to_route('category.index')->with('success', 'Category created');
    }

    public function edit(Category $category)
    {
        return view('category.edit', [
            'category' => $category,
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        CategoryRepository::updateByRequest($request, $category);

        return to_route('category.index')->withSuccess('Category updated');
    }

    public function delete(Category $category)
    {
        $category?->delete();

        return redirect()->route('category.index')->withSuccess('Category deleted');
    }

    public function restore(int $id)
    {
        CategoryRepository::query()->onlyTrashed()->find($id)->restore();

        return redirect()->route('category.index')->withSuccess('Category restored');
    }
}
