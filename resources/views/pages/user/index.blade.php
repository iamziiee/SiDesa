@extends('layouts.app')
@section('content')

<div class="container-fluid">
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Permintaan Akun</h1>
    </div>
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Penduduk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div style="overflow-x : auto">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @if (empty($users))
                                <tbody>
                                    <tr>
                                        <td colspan="12">
                                            <p class="pt-3 text-center">Data Tidak Ada</p>
                                        </td>
                                    </tr>
                                </tbody>
                            @else                           
                            <tbody>
                                @foreach ($users as $item)
                                
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                    <div class="d-flex" style="gap: 5px;">
                                            <button type="button" class="btn btn-sm btn-success" title="Aprroved" data-toggle="modal" data-target="#confirmationApprove-{{ $item->id }}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" title="Reject" data-toggle="modal" data-target="#confirmationReject-{{ $item->id }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                    </div>
                                    </td>
                                </tr>
                                @include('pages.user.confirmation-approved')
                                @include('pages.user.confirmation-reject')
                                @endforeach
                                
                            </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
        });
    </script>
@endif
@endsection