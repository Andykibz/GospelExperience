<!--==========================
  Header
============================-->
<header id="header">
  <div class="container">

    <div id="logo" class="pull-left">
      <!-- Uncomment below if you prefer to use a text logo -->
      <a href="{{ route('home') }}" class="img-fluid scrollto">
        <img src="{{asset('img/logoYW.png')}}" alt="" title="">
        <h4 class="branding text-light d-inline">{{ __('GospelExperience') }}</h4>
      </a>

      {{-- <h1><a  href="{{ route('home') }}">Gos<span>Ex</span>el<span>nce</span></a></h1> --}}
    </div>

    <nav id="nav-menu-container">
      <ul class="nav-menu">
        <li class="{{ $home_active ?? '' }}"><a href="{{ route('home') }}">Home</a></li>
        <li class="{{ $event_active ?? '' }}"><a href="{{ route('front.events') }}">Events</a></li>
        <li class="{{ $artist_active ?? '' }}"><a href="{{ route('front.artists') }}">Artists</a></li>
        <li class="{{ $sermon_active ?? '' }}"><a href="{{ route('front.sermons') }}">Sermons</a></li>
        <li class="{{ $media_active ?? '' }}"><a href="{{ route('front.media') }}">Media</a></li>
        @if (Auth::check())
        @if ( Auth::user()->can('create_event') )
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ ucfirst(Auth::user()->name) }} <span class="caret"></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-right usermenu list-list-unstyled" aria-labelledby="navbarDropdown">
                  @if (Auth::user()->can('create_event'))
                    <li>
                      <a class="dropdown-item" href="{{ route('admin.') }}" >
                          {{ __('Admin') }}
                      </a>
                      </li>
                  @endif
                  <li>

                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                </li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </ul>
          </li>
        @endif
        @endif
        {{-- <li><a href="#contact">Contact</a></li> --}}
      </ul>
    </nav><!-- #nav-menu-container -->
  </div>
</header><!-- #header -->
