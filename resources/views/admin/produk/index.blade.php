@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm rounded-lg border-0">
            <div class="card-header bg-white text-dark d-flex justify-content-between align-items-center border-bottom">
                <h5 class="mb-0"><i class="bx bx-list-ul"></i> Daftar Produk</h5>
                <a href="{{ route('produk.create') }}" class="btn btn-outline-dark btn-sm d-flex align-items-center">
                    <i class="bx bx-plus-circle me-1"></i> Tambah Produk
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="produkTable" class="table table-hover table-bordered">
                        <thead class="bg-light text-center">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 20%">Nama Produk</th>
                                <th style="width: 15%">Kategori</th>
                                <th style="width: 10%">Harga</th>
                                <th style="width: 10%">Stok</th>
                                <th style="width: 20%">Brand</th>
                                <th style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->kategori->nama_kategori }}</td>
                                    <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->brand_name }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('produk.show', $item->slug) }}" class="btn btn-info btn-sm me-2 d-flex align-items-center">
                                                <i class="bx bx-search"></i> Detail
                                            </a>
                                            <a href="{{ route('produk.edit', $item->slug) }}" class="btn btn-warning btn-sm me-2 d-flex align-items-center">
                                                <i class="bx bx-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('produk.destroy', $item->slug) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center" onclick="return confirmDelete('{{ $item->slug }}')">
                                                    <i class="bx bx-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(slug) {
            event.preventDefault();
            Swal.fire({
                title: "Konfirmasi Hapus",
                text: "Apakah Anda yakin ingin menghapus produk ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('form[action="'+window.location.origin+'/produk/'+slug+'"]').submit();
                }
            });
        }
    </script>
@endsection
