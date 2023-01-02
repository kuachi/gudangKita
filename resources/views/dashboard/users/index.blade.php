@extends('dashboard.partials.main')

@section('container')

@if( session()->has('success') )
    @include('dashboard.partials.modal')
@endif

<div class="row">

  <div class="col-lg-3 ms-auto order-lg-1" style="background-color: rgb(245, 245, 245);margin-top: 30px">
    <aside class="py-4 px-1">
        <span>
            <h5 class="fw-bold">Add new user</h5>
        </span>
        <hr>

        <form action="/dashboard/users" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input mb-3">
                <input type="text" name="name" id="name" class="form-control form-control @error('name') is-invalid @enderror" placeholder="name" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="input mb-3">
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="username" value="{{ old('username') }}">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="input mb-3">
                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="password" name="password" id="password" class="form-control form-control @error('password') is-invalid @enderror" placeholder="password" value="{{ old('password') }}">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="input mb-3">
                <input type="file" name="image" id="image" class="form-control form-control @error('image') is-invalid @enderror" placeholder="image">
                @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Add user</button>
        </form>
        
    </aside>
</div>


    <div class="col-lg-9 pe-5 order-lg-12">
        <table class="table table-striped" style="font-size: 14px">
            <thead>
            <tr>
                <th style="width: 15px">No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Join at</th>
            </tr>
            </thead>

            <tbody style="height: 10px !important; overflow: scroll; ">
            
            @foreach ($users as $user)    
            <tr>
                <td class="filterable-cell">{{ $loop->iteration }}</td>
                <td class="filterable-cell">{{ $user->name }}</td>
                <td class="filterable-cell">{{ $user->email }}</td>
                <td class="filterable-cell">{{ $user->created_at }}</td>
                <td>

                    <a href="/dashboard/products/{{ $user->id }}" class="badge bg-success"><i class="bi bi-info-circle px-1 py-1 fs-6"></i></a>
                    <a href="/dashboard/users/{{ $user->id }}/edit" class="badge bg-warning"><i class="bi bi-pencil-square px-1 py-1 fs-6"></i></a>
                    <form action="/dashboard/users/{{ $user->id }}" method="post" class="d-inline">
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