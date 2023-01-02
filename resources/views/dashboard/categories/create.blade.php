@extends('dashboard.partials.main')

@section('container')

@if( session()->has('success') )
    @include('dashboard.partials.modal')
@endif

<div class="row">

    {{-- add new product --}}
    <div class="col-lg-3 ms-auto order-lg-1" style="background-color: rgb(245, 245, 245);margin-top: 30px"">
        <aside class="py-4 px-1">
            <span>
                <h5 class="fw-bold">Add new product</h5>
            </span>
            <hr>

            <form action="/dashboard/products" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input mb-3">
                    <input type="text" name="name" id="name" class="form-control form-control @error('name') is-invalid @enderror" placeholder="name" autofocus value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- <div class="input mb-3">
                    <input type="text" name="slug" id="slug" class="form-control form-control @error('slug') is-invalid @enderror" placeholder="slug" value="{{ old('slug') }}">
                    @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div> --}}

                <div class="input mb-3">
                    <input type="text" name="produsen" id="produsen" class="form-control @error('produsen') is-invalid @enderror" placeholder="produsen" value="{{ old('produsen') }}">
                    @error('produsen')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="text" name="stock" id="stock" class="form-control form-control @error('stock') is-invalid @enderror" placeholder="stock" value="{{ old('stock') }}">
                    @error('stock')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                    <input type="text" name="unit" id="unit" class="form-control form-control @error('unit') is-invalid @enderror" placeholder="unit" value="{{ old('unit') }}">
                    @error('unit')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="input mb-3">
                    <input type="text" name="price" id="price" class="form-control form-control @error('price') is-invalid @enderror" placeholder="price" value="{{ old('price') }}">
                    @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
    
                <div class="mb-2">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" name="category_id">
                        @foreach ($categories as $category)
                            @if ( old('category_id' == $category->id) )
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="input mb-3">
                    <input type="file" name="image" id="image" class="form-control form-control @error('image') is-invalid @enderror" placeholder="image">
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Add product</button>
            </form>
            
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
                <th>Unit</th>
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
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function(){
        // fetch('/dashboard/products/checkCode?name=' + name.value)
        //     .then(response => response.json())
        //     .then(data => slug.value = data.slug)
        fetch('/dashboard/products/checkSlug?name='+name.value)
            .then( response => response.json() )
            .then( data => slug.value = data.slug );

    });



</script>
@endsection