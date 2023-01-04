@extends('dashboard.partials.main')

@section('container')

@if( session()->has('success') )
    @include('dashboard.partials.modal')
@endif

<div class="row">

  <div class="col-lg-4 ms-auto order-lg-1" style="background-color: rgb(245, 245, 245);margin-top: 30px">
    <aside class="py-4 px-1">
        <span>
            <h5 class="fw-bold">User details</h5>
        </span>
        <hr>

        <div class="text-center mb-3">
            <img src="{{ $userShow->image }}" alt="{{ $userShow->name }}" class="img-thumbnail">
        </div>
        <div class="input mb-3">
            <label for="name" style="font-size: 14px;">Name :</label>
            <input type="text" name="name" id="name" class="disable form-control" placeholder="name" value="{{ $userShow->name }}" @disabled(true)>
        </div>

        <div class="input mb-3">
            <label for="name" style="font-size: 14px;">Username :</label>
            <input type="text" name="slug" id="slug" class="form-control" placeholder="slug" value="{{ $userShow->username }}" @disabled(true)>
        </div>

        <div class="input mb-3">
            <label for="name" style="font-size: 14px;">Email :</label>
            <input type="text" name="slug" id="slug" class="form-control" placeholder="slug" value="{{ $userShow->email }}" @disabled(true)>
        </div>

        <div class="input mb-3">
            <label for="name" style="font-size: 14px;">Join at :</label>
            <input type="text" name="slug" id="slug" class="form-control" placeholder="slug" value="{{ ($userShow->created_at)->format('d-m-Y') }}" @disabled(true)>
        </div>

        
        <a href="/dashboard/users/" class="btn btn-primary w-100">Back</a>
        
    </aside>
</div>


    <div class="col-lg-8 pe-5 order-lg-12">
        <table class="table table-striped" style="font-size: 14px">
            <thead>
            <tr>
                <th style="width: 15px">No</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            </thead>

            <tbody style="height: 10px !important; overflow: scroll; ">
            
            @foreach ($users as $user)    
            <tr>
                <td class="filterable-cell">{{ $loop->iteration }}</td>
                <td class="filterable-cell">{{ $user->name }}</td>
                <td class="filterable-cell">{{ $user->email }}</td>
                <td>

                    <a href="/dashboard/users/{{ $user->id }}" class="badge bg-success"><i class="bi bi-info-circle px-1 py-1 fs-6"></i></a>
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