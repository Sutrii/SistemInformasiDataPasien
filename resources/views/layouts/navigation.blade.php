<!-- resources/views/layouts/navbar.blade.php -->

<nav class="app-header navbar navbar-expand bg-body">
  <div class="container-fluid">

    <!-- Sidebar Toggle Button -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
      <li class="nav-item d-none d-md-block">
        <a href="/dashboard" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right Navbar -->
    <ul class="navbar-nav ms-auto">

      <!-- User Menu Dropdown -->
      @if (auth()->check())
      <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
        <img src="{{ asset('build/assets/profile.jpg') }}" class="rounded-circle shadow" style="width: 30px; height: 30px;" alt="User Image">
        <span class="d-none d-md-inline" style="font-size: 14px;">{{ Auth::user()->name }}</span>
      </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
          <li class="user-header text-bg-primary">
            <img src="{{ asset('build/assets/profile.jpg') }}" class="rounded-circle shadow" alt="User Image">
            <p>
              {{ Auth::user()->name }}
              <small>{{ Auth::user()->email }}</small>
            </p>
          </li>

          <li class="user-footer d-flex justify-content-between px-3">
              <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
              <a href="#" class="btn btn-default btn-flat"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Sign out
              </a>
              <form id="logout-form"
                    action="{{ route('logout') }}"
                    method="POST"
                    style="display: none;">
                  @csrf
              </form>
          </li>
        </ul>
      </li>
      @endif
    </ul>
  </div>
</nav>
