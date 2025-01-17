<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Minus;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.dealer.dealer');
    }

    // For AJAX DataTable
    public function getProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function getFilteredProducts()
    {
        $products = Product::where('requested', 'accepted')
            ->where('status', 'active')
            ->get();

        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::with('minuses')->find($id);

        if (!$product) {
            return redirect('/home')->with('error', 'Product not found');
        }

        // Calculate total_price (product price minus the sum of minus prices)
        $product->total_price = $product->price - $product->minuses->sum('minus_price');

        // Return the response based on the request type (JSON or View)
        if (request()->wantsJson()) {
            return response()->json($product);
        }

        return view('checkout.checkout', compact('product'));
    }

    public function showAdmin($id)
    {
        $dealer = Product::with('minuses')->find($id);

        if (!$dealer) {
            return redirect('/dealer/admin')->with('error', 'Dealer not found');
        }

        // Calculate total_price (dealer price minus the sum of minus prices)
        $dealer->total_price = $dealer->price - $dealer->minuses->sum('minus_price');

        // Return the response based on the request type (JSON or View)
        if (request()->wantsJson()) {
            return response()->json($dealer);
        }

        return view('admin.dealer.detail', compact('dealer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|numeric|exists:categories,id',
            'price' => 'required|numeric',
            'user_id' => 'nullable|numeric',
            'minuses' => 'array',
            'minuses.*' => 'numeric|exists:minuses,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:6000',
        ]);

        // Find the category
        $category = \App\Models\Category::find($request->category_id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Save the product
        $product = new Product([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'category' => $category->name_iphone,
            'price' => $request->price,
            'user_id' => $request->user_id,
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images-product'), $imageName);

            // Save the image name and URL
            $product->image = $imageName;
            $product->image = url('images-product/' . $imageName);
        }

        $product->save();

        // Save data to minus_products table
        $totalPrice = $request->price;
        if ($request->has('minuses')) {
            $minuses = Minus::whereIn('id', $request->minuses)->get();

            foreach ($minuses as $minus) {
                $totalPrice -= $minus->minus_price;

                DB::table('minus_products')->insert([
                    'product_id' => $product->id,
                    'minus_id' => $minus->id,
                    'total_price' => $totalPrice,
                ]);
            }
        }

        return response()->json([
            'message' => 'Successfully created product with minuses and image!',
            'product' => $product,
            'total_price' => $totalPrice,
        ], 201);
    }

    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('admin.dealer.index')->with('error', 'Product not found');
        }

        return view('admin.dealer.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'price' => 'nullable|numeric',
            'status' => ['nullable', Rule::in(['active', 'inactive'])],
            'requested' => ['nullable', Rule::in(['non-accepted', 'accepted', 'rejected'])],
        ]);

        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('admin.dealer.index')->with('error', 'Product not found');
        }

        $product->update($request->only(['price', 'status', 'requested']));

        return redirect()->route('admin.dealer.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        DB::table('minus_products')->where('product_id', $product->id)->delete();
        $product->delete();

        return response()->json(['message' => 'Successfully deleted product and related minuses!']);
    }

    public function insertImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6000',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images-product'), $imageName);

            // If an old image exists, remove it
            if ($product->image && file_exists(public_path('images-product/' . $product->image))) {
                unlink(public_path('images-product/' . $product->image));
            }

            // Save the new image name to the database
            $product->image = $imageName;
            $product->image = url('images-product/' . $imageName);

            $product->save();
        }

        return response()->json(['message' => 'Successfully uploaded image!']);
    }

    public function showProductByCategory($category)
    {
        $products = Product::where('category', $category)->get();
        return response()->json($products);
    }

    public function showProductsByCategory(Request $request)
    {
        $category = $request->input('category');

        // Jika kategori ada, filter berdasarkan kategori
        if ($category) {
            $products = Product::where('category', $category)->get();
        } else {
            // Jika tidak ada kategori, tampilkan semua produk
            $products = Product::all();
        }

        return response()->json($products);
    }
}
