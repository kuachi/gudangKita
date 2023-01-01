<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container d-flex">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
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
        </ul>

        <ul class="navbar-nav ms-auto">

          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/') ? 'active' : '' }}" href="/dashboard/products"><i class="bi bi-person-circle"></i> Add Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/products') ? 'active' : '' }}" href="/dashboard/products"><i class="bi bi-view-list"></i> Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('info') ? 'active' : '' }}" href="/info"><i class="bi bi-info-circle"></i> Info</a>
          </li>
          <li class="nav-item">
            <form action="/logout" method="POST">
              @csrf
              <button type="submit" class="nav-link bg-primary border-0"><i class="bi bi-person-x"></i> Logout</button>
            </form>
          </li>
        </ul>
        
      </div>
    </div>
</nav>
