<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Product;


class ProfileController extends Controller
{

    public function create()
    {
        // Mengembalikan view 'products.create' yang berisi form penambahan produk
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Request
        // Ini sangat penting untuk keamanan dan integritas data!
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Nama wajib diisi, string, maks 255 karakter
            'description' => 'nullable|string', // Deskripsi boleh kosong, string
            'price' => 'required|numeric|min:0|max:99999999.99', // Harga wajib, angka, min 0, format desimal 10,2
            'stock' => 'required|integer|min:0', // Stok wajib, angka bulat, min 0
        ]);

        // 2. Simpan Data ke Database
        // Menggunakan Mass Assignment
        Product::create($validatedData);

        // 3. Redirect ke Halaman Daftar Produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
