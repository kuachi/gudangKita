<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container d-flex">
      <a class="navbar-brand fw-bold" href="/">GudangKita</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ auth()->user()->image }}" alt="" class="rounded-circle img-fluid" style="width: 30px">  {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-postcard"></i> Dashboard</a></li>
              <li><a class="dropdown-item" href="/dashboard/users"><i class="bi bi-person"></i> My Account</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/dashboard/users"><i class="bi bi-gear"></i> setting</a></li>
            </ul>
          </li>
            @endauth


          <li class="nav-item">
            <a class="nav-link {{ Request::is('info') ? 'active' : '' }}" href="/info"><i class="bi bi-info-circle"></i> Info</a>
          </li>

          @auth
          <li class="nav-item">
            <form action="/logout" method="POST">
              @csrf
              <button type="submit" class="nav-link bg-primary border-0"><i class="bi bi-person-x"></i> Logout</button>
            </form>
          </li>
          @endauth
        </ul>
        
      </div>
    </div>
</nav>
