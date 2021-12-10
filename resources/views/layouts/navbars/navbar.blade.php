@auth()
  @if (isset($activePage) && $activePage == 'home')
    @include('layouts.navbars.navs.dashboard')
  @else
    @include('layouts.navbars.navs.general')
  @endif
@endauth

@guest()
    @include('layouts.navbars.navs.guest')
@endguest
