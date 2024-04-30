<nav class="navbar navbar-expand-xl navCustom">
    <div class="container-fluid">
        <a class="nav-link white fw-bold fs-3 logo" aria-current="page" href="{{ route('homePage') }}"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="row collapse navbar-collapse" id="navbarSupportedContent">
            <div class="col-12">
                <ul class="navbar-nav mb-lg-0 navList">
                    <li class="nav-item px-2">
                        <a class="nav-link white {{ Route::currentRouteName() == 'indexAnnouncement' ? 'active' : '' }}"
                            href="{{ route('indexAnnouncement') }}">
                            {{ __('ui.allAnnouncements') }}</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link white {{ Route::currentRouteName() == 'createAnnouncement' ? 'active' : '' }}"
                            href="{{ route('createAnnouncement') }}">{{ __('ui.makeAnnouncements') }}</a>
                    </li>
                    <li class="nav-item px-2 dropdown">
                        <a class="nav-link white me-2" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-list-task pe-2"></i>{{ __('ui.categories') }}
                        </a>
                        <ul class="dropdown-menu" aria-describedby="categoriesDropdown">
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item drop-hover acc text-white"
                                        href="{{ route('showCategory', compact('category')) }}">{{ __("ui.$category->name") }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @auth
                        @if (Auth::user()->is_revisor)
                            <li class="nav-item px-2">
                                <a href="{{ route('indexRevisor') }}"
                                    class="nav-link position-relative white d-inline {{ Route::currentRouteName() == 'indexRevisor' ? 'active' : '' }}">{{ __('ui.revisorZone') }}
                                    <span
                                        class="position-absolute top-0 start-100  translate-middle badge rounded-pill bg-danger">{{ App\Models\Announcement::toBeRevisionedCount() }}
                                        <span class="visual-hidden"></span>
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endauth
                    <li class="nav-item px-2 py-2">
                        <form method="GET" action="{{ route('searchAnnouncements') }}" class="boxSearch d-flex">
                            <input type="search" name="searched" placeholder="search">
                            @csrf
                            <a href="" type="submit" class=" p-0 "><i class=" bi-search nav-link "></i></a>
                        </form>
                    </li>
                    <li class="nav-item px-2 py-1 dropdown ms-xl-auto">
                        <a class="nav-link white me-2" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-translate pe-2"> {{ __('ui.languages') }}</i>
                        </a>
                        <ul class="dropdown-menu py-0" aria-describedby="categoriesDropdown">
                            <li class="dropdown-item p-0">
                                <a class="nav-link  p-0"><x-locale lang="it" /></a>
                            </li>
                            <li class="dropdown-item p-0">
                                <a class="nav-link p-0"><x-locale lang="en" /></a>
                            </li>
                            <li class="dropdown-item p-0">
                                <a class="nav-link p-0"><x-locale lang="es" /></a>
                            </li>
                        </ul>
                    </li>
                    @auth
                        <li class="d-flex align-items-center py-1 px-2"><a class="text-uppercase white" href="#"
                                id="#"><i class="bi bi-person-fill pe-2"></i>{{ Auth::user()->name }}</a></li>
                    @else
                        <li class="d-flex align-items-center py-1 px-2"><a
                                class="white {{ Route::currentRouteName() == 'login' ? 'active' : '' }}"
                                href="{{ route('login') }}"><i class="bi bi-person"></i> {{__('ui.authenticate')}}</a>
                        </li>
                    @endauth
                    @guest
                    @else
                        <li class=" d-flex align-items-center py-1 px-2"><a class="white " href="{{ route('homePage') }}"
                                onclick="event.preventDefault(); document.querySelector('#form-logout').submit();">LOGOUT <i
                                    class="bi bi-door-open"></i></a>
                        </li>
                        <form action="{{ route('logout') }}" method="POST" id="form-logout" class="d-none">
                            @csrf
                        </form>
                    @endguest
                </ul>
            </div>



            {{-- <div class="col-12 col-md-4 d-flex justify-content-end">
                <ul class="navbar-nav px-3">
                    
                </ul>
            </div> --}}




            
        </div>
    </div>
</nav>
