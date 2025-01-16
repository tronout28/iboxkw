<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::all();
        return response()->json([
            'status' => 'success',
            'data' => $artikels
        ]);
    }

    public function show($id)
    {
        $artikel = Artikel::find($id);

        if (!$artikel) {
            return response()->json([
                'status' => 'error',
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }

        return view('artikel.artikel', compact('artikel'));

        return response()->json([
            'status' => 'success',
            'data' => $artikel
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:6000'
        ]);

        $artikel = new Artikel([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
        ]);

        $artikel->save();

        // Menangani upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images-artikel'), $imageName);

            // Menyimpan nama gambar ke database
            $artikel->image = $imageName;
            $artikel->image = url('images-artikel/' . $imageName);

            $artikel->save();
        }

        return response()->json([
            'status' => 'success',
            'data' => $artikel
        ], 201);
    }


    public function destroy($id)
    {
        // Cari artikel berdasarkan ID
        $artikel = Artikel::find($id);

        // Jika artikel tidak ditemukan
        if (!$artikel) {
            return response()->json([
                'status' => 'error',
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }

        // Hapus gambar jika ada dan file tersebut masih ada di sistem
        if ($artikel->image) {
            $imagePath = public_path('images-artikel/' . $artikel->image);
            if (file_exists($imagePath)) {
                try {
                    unlink($imagePath);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Gagal menghapus file gambar: ' . $e->getMessage()
                    ], 500);
                }
            }
        }

        // Hapus artikel dari database
        try {
            $artikel->delete();
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus artikel: ' . $e->getMessage()
            ], 500);
        }

        // Kembalikan respons sukses
        return response()->json([
            'status' => 'success',
            'message' => 'Artikel berhasil dihapus'
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:6000'
        ]);

        $artikel = Artikel::find($id);

        if (!$artikel) {
            return response()->json([
                'status' => 'error',
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }

        $artikel->title = $request->title;
        $artikel->subtitle = $request->subtitle;
        $artikel->content = $request->content;

        // Menangani upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images-artikel'), $imageName);

            // Hapus gambar lama jika ada
            if ($artikel->image && file_exists(public_path('images-artikel/' . $artikel->image))) {
                unlink(public_path('images-artikel/' . $artikel->image));
            }

            // Update nama gambar di database
            $artikel->image = $imageName;
            $artikel->image = url('images-artikel/' . $imageName);
        }

        $artikel->save();

        return response()->json([
            'status' => 'success',
            'data' => $artikel
        ]);
    }
}
