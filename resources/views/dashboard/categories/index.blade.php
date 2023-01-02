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
                <th>Name</th>
                <th>Slug</th>
                <th>Creted at</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody style="height: 10px !important; overflow: scroll; ">
            
            @foreach ($categories as $category)    
            <tr>
                <td class="filterable-cell">{{ $loop->iteration }}</td>
                <td class="filterable-cell">{{ $category->name }}</td>
                <td class="filterable-cell">{{ $category->slug }}</td>
                <td class="filterable-cell">{{ $category->created_at }}</td>
                <td>
                    <a href="/dashboard/categories/{{ $category->slug }}/edit" class="badge bg-warning"><i class="bi bi-pencil-square px-1 py-1 fs-6"></i></a>
                    <form action="/dashboard/categories/{{ $category->slug }}" method="post" class="d-inline">
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