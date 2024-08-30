@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        </nav>
    </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

            
              <div class="card-body">
               

                <div class="align-items-center">
                    <form action="{{ route('products.store') }}" method="post">
                        @csrf
                        
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Produk</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                    
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga Produk</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok Produk</label>
                            <input type="number" name="stock" id="stock" class="form-control" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori Produk</label>
                            <input type="text" name="category" id="category" class="form-control">
                        </div>
                    
                        <button type="submit" class="btn btn-success mt-3">Tambahkan Produk</button>
                    </form>
                        
                </div>

            </div>

             
            </div>

          </div><!-- End Customers Card -->
        </div>
      </div><!-- End Left side columns -->

    </div>
</section>
@endsection