<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
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

        public function show($id)
        {
            $product = Product::with('minuses')->find($id);

            if (!$product) {
                // Jika produk tidak ditemukan, redirect ke halaman lain dengan pesan error
                return redirect('/home')->with('error', 'Product not found');
            }

            // Hitung total_price (harga produk dikurangi harga minus)
            $product->total_price = $product->price - $product->minuses->sum('minus_price');

            // Jika request meminta JSON (misalnya dari AJAX)
            if (request()->wantsJson()) {
                return response()->json($product);
            }

            // Jika request datang dari web browser, tampilkan ke view checkout
            return view('checkout.checkout', compact('product'));
        }

        public function showAdmin($id)
        {
            $dealer = Product::with('minuses')->find($id); // Ganti $product menjadi $dealer
        
            if (!$dealer) {
                // Jika dealer tidak ditemukan, redirect ke halaman lain dengan pesan error
                return redirect('/dealer/admin')->with('error', 'Dealer not found');
            }
        
            // Hitung total_price (harga dealer dikurangi harga minus)
            $dealer->total_price = $dealer->price - $dealer->minuses->sum('minus_price');
        
            // Jika request meminta JSON (misalnya dari AJAX)
            if (request()->wantsJson()) {
                return response()->json($dealer);
            }
        
            // Jika request datang dari web browser, tampilkan ke view admin.dealer.detail
            return view('admin.dealer.detail', compact('dealer')); // Ganti $product menjadi $dealer
        }
        

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|numeric|exists:categories,id',
            'price' => 'required|numeric',
            'requested' => ['nullable', Rule::in(['non-accepted', 'accepted', 'rejected'])],
            'status' => ['nullable', Rule::in(['active', 'inactive'])],
            'user_id' => 'nullable|numeric',
            'minuses' => 'array',
            'minuses.*' => 'numeric|exists:minuses,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:6000',
        ]);

        // Cari kategori
        $category = \App\Models\Category::find($request->category_id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Simpan produk
        $product = new Product([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'category' => $category->name_iphone,
            'price' => $request->price,
            'requested' => $request->requested,
            'status' => $request->status,
            'user_id' => $request->user_id,
        ]);

        // Menangani upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images-product'), $imageName);

            // Simpan nama dan URL gambar ke database
            $product->image = $imageName;
            $product->image_url = url('images-product/' . $imageName);
        }

        $product->save();

        // Simpan data ke tabel minus_products
        $totalPrice = $request->price;
        if ($request->has('minuses')) {
            $minuses = \App\Models\Minus::whereIn('id', $request->minuses)->get();

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
        // Find the product by ID
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('admin.dealer.index')->with('error', 'Product not found');
        }

        // Pass the product to the view
        return view('admin.dealer.edit', compact('product'));
    }
    
     public function update(Request $request, $id)
{
    // Validation
    $request->validate([
        'price' => 'nullable|numeric',
        'status' => ['nullable', Rule::in(['active', 'inactive'])],
        'requested' => ['nullable', Rule::in(['non-accepted', 'accepted', 'rejected'])],
    ]);

    // Find the product by ID
    $product = Product::find($id);

    if (!$product) {
        return redirect()->route('admin.dealer.index')->with('error', 'Product not found');
    }

    // Update the product
    $product->update($request->only(['price', 'status', 'requested']));

    // Redirect back to the dealer page with success message
    return redirect()->route('admin.dealer.index')->with('success', 'Product updated successfully');
}
    


    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $hasMinus = DB::table('minus_products')->where('product_id', $product->id)->exists();
        if ($hasMinus) {
            DB::table('minus_products')->where('product_id', $product->id)->delete();
        }

        $product->delete();

        return response()->json(['message' => 'Successfully deleted product and related minuses!']);
    }

    public function insertimage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6000',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Menangani upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images-product'), $imageName);

            // Jika ada gambar sebelumnya, hapus gambar lama
            if ($product->image && file_exists(public_path('images-product/' . $product->image))) {
                unlink(public_path('images-product/' . $product->image));
            }

            // Menyimpan nama gambar ke database
            $product->image = $imageName;
            $product->image = url('images-product/' . $product->image);

            $product->save();
        }

        if (!$product->image) {
            return response()->json(['message' => 'Failed to upload image!'], 500);
        }

        return response()->json(['message' => 'Successfully uploaded image!']);
    }

    public function showProductbyCategory($category)
    {
        $products = Product::where('category', $category)->get();
        return response()->json($products);
    }
}
