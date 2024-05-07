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

        $pageSize = $request->input('perPage', 10);
        $baseQuery = Category::query();

        $baseQuery->with('parent');

        $baseQuery->when($request->input('search'), function ($query, $search) {
            $query->where('category_name', 'LIKE', "%{$search}%");
        });

        $categories = $baseQuery->paginate($pageSize)->withQueryString();

        // $categories = CategoryResource::collection(
        //     Category::with('parent')
        //     ->orderBy('category_name')
        //     ->get());

        // dd($categories);

        return inertia('Category/Index', [
            'categories' => CategoryResource::collection($categories),
            'filters' => $request->only(['search', 'perPage']) 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->doesntHave('properties')
            ->orderBy('category_name', 'asc')
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

        if($request->parent_id == null || $request->parent_id == 'null') {
            Category::create(['category_name' => $request->category_name ]);
            return redirect(route('category.index'))->with('success', 'Category successfully created!');
        }

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

        $category->update(['category_name' => $request->category_name]);

        return redirect(route('category.index'))->with('success', 'Category details successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->children()->exists() || $category->properties()->exists()) {
            return back()->with('error', 'Category cannot be deleted.');
        } else {
            $category->delete();
            return back()->with('success', 'Category has been removed.');
        }
    }
}
