@extends('dashboard.partials.main')

@section('container')
<div class="row">
    <div class="col-lg-9 pe-5">
        <table class="table table-striped" style="font-size: 14px">
            <thead>
            <tr>
                <th style="width: 15px">No</th>
                <th>Name</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody style="height: 10px !important; overflow: scroll; ">
            
            @foreach ($products as $product)    
            <tr>
                <td class="filterable-cell">{{ $loop->iteration }}</td>
                <td class="filterable-cell">{{ $product->name }}</td>
                <td class="filterable-cell">Blue</td>
                <td class="filterable-cell">{{ $product->stock }}</td>
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
    <div class="col-lg-3 ms-auto" style="background-color: rgb(245, 245, 245);margin-top: 30px"">
        <aside class="py-4 px-1">
            <span>
                <h5 class="fw-bold">Add new product</h5>
            </span>
            <hr>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            
        </aside>
    </div>
</div>
@endsection