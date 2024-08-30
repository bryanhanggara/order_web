@extends('layouts.app')

@section('content')
    <link href="https://cdn.datatables.net/v/bs5/dt-2.1.5/datatables.min.css" rel="stylesheet">

    <div class="pagetitle">
        <h1>Produk</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Produk</li>
        </ol>
        </nav>
    </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
        <!-- Customers Card -->
        <div class="col-xl-12">

            <div class="card info-card customers-card">

            
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success mt-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{route('products.create')}}" class="btn btn-primary mt-4 mb-4">Tambah Produk</a>
                    <div class="container">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </thead>    
                            <tbody>
                            </tbody>
                        </table>    
                    </div> 
                </div>

             
            </div>

          </div><!-- End Customers Card -->
        </div>
      </div><!-- End Left side columns -->

    </div>
</section>
       

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.1.5/datatables.min.js"></script>
    <script>
       $(document).ready(function() {
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('data') }}', 
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'price', name: 'price' },
                    { data: 'stock', name: 'stock' },
                    { data: 'category', name: 'category' },
                    { data: 'aksi', name: 'aksi' } 
                ]
            });
        });
    </script>
@endsection