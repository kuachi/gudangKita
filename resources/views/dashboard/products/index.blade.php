@extends('dashboard.partials.main')

@section('container')

@if( session()->has('success') )
    @include('dashboard.partials.modal')
@endif


<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped" style="font-size: 14px">
            <thead>
            <tr>
                <th style="width: 15px">No</th>
                <th>Nama Produk</th>
                <th>PLU</th>
                <th>Kategori</th>
                <th>Produsen</th>
                <th>Stock</th>
                <th>Unit</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody style="height: 10px !important; overflow: scroll; ">

            @foreach ($products as $product)
            <tr>
                <td class="filterable-cell">{{ $loop->iteration }}</td>
                <td class="filterable-cell">{{ $product->name }}</td>
                <td class="filterable-cell">{{ $product->plu }}</td>
                <td class="filterable-cell">{{ $product->Category->name }}</td>
                <td class="filterable-cell">{{ $product->produsen }}</td>
                <td class="filterable-cell">{{ $product->stock }}</td>
                <td class="filterable-cell">{{ $product->unit }}</td>
                <td class="filterable-cell">@currency( $product['price'] )</td>
                <td>

                    <a href="/dashboard/products/{{ $product->slug }}" class="badge bg-success"><i class="bi bi-info-circle px-1 py-1 fs-6"></i></a>
                    <a href="/dashboard/products/{{ $product->slug }}/edit" class="badge bg-warning"><i class="bi bi-pencil-square px-1 py-1 fs-6"></i></a>
                    <form action="/dashboard/products/{{ $product->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure ?')"><i class="bi bi-x-circle px-1 py-1 fs-6"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach

            </tbody>

        </table>
    </div>
</div>

<script>

    // tutup modal notifikasi
    document.querySelector('#notification-modal').addEventListener('click', evt => {
        if( !evt.target.matches('button') ) return;
        const button = document.querySelector('#notification-modal');
        button.classList.remove('show', 'd-block');
    })

</script>
@endsection
