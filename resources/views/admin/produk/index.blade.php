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
                                <th style="width: 15%">Nama Produk</th>
                                <th style="width: 15%">Gambar</th>
                                <th style="width: 10%">Kategori</th>
                                <th style="width: 10%">Harga</th>
                                <th style="width: 10%">Stok</th>
                                <th style="width: 15%">Brand</th>
                                <th style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($produk->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada produk tersedia.</td>
                                </tr>
                            @else
                                @foreach ($produk as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td>
                                            <img src="{{ asset('/images/produk/' . $item->gambar) }}" width="100">
                                        </td>
                                        <td>{{ optional($item->kategori)->nama_kategori }}</td>
                                        <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>{{ $item->brand_name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('produk.show', $item->slug) }}" class="btn btn-info btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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
