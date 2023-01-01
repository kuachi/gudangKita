@extends('dashboard.partials.main')

@section('container')
<div class="row">

    {{-- add new product --}}
    <div class="col-lg-3 ms-auto order-lg-1" style="background-color: rgb(245, 245, 245);margin-top: 30px"">
        <aside class="py-4 px-1">
            <span>
                <h5 class="fw-bold">Product Details</h5>
            </span>
            <hr>

            <div class="text-center mb-3">
                <img src="{{ $productShow->image }}" alt="" class="img-thumbnail">
            </div>
            <div class="input mb-3">
                <input type="text" name="name" id="name" class="disable form-control" placeholder="name" value="{{ $productShow->name }}" @disabled(true)>
            </div>

            <div class="input mb-3">
                <input type="text" name="slug" id="slug" class="form-control" placeholder="slug" value="{{ $productShow->slug }}" @disabled(true)>
            </div>

            <div class="input mb-3">
                <input type="text" name="produsen" id="produsen" class="form-control" placeholder="produsen" value="{{ $productShow->produsen }}" @disabled(true)>
            </div>

            <div class="input-group mb-3">
                <input type="text" name="stock" id="stock" class="form-control form-control" placeholder="stock" value="{{ $productShow->stock }}" @disabled(true)>

                <input type="text" name="unit" id="unit" class="form-control form-control" placeholder="unit" value="{{ $productShow->unit }}" @disabled(true)>
            </div>

            <div class="input mb-3">
                <input type="text" name="price" id="price" class="form-control form-control" placeholder="price" value="@currency($productShow['price'])" @disabled(true)>
            </div>

            <div class="input mb-3">
                <input type="text" name="price" id="price" class="form-control form-control" placeholder="price" value="{{ $productShow->category->name }}" @disabled(true)>
            </div>
            <a href="/dashboard/products" class="btn btn-primary">Back</a>
            
        </aside>
    </div>


    {{-- tableof products --}}
    <div class="col-lg-9 pe-5 order-lg-12">
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
                <td class="filterable-cell">{{ $product->category->name }}</td>
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

    
</div>
@endsection