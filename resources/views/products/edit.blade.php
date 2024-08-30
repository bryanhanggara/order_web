@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Edit Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
                <li class="breadcrumb-item active">Edit Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Edit Product Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <form action="{{ route('products.update', $product->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Nama Produk</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Deskripsi Produk</label>
                                        <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Harga Produk</label>
                                        <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Stok Produk</label>
                                        <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}" required>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Kategori Produk</label>
                                        <input type="text" name="category" id="category" class="form-control" value="{{ $product->category }}">
                                    </div>
                                
                                    <button type="submit" class="btn btn-success mt-3">Perbarui Produk</button>
                                </form>
                            </div>
                        </div>

                    </div><!-- End Edit Product Card -->
                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>
@endsection
