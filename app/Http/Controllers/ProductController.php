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
        $products = Product::all();
        return response()->json($products);
    }
    
    public function show($id)
    {
        $product = Product::with('minuses')->find($id);

        if ($product) {
            // Return ke view dengan data produk dan minus
            return view('checkout.checkout', ['product' => $product]);
        } else {
            // Redirect jika produk tidak ditemukan
            return redirect('/home')->with('error', 'Product not found');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'category' => ['required', Rule::in(['Iphone', 'Ipad', 'MacBook', 'Iwatch', 'Airpods', 'other'])],
            'price' => 'required|numeric',
            'requested' => ['nullable', Rule::in(['non-accepted', 'accepted', 'rejected'])],
            'status' => ['nullable', Rule::in(['active', 'inactive'])],
            'user_id' => 'nullable|numeric',
            'minuses' => 'array',
            'minuses.*' => 'numeric|exists:minuses,id',
        ]);

        $product = new Product([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'requested' => $request->requested,
            'status' => $request->status,
            'user_id' => $request->user_id,
        ]);

        $product->save();

        // Simpan data ke tabel minus_products
        $totalPrice = $request->price; // Mulai dari harga produk
        if ($request->has('minuses')) {
            foreach ($request->minuses as $minus_id) {
                $minus = \App\Models\Minus::find($minus_id);

                // Tambahkan harga minus ke total
                $totalPrice -= $minus->minus_price;

                // Simpan relasi ke tabel minus_products
                DB::table('minus_products')->insert([
                    'product_id' => $product->id,
                    'minus_id' => $minus->id,
                    'total_price' => $totalPrice, // Total harga sampai titik ini
                ]);
            }
        }

        return response()->json([
            'message' => 'Successfully created product with minuses!',
            'total_price' => $totalPrice,
        ], 201);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'category' => ['nullable', Rule::in(['Iphone', 'Ipad', 'MacBook', 'Iwatch', 'Airpods', 'other'])],
            'price' => 'nullable|numeric',
            'requested' => ['nullable', Rule::in(['non-accepted', 'accepted', 'rejected'])],
            'status' => ['nullable', Rule::in(['active', 'inactive'])],
            'user_id' => 'nullable|numeric',
            'minuses' => 'array', // Validasi bahwa minuses adalah array
            'minuses.*' => 'numeric|exists:minuses,id', // Setiap elemen harus berupa ID dari tabel minuses
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Update data produk
        $product->update($request->only([
            'name',
            'description',
            'category',
            'price',
            'requested',
            'status',
            'user_id',
        ]));

        // Hapus data lama di tabel minus_products (jika ada)
        DB::table('minus_products')->where('product_id', $product->id)->delete();

        // Tambahkan minus baru jika diberikan
        $totalPrice = $product->price;
        if ($request->has('minuses') && is_array($request->minuses)) {
            foreach ($request->minuses as $minus_id) {
                $minus = \App\Models\Minus::find($minus_id);

                if ($minus) {
                    // Tambahkan harga minus ke total
                    $totalPrice += $minus->minus_price;

                    // Simpan relasi ke tabel minus_products
                    DB::table('minus_products')->insert([
                        'product_id' => $product->id,
                        'minus_id' => $minus->id,
                        'total_price' => $totalPrice,
                    ]);
                }
            }
        }

        return response()->json([
            'message' => 'Successfully updated product with minuses!',
            'total_price' => $totalPrice,
        ]);
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
}
