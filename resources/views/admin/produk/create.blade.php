@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm rounded-lg border-0">
            <div class="card-header bg-white text-dark">
                <h5 class="mb-0"><i class="bx bx-plus-circle"></i> Tambah Produk</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required onkeyup="generateSlug()">
                    </div>

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori_id" name="kategori_id" required>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->kategori_id }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="brand_name" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand_name" name="brand_name" value="James Boogie" required>
                    </div>

                    <button type="submit" class="btn btn-dark">Simpan</button>
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function generateSlug() {
            let nama_produk = document.getElementById("nama_produk").value;
            let slug = nama_produk.toLowerCase().replace(/[^\w\s-]/g, '').replace(/\s+/g, '-').replace(/^-+|-+$/g, '');
            document.getElementById("slug").value = slug;
        }
    </script>
@endsection
