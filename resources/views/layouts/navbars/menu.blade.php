<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header d-flex align-items-center">
      <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('argon') }}/img/brand/blues.png" class="navbar-brand-img" alt="Motokaa">
      </a>
      <div class="ml-auto">
        <!-- Sidenav toggler -->
        <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
          <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar-inner">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <ul class="navbar-nav">
          @if((auth()->user()->rights_group == 2 && auth()->user()->garage_id != 0) || auth()->user()->rights_group != 2)
          <li class="nav-item">
              <a class="nav-link {{ $activePage == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                  <i class="ni ni-shop text-primary"></i> {{ __('Dashboard') }}
              </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $activePage == 'payments' || $activePage == 'invoices' || $activePage == 'statements' ? 'active' : '' }}" href="#navbar-transactions" data-toggle="collapse" role="button" aria-expanded="{{ $activePage == 'payments' ? 'true' : 'false' }}" aria-controls="navbar-transactions">
              <i class="fa fa-credit-card text-blue"></i>
              <span class="nav-link-text">Transactions</span>
            </a>
            <div class="collapse {{ $activePage == 'payments' || $activePage == 'invoices' || $activePage == 'statements' ? 'show' : 'hide' }}" id="navbar-transactions">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="{{ route('payments.index')}}" class="nav-link">
                    <i class="ni ni-bullet-list-67 text-blue"></i>
                    Payments
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('invoices') }}" class="nav-link">
                    <i class="ni ni-bullet-list-67 text-blue"></i>
                    Invoices
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ $activePage == 'users' || $activePage == 'mechanics' || $activePage == 'clients' || $activePage == 'rights' ? 'active' : '' }}" href="#navbar-users" data-toggle="collapse" role="button" aria-expanded="{{ $activePage == 'users' ? 'true' : 'false' }}" aria-controls="navbar-users">
              <i class="ni ni-single-02 text-blue"></i>
              <span class="nav-link-text">Users</span>
            </a>
            <div class="collapse {{ $activePage == 'users' || $activePage == 'mechanics' || $activePage == 'clients' || $activePage == 'rights' ? 'show' : 'hide' }}" id="navbar-users">
              <ul class="nav nav-sm flex-column">
                @if(auth()->user()->rights_group == 1)
                <li class="nav-item">
                  <a href="{{ route('users.type', 'admin') }}" class="nav-link">
                    <i class="fa fa-user-circle text-blue"></i>
                    Admins
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('users.type', 'owner') }}" class="nav-link">
                    <i class="fa fa-user text-blue"></i>
                    Owners
                  </a>
                </li>
                @endif
                <li class="nav-item">
                  <a href="{{ route('users.type', 'mechanic') }}" class="nav-link">
                    <i class="fa fa-address-card text-blue"></i>
                    Mechanics
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('users.type', 'client') }}" class="nav-link">
                    <i class="fa fa-users text-blue"></i>
                    Clients
                  </a>
                </li>
                <!--<li class="nav-item ">
                  <a href="{{ route ('rights.index')}}" class="nav-link {{ $activePage == 'rights' ? 'active' : '' }}">
                    <i class="ni ni-briefcase-24 text-blue"></i>
                    Rights Group
                  </a>
                </li>-->
                <li class="nav-item">
                  <a href="{{ route('user.create') }}" class="nav-link">
                    <i class="fa fa-user-plus text-blue"></i>
                    Add User
                  </a>
                </li>

              </ul>
            </div>
          </li>

          @if(auth()->user()->rights_group == 1)
          <li class="nav-item">
            <a class="nav-link {{ $activePage == 'garages' ? 'active' : '' }}" href="#navbar-garages" data-toggle="collapse" role="button" aria-expanded="{{ $activePage == 'garages' ? 'true' : 'false' }}" aria-controls="navbar-garages">
              <i class="fa fa-building text-blue"></i>
              <span class="nav-link-text">Garages</span>
            </a>
            <div class="collapse {{ $activePage == 'garages' ? 'show' : 'hide' }}" id="navbar-garages">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="{{ route('garages.index')}}" class="nav-link">
                    <i class="ni ni-bullet-list-67 text-blue"></i>
                    View
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('garages.create')}}" class="nav-link">
                    <i class="ni ni-fat-add text-blue"></i>
                    Add Garage
                  </a>
                </li>
              </ul>
            </div>
          </li>
          @endif

          <li class="nav-item">
            <a class="nav-link {{ $activePage == 'service' ? 'active' : '' }}" href="#navbar-service" data-toggle="collapse" role="button" aria-expanded="{{ $activePage == 'services' ? 'true' : 'false' }}" aria-controls="navbar-service">
              <i class="fa fa-tools text-blue"></i>
              <span class="nav-link-text">Car Service</span>
            </a>
            <div class="collapse {{ $activePage == 'service' ? 'show' : 'hide' }}" id="navbar-service">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="{{ route('service.index')}}" class="nav-link">
                    <i class="ni ni-bullet-list-67 text-blue"></i>
                    View
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('service.create')}}" class="nav-link">
                    <i class="ni ni-fat-add text-blue"></i>
                    Add Service
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $activePage == 'stocks' ? 'active' : '' }}" href="#navbar-stocks" data-toggle="collapse" role="button" aria-expanded="{{ $activePage == 'stocks' ? 'true' : 'false' }}" aria-controls="navbar-stocks">
              <i class="fa fa-archive text-blue"></i>
              <span class="nav-link-text">Stocks</span>
            </a>
            <div class="collapse {{ $activePage == 'stocks' ? 'show' : 'hide' }}" id="navbar-stocks">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="{{ route('stocks.index')}}" class="nav-link">
                    <i class="ni ni-bullet-list-67 text-blue"></i>
                    View
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('stocks.create')}}" class="nav-link">
                    <i class="ni ni-fat-add text-blue"></i>
                    Add Stock
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ $activePage == 'vehicles' ? 'active' : '' }}" href="#navbar-vehicles" data-toggle="collapse" role="button" aria-expanded="{{ $activePage == 'vehicles' ? 'true' : 'false' }}" aria-controls="navbar-vehicles">
              <i class="fa fa-car text-blue"></i>
              <span class="nav-link-text">Vehicles</span>
            </a>
            <div class="collapse {{ $activePage == 'vehicles' ? 'show' : 'hide' }}" id="navbar-vehicles">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="{{ route('vehicle.index')}}" class="nav-link">
                    <i class="ni ni-bullet-list-67 text-blue"></i>
                    View
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('vehicle.create')}}" class="nav-link">
                    <i class="ni ni-fat-add text-blue"></i>
                    Add Vehicle
                  </a>
                </li>
              </ul>
            </div>
          </li>
          @endif
          <div class="dropdown-divider"></div>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="ni ni-button-power text-blue"></i>
                  <span>{{ __('Logout') }}</span>
              </a>
          </li>
        </ul>
      </div>

    </div>
  </div>
</nav>
