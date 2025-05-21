<!-- resources/views/layouts/navbar.blade.php -->

<nav class="app-header navbar navbar-expand bg-body">
  <div class="container-fluid">

    <!-- Sidebar Toggle Button -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
      <li class="nav-item d-none d-md-block">
        <a href="/pasiens" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right Navbar -->
    <ul class="navbar-nav ms-auto">

      <!-- Fullscreen Toggle -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
          <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
          <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
        </a>
      </li>

      <!-- User Menu Dropdown -->
      @if (auth()->check())
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
          <img src="{{ asset('build/assets/profile.jpg') }}" class="user-image rounded-circle shadow" alt="User Image">
          <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
          <li class="user-header text-bg-primary">
            <img src="{{ asset('build/assets/profile.jpg') }}" class="rounded-circle shadow" alt="User Image">
            <p>
              {{ Auth::user()->name }}
              <small>{{ Auth::user()->email }}</small>
            </p>
          </li>

          <li class="user-footer">
            <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a>

            <form action="{{ route('logout') }}" method="POST" class="d-inline float-end">
              @csrf
              <button type="submit" class="btn btn-default btn-flat">Sign out</button>
            </form>
          </li>
        </ul>
      </li>
      @endif

    </ul>
  </div>
</nav>
