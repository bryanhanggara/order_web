<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use App\Http\Requests\ProdukRequest;

class ProductsController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProdukRequest $request)
    {
        $data = $request->validated();
        $product = products::create($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = products::findorfail($id);
        return view('products.edit', compact('product'));
    }

    public function update(ProdukRequest $request, $id)
    {
        $validatedData = $request->validated();
        $product = products::findOrFail($id);
        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = products::findorfail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function list()
    {
        return response()->json(Product::all());
    }
}
