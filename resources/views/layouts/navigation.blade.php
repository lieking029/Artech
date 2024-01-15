<ul class="sidebar-nav mt-5" data-coreui="navigation" data-simplebar>

    @admin
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
                </svg>
                {{ __('Dashboard') }}
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-home nav-icon" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    style="height: 25px">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>
                {{ __('Virtual Gallery') }}
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('art.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                </svg>
                {{ __('Pending Arts') }}
            </a>
        </li>
    @endadmin

    @client
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-home nav-icon" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    style="height: 25px">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>
                {{ __('Virtual Gallery') }}
            </a>
        </li>
    @endclient

    <li class="nav-item">
        <a class="nav-link" href="{{ route('artpromp.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-brand-patreon nav-icon"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round" style="height: 25px;">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M20 8.408c-.003 -2.299 -1.746 -4.182 -3.79 -4.862c-2.54 -.844 -5.888 -.722 -8.312 .453c-2.939 1.425 -3.862 4.545 -3.896 7.656c-.028 2.559 .22 9.297 3.92 9.345c2.75 .036 3.159 -3.603 4.43 -5.356c.906 -1.247 2.071 -1.599 3.506 -1.963c2.465 -.627 4.146 -2.626 4.142 -5.273z" />
            </svg>
            {{ __('Art Prompt') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/chatify') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-message nav-icon" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                style="height: 25px;">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M8 9h8" />
                <path d="M8 13h6" />
                <path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
            </svg>
            {{ __('Messages') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('search.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-search nav-icon" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                style="height: 25px">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                <path d="M21 21l-6 -6" />
            </svg>
            {{ __('Search') }}
        </a>
    </li>
    <li class="nav-item">
        <a type="button" data-coreui-toggle="modal" data-coreui-target="#exampleModal" class="nav-link">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-library-plus nav-icon"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round" style="height: 25px">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M7 3m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                <path d="M4.012 7.26a2.005 2.005 0 0 0 -1.012 1.737v10c0 1.1 .9 2 2 2h10c.75 0 1.158 -.385 1.5 -1" />
                <path d="M11 10h6" />
                <path d="M14 7v6" />
            </svg>
            {{ __('Create Masterpiece') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('mypost.index') }}">
            <img src="{{ asset('icons/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg') }}" alt="img"
                style="height:30px" class="rounded-circle mx-1 me-3">
            {{ __('Profile') }}
        </a>
    </li>
</ul>
