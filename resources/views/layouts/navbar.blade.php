<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container d-flex">
      <a class="navbar-brand fw-bold" href="/">Gudang Kita</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('info') ? 'active' : '' }}" href="/info"><i class="bi bi-info-circle"></i> Info</a>
          </li>
        </ul>
        
      </div>
    </div>
</nav>
