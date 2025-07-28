<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('dashboard') }}">POS Galon</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('products.index') }}">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('customers.index') }}">Pelanggan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('vehicles.index') }}">Kendaraan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('sales.index') }}">Transaksi</a>
        </li>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-danger btn-sm">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
