@extends('layouts.main')

@section('container')
    <style>
        .divider:after,
        .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
        }
        .h-custom {
        height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
        .h-custom {
        height: 100%;
        }
        }
    </style>

    <section class="mt-5">
        <div class="h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form action="/" method="post">
            @csrf

                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                <p class="lead fw-normal mb-0 me-3">Sign in</p>
                </div>
                <div class="divider d-flex align-items-center my-4"></div>
                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
    
                <!-- Email input -->
                <div class="form-outline mb-4">
                <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder="Enter a username">
                </div>
    
                <!-- Password input -->
                <div class="form-outline mb-3">
                <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Enter password">
                </div>
    
                <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
            </form>
            </div>
        </div>
        </div>
    </section>
@endsection