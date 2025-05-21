<!-- resources/views/layouts/sidebar.blade.php -->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <div class="sidebar-brand">
    <a href="{{ url('/pasiens') }}" class="brand-link">
      <img src="{{ asset('build/assets/logo.png') }}" alt="Logo"
           class="brand-image opacity-75 shadow block h-9 w-auto">
    </a>
  </div>

  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" role="menu">
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>Dashboard</p>
            </a>
        </li>

        <!-- Data Pasien -->
        <li class="nav-item">
            <a href="{{ url('/pasiens') }}" class="nav-link {{ request()->is('pasiens') ? 'active' : '' }}">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>Pendataan Pasien</p>
            </a>
        </li>

        <!-- Data Pasien -->
        <li class="nav-item">
            <a href="{{ url('/pendaftaran') }}" class="nav-link {{ request()->is('pendaftaran') ? 'active' : '' }}">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>Pendaftaran Pasien</p>
            </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
