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
            <a href="{{ url('/dashboard') }}"
               class="nav-link hover:bg-[#e3ab2c] hover:text-black {{ request()->is('dashboard') ? 'bg-[#F6C244] text-black font-semibold' : '' }}">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>Dashboard</p>
            </a>
        </li>

        <!-- Pendataan Pasien -->
        <li class="nav-item">
            <a href="{{ url('/pasiens') }}"
               class="nav-link hover:bg-[#e3ab2c] hover:text-black {{ request()->is('pasiens') ? 'bg-[#F6C244] text-black font-semibold' : '' }}">
                <i class="nav-icon bi bi-person-lines-fill"></i>
                <p>Pendataan Pasien</p>
            </a>
        </li>

        <!-- Pendaftaran Pasien -->
        <li class="nav-item">
            <a href="{{ url('/pendaftaran') }}"
               class="nav-link hover:bg-[#e3ab2c] hover:text-black {{ request()->is('pendaftaran') ? 'bg-[#F6C244] text-black font-semibold' : '' }}">
                <i class="nav-icon bi bi-journal-plus"></i>
                <p>Pendaftaran Pasien</p>
            </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
