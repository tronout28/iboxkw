<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if ($category) {
            return response()->json($category);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_iphone' => 'required|string',
        ]);

        $category = new Category([
            'name_iphone' => $request->name_iphone,
        ]);

        $category->save();

        return response()->json(['message' => 'Successfully created category!'], 201);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name_iphone' => 'nullable|string',
        ]);

        $category = Category::find($id);

        if ($category) {
            $category->name_iphone = $request->name_iphone;
            $category->save();

            return response()->json(['message' => 'Successfully updated category!']);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }


    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();

            return response()->json(['message' => 'Successfully deleted category!']);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    public function products($id)
    {
        $category = Category::find($id)->with('products')->get();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $products = $category->products;

        return response()->json($products);
    }


    public function minuses($id)
    {
        $category = Category::find($id)->with('minuses')->get();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $minuses = $category->minuses;

        return response()->json($minuses);
    }
}
