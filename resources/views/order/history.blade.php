@extends('layouts.app')

@section('content')
    <link href="https://cdn.datatables.net/v/bs5/dt-2.1.5/datatables.min.css" rel="stylesheet">

    <div class="pagetitle">
        <h1>Riwayat Order</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Riwayat Order</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <div class="container">
                                    <table class="table table-striped" id="orderTable">
                                        <thead>
                                            <tr>
                                                <th>ID Order</th>
                                                <th>Tanggal Order</th>
                                                <th>Total Harga</th>
                                                <th>Detail</th>
                                            </tr>
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
            $('#orderTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('order-data') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'total', name: 'total' },
                    { data: 'aksi', name: 'aksi' }
                ]
            });
        });
    </script>
@endsection
