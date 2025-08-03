{{-- Working Navbar with Real Routes --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container-fluid">
    {{-- Brand --}}
    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
      <i class="fas fa-tint me-2"></i>POS Galon
    </a>
    
    {{-- Mobile Toggle Button --}}
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    {{-- Menu Content --}}
    <div class="navbar-collapse show" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'bg-white bg-opacity-25 rounded' : '' }}" 
             href="{{ route('dashboard') }}">
            <i class="fas fa-home me-1"></i>Dashboard
          </a>
        </li>
        
        {{-- Products Menu --}}
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('products.*') ? 'bg-white bg-opacity-25 rounded' : '' }}" 
             href="{{ route('products.index') }}">
            <i class="fas fa-box me-1"></i>Produk
          </a>
        </li>
        
        {{-- Customers Menu --}}
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('customers.*') ? 'bg-white bg-opacity-25 rounded' : '' }}" 
             href="{{ route('customers.index') }}">
            <i class="fas fa-users me-1"></i>Pelanggan
          </a>
        </li>
        
        {{-- Vehicles Menu --}}
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('vehicles.*') ? 'bg-white bg-opacity-25 rounded' : '' }}" 
             href="{{ route('vehicles.index') }}">
            <i class="fas fa-truck me-1"></i>Kendaraan
          </a>
        </li>
        
        {{-- Sales Menu --}}
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('sales.*') ? 'bg-white bg-opacity-25 rounded' : '' }}" 
             href="{{ route('sales.index') }}">
            <i class="fas fa-shopping-cart me-1"></i>Transaksi
          </a>
        </li>
      </ul>

      {{-- Right Side Navigation --}}
      <div class="d-flex align-items-center">
        {{-- Search Form --}}
        <form class="d-flex me-3" action="{{ route('sales.search') }}" method="GET">
          <div class="input-group input-group-sm">
            <input class="form-control bg-light" type="search" name="query" 
                   placeholder="Cari transaksi..." value="{{ request('query') }}">
            <button class="btn btn-light" type="submit">
              <i class="fas fa-search text-primary"></i>
            </button>
          </div>
        </form>

        {{-- Dark Mode Toggle --}}
        <form action="{{ route('profile.toggleTheme') }}" method="POST" class="me-3">
          @csrf
          <button type="submit" class="btn btn-sm btn-light">
            @if(auth()->user()->theme === 'dark')
              <i class="fas fa-sun text-warning"></i> Light
            @else
              <i class="fas fa-moon text-primary"></i> Dark
            @endif
          </button>
        </form>

        {{-- User Dropdown --}}
        <div class="dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#" role="button" 
             data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle me-2 fs-5"></i>
            <span class="d-none d-sm-inline">{{ auth()->user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <h6 class="dropdown-header">
                <i class="fas fa-user me-2"></i>{{ auth()->user()->name }}
              </h6>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item" href="{{ route('profile.edit') }}">
                <i class="fas fa-cog me-2"></i>Profile Settings
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('profile.password.edit') }}">
                <i class="fas fa-key me-2"></i>Change Password
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                  <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>

<script>
console.log('✅ Navbar with working routes loaded!');
console.log('🔗 Available routes:', [
    '{{ route("dashboard") }}',
    '{{ route("products.index") }}', 
    '{{ route("customers.index") }}',
    '{{ route("vehicles.index") }}',
    '{{ route("sales.index") }}'
]);
</script>