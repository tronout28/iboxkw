<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Minus;
use App\Models\CategoryMinus;

class MinusController extends Controller
{
    public function index()
    {
        $minuses = Minus::all();

        return response()->json($minuses);
    }

    public function show($id)
    {
        $minus = Minus::find($id);

        if ($minus) {
            return response()->json($minus);
        } else {
            return response()->json(['message' => 'Minus not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'minus_product' => 'required|string',
            'minus_price' => 'required|numeric',
        ]);

        $minus = new Minus([
            'minus_product' => $request->minus_product,
            'minus_price' => $request->minus_price,
        ]);

        $minus->save();

        return response()->json(['message' => 'Successfully created minus!'], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'minus_product' => 'nullable|string',
            'minus_price' => 'nullable|numeric',
        ]);

        $minus = Minus::find($id);

        if ($minus) {
            $minus->minus_product = $request->minus_product;
            $minus->minus_price = $request->minus_price;
            $minus->save();

            return response()->json(['message' => 'Successfully updated minus!']);
        } else {
            return response()->json(['message' => 'Minus not found'], 404);
        }
    }

    public function destroy($id)
    {
        $minus = Minus::find($id);

        if ($minus) {
            $minus->delete();

            return response()->json(['message' => 'Successfully deleted minus!']);
        } else {
            return response()->json(['message' => 'Minus not found'], 404);
        }
    }

    public function showProducts($id)
    {
        $minus = Minus::find($id)->with('products')->first();

        if ($minus) {
            return response()->json($minus->products);
        } else {
            return response()->json(['message' => 'Minus not found'], 404);
        }
    }

    public function showMinusByCategory($category_id)
    {
        $minuses = CategoryMinus::where('category_id', $category_id)->with('minuses')->get();

        return response()->json($minuses);
    }

}
