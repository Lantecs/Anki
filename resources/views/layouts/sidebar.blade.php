<div class="sidebar" id="side_nav">
    <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
        <div class="container">
            <div class="container">
                <div class="container">
                    <div class="container">
                        <div class="container">
                            <div class="container">
                                <div class="container conlogo bg-light pt-2 pb-2">
                                    <img src="{{ asset('images/logo.png') }}" class="imgcon img-fluid" alt="Logo" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-box ps-3 pt-3 pb-4 d-flex">
        <img src="{{ asset(Auth::user()->user_image) }}" class="rounded-circle " height="80px" width="80px">
        <div class="ps-4 pt-2">
            <div class="name d-flex"> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
            <p class="fw-lighter text-white text-opacity-75">Up to date</p>
        </div>
    </div>

    <div class="header-box pt-3 pb-4 pe-2">
        <div class="container">
            <div class="d-flex {{ request()->is('home*') ? 'active' : '' }} hoveract">
                <a href="{{ route('home') }}" class="text-decoration-none px-3 py-2 d-block">
                    <img src="{{ Route::is('home') ? asset('images/home_active.png') : asset('images/home_notactive.png') }}"
                        alt="" width="30" height="30" />
                    Home
                </a>
            </div>
            <div class="d-flex {{ request()->is('studyboard*') ? 'active' : '' }} hoveract">
                <a href="{{ route('studyboard') }}" class="text-decoration-none px-3 py-2 d-block">
                    <img src="{{ Route::is('studyboard*') ? asset('images/studyboard_active.png') : asset('images/studyboard_notactive.png') }}"
                        alt="" width="30" height="30" />
                    Study board
                </a>
            </div>
            <div class="d-flex {{ request()->is('decksmanagement*') ? 'active' : '' }} hoveract">
                <a href="{{ route('decksmanagement') }}" class="text-decoration-none px-3 py-2 d-block">
                    <img src="{{ Route::is('decksmanagement*') ? asset('images/decksmanagement_active.png') : asset('images/decksmanagement_notactive.png') }}" alt="" width="30" height="30" />

                    Deck management
                </a>
            </div>
            <div class="d-flex {{ request()->is('statistics*') ? 'active' : '' }} hoveract">
                <a href="{{ route('statistics') }}" class="text-decoration-none px-3 py-2 d-block">
                    <img src="{{ Route::is('statistics*') ? asset('images/statistics_active.png') : asset('images/statistics_notactive.png') }}"
                        alt="" width="30" height="30" />
                    Statistics
                </a>
            </div>
            <div class="d-flex {{ request()->is('settings*') ? 'active' : '' }} hoveract">
                <a href="{{ route('settings') }}" class="text-decoration-none px-3 py-2 d-block">
                    <img src="{{ Route::is('settings*') ? asset('images/settings_active.png') : asset('images/settings_notactive.png') }}"
                        alt="" width="30" height="30" />

                    Settings
                </a>
            </div>

        </div>
    </div>
    <div class="header-box pt-5 pb-4 pe-2">
        <div class="container pt-5">
            <div class="d-flex {{ request()->is('logout*') ? 'active' : '' }} hoveract">
                <a href="{{ route('logout') }}" class="text-decoration-none px-3 py-2 d-block">
                    <img src="{{ Route::is('logout*') ? asset('images/logout_active.png') : asset('images/logout_notactive.png') }}"
                        alt="" width="30" height="30" />

                    Logout
                </a>
            </div>
        </div>
    </div>
</div>




<style>
    .sidebar .hoveract:hover {
        background: #1E4E82;
        border-radius: 5px;
        cursor: pointer;
    }

    .sidebar .header-box .d-flex.active a {
        color: #ffffff;
    }

    .sidebar .header-box .d-flex.active {
        background: #1E4E82;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .text-decoration-none {
        color: #d4e6f98b;
        font-size: 23px;
    }

    .text-decoration-none .active {
        color: #ffffff;
        font-size: 23px;
    }

    .text-decoration-none {
        color: #d4e6f98b;
        font-size: 23px;
    }

    .name {
        color: #ffffff;
        font-size: 20px;
        font-weight: 600;
    }

    .conlogo {
        border-radius: 10px;
    }

    .main-container {
        font-family: 'Inter', sans-serif;
    }

    #side_nav {
        font-family: 'Inter', sans-serif;
        background-color: #4A8AEA;
        border-right: 1px solid #DCD4D4;
        min-width: 300px;
        max-width: 300px;
        transition: all 0.3s;
    }

    .content {
        min-height: 100vh;
        width: 100%;
    }


    @media(max-width: 767px) {
        #side_nav {
            margin-left: -250px;
            position: absolute;
            min-height: 100vh;
            z-index: 1;
        }

        #side_nav.active {
            margin-left: 0;
        }
    }
</style>
