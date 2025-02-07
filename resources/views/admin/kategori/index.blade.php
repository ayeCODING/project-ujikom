@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm rounded-lg border-0">
            <div class="card-header bg-white text-dark d-flex justify-content-between align-items-center border-bottom">
                <h5 class="mb-0"><i class="bx bx-list-ul"></i> Daftar Kategori</h5>
                <a href="{{ route('kategori.create') }}" class="btn btn-outline-dark btn-sm d-flex align-items-center">
                    <i class="bx bx-plus-circle me-1"></i> Tambah Kategori
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="kategoriTable" class="table table-hover table-bordered">
                        <thead class="bg-light text-center">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 50%">Nama Kategori</th>
                                <th style="width: 25%">Slug</th>
                                <th style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama_kategori }}</td>
                                    <td>{{ $data->slug }}</td> <!-- Tambahkan slug untuk cek -->
                                    <td>
                                        <a href="{{ route('kategori.edit', $data->slug) }}" class="btn btn-outline-dark btn-sm shadow d-flex align-items-center">
                                            <i class="bx bx-plus-circle me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('kategori.destroy', $data->slug) }}" method="POST" onsubmit="return confirmDelete(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm shadow d-flex align-items-center">
                                                <i class="bx bx-trash me-1"></i> Hapus
                                            </button>
                                        </form>
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
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah penghapusan langsung

            Swal.fire({
                title: "Konfirmasi Hapus",
                text: "Apakah Anda yakin ingin menghapus kategori ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest("form").submit(); // Submit form setelah konfirmasi
                }
            });
        }
    </script>
@endsection

