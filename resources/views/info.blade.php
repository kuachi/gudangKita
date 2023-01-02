@extends('layouts.main')

@section('container')

<section style="background-color: rgb(245, 245, 245);margin-top: 30px">
<div class="container py-5 px-5">

    {{-- left column > img --}}
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="/storage/images/rahmat.png" alt="avatar"
                    class="rounded-circle img-fluid" style="width: 150px;">
                    <h4 class="my-3 fw-bold">Rahmat</h4>
                    <p class="text-muted mb-1">Student of Informatics Engineering</p>
                    <div class="d-flex justify-content-center mb-2">
                </div>
            </div>
        </div>
    </div>

      {{-- right column --}}
      <div class="col-lg-8">
          <div class="card mb-4">
              <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Full Name</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">Muhammad Rahmat Mutik</p>
                    </div>
                  </div>
                  
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">rahmatmutik2002@gmail.com<</p>
                    </div>
                  </div>
                  
                  <hr>
                  <div class="row">
                      <div class="col-sm-3">
                          <p class="mb-0">Address</p>
                      </div>
                      <div class="col-sm-9">
                          <p class="text-muted mb-0">Ngajum, Kab. malang, Jawa Timur</p>
                      </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Lecturer
                        </p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">Sonhaji Akbar, S.Pd., M.Kom</p>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">web Version</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">Beta</p>
                    </div>
                  </div>

              </div>
          </div>
      </div>
  </div>

</section>

@endsection