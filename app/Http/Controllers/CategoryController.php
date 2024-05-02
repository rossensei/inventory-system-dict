<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $categories = CategoryResource::collection(
            Category::whereNull('parent_id')->with('children')
            ->orderBy('category_name')
            ->get());

        return inertia('Category/Index', [
            'categories' => $categories, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('category_name', 'asc')
            ->select('id', 'category_name')
            ->get();

        return inertia('Category/Create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'category_name' => 'required|string|unique:categories',
        ]);

        Category::create($request->all());

        return redirect(route('category.index'))->with('success', 'Category successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return inertia('Category/Edit', ['category' => $category,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => ['required', 'string', Rule::unique(Category::class)->ignore($category->id)],
        ]);

        $category->update($request->all());

        return back()->with('success', 'Category details successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->children()->exists() || $category->properties()->exists()) {
            return back()->with('error', 'Error deleting category.');
        } else {
            $category->delete();
            return back()->with('success', 'Category has been removed.');
        }
    }
}
