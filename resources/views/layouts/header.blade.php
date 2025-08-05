<header>
    <nav class="nav-container">
        <!--Website Logo-->
        <div class="logo">{{ __('messages.web-app-name') }}</div>

        <!-- Language Dropdown (Mobile Friendly) -->
        <div class="translation-globe-logo">
            <div class="lang-dropdown">
                <button class="lang-toggle" aria-label="Language Selector">
                    🌐
                </button>
            </div>
        </div>

        <!-- Hamburger Menu (Mobile Friendly) -->
        <div class="hamburger" id="hamburger">&#9776;</div>

        <!-- Main Navigation Links -->

        <ul class="navbar" id="navbar">
            <li><a href="{{ route('home', ['lang' => app()->getLocale()]) }}"
                    class="nav-link {{ request()->is('/') ? 'active' : '' }}">{{ __('messages.home') }}</a></li>
            <li><a href="{{ route('guide', ['lang' => app()->getLocale()]) }}"
                    class="nav-link {{ request()->is('guide*') ? 'active' : '' }}">{{ __('messages.guide') }}</a></li>
            <li><a href="{{ route('guru-stuti', ['lang' => app()->getLocale()]) }}"
                    class="nav-link {{ request()->is('guru-stuti*') ? 'active' : '' }}">{{ __('messages.guru-stuti') }}</a>
            </li>
            <li><a href="{{ route('philosophy', ['lang' => app()->getLocale()]) }}"
                    class="nav-link {{ request()->is('philosophy*') ? 'active' : '' }}">{{ __('messages.philosophy') }}</a>
            </li>
            <!--
            <li><a href="{{ route('sukhsma-vyayama', ['lang' => app()->getLocale()]) }}" class="nav-link {{ request()->is('sukhsma-vyayama*') ? 'active' : '' }}">{{ __('messages.sukhsmavyayama') }}</a></li>
            <li><a href="{{ route('sthula-vyayama', ['lang' => app()->getLocale()]) }}" class="nav-link {{ request()->is('sthula-vyayama*') ? 'active' : '' }}">{{ __('messages.sthulavyayama') }}</a></li>
            -->
            <li><a href="{{ route('show-asana', ['lang' => app()->getLocale()]) }}"
                    class="nav-link {{ request()->is('show-asana*') ? 'active' : '' }}">{{ __('messages.show-asana') }}</a>
            </li>
            <li><a href="{{ route('gallery', ['lang' => app()->getLocale()]) }}"
                    class="nav-link {{ request()->is('gallery*') ? 'active' : '' }}">{{ __('messages.gallery') }}</a>
            </li>
            <li><a href="{{ route('videos', ['lang' => app()->getLocale()]) }}"
                    class="nav-link {{ request()->is('videos*') ? 'active' : '' }}">{{ __('messages.videos') }}</a>
            </li>
            <li><a href="{{ route('info', ['lang' => app()->getLocale()]) }}"
                    class="nav-link {{ request()->is('info*') ? 'active' : '' }}">{{ __('messages.info') }}</a></li>
            <li><a href="{{ route('contact', ['lang' => app()->getLocale()]) }}"
                    class="nav-link {{ request()->is('contact*') ? 'active' : '' }}">{{ __('messages.contact-us') }}</a>
            </li>
        </ul>

        <div class="language-switch" id="languageSwitch">
            @php $currentLocale = app()->getLocale(); @endphp
            @php $currentRoute = request()->route() ? request()->route()->getName() : ''; @endphp
            <a href="{{ $currentRoute === 'home' ? '/en' : route($currentRoute, ['lang' => 'en']) }}"
                class="lang {{ $currentLocale === 'en' ? 'highlight' : '' }}">{{ __('messages.English') }}</a> 
            <a href="{{ $currentRoute === 'home' ? '/fi' : route($currentRoute, ['lang' => 'fi']) }}"
                class="lang {{ $currentLocale === 'fi' ? 'highlight' : '' }}">{{ __('messages.Finnish') }}</a> 
            <a href="{{ $currentRoute === 'home' ? '/np' : route($currentRoute, ['lang' => 'np']) }}"
                class="lang {{ $currentLocale === 'np' ? 'highlight' : '' }}">{{ __('messages.NP') }}</a>
        </div>
    </nav>

    <style>
        header {
            width: 100%;
            background: #1B4D3F;
            color: #fff;
            padding: 0.7rem 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            z-index: 10;
            position: relative;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 0 1rem;
        }

        .logo {
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: 1px;
        }

        .navbar {
            display: flex;
            gap: 1rem;
            list-style: none;
            margin: 0;
            padding: 0;
            flex-wrap: wrap;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-link.active {
            border-bottom: 2px solid #fff;
        }

        /* .language-switch {
            display: none;
            gap: 0.5rem;
            align-items: center;
            /* margin-left: 1rem; 
        } */

        .language-switch {
                display: none;
                flex-direction: column;
                background: #155e4b;
                position: absolute;
                border-radius: 8px;
                margin-top: 14.5px;
                top: 60px;
                right: 390px;
                width: 10%;
                padding: 1rem;
                z-index: 999;
            }

        .lang {
            color: #fff;
            font-weight: 600;
        }

        .lang.highlight {
            color: #FFD700;
        }

        .lang-dropdown {
            position: relative;
            display: inline-block;
        }

        .lang-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: white;
        }

        .language-switch.show {
                display: flex;
            }

            /*
        .lang-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: #1B4D3F;
            border: 1px solid #ccc;
            border-radius: 4px;
            list-style: none;
            padding: 0.5rem 0;
            margin: 0;
            display: none;
            z-index: ;
            min-width: 100px;
        }

        .lang-menu li {
            padding: 0.3rem 1rem;
        }

        .lang-menu li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: block;
        }

        .lang-menu li:hover {
            background: #155e4b;
        }
            */

        .lang-dropdown.open .lang-menu {
            display: block;
        }

        .hamburger {
            display: none;
            font-size: 1.8rem;
            cursor: pointer;
            color: white;
        }

        /* Other Devices Type*/
        /*For my Mobile Screen */
        /* Extra small devices (portrait phones, <576px) */
        @media (max-width: 575.98px) {
            nav {
                padding: 0 0.2rem;
            }

            .navbar {
                gap: 0.4rem;
                font-size: 0.98rem;
            }

            .navbar,
            .language-switch {
                display: none;
                flex-direction: column;
                background: #155e4b;
                position: absolute;
                border-radius: 8px;
                margin-top: 14.5px;
                top: 60px;
                left: 0;
                width: 60%;
                padding: 1rem;
                z-index: 999;
            }

            .navbar.show,
            .language-switch.show {
                display: flex;
            }

            main {
                margin-top: 0.7rem;
            }

            .hamburger {
                display: block;
                cursor: pointer;
                font-size: 1.5rem;
                color: white;
                margin-right: 5px;
            }
        }

        /*For tablet vertical Screen */
        /* Small devices (phones, ≥576px and <768px) */
        @media (min-width: 576px) and (max-width: 767.98px) {
            nav {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .navbar {
                gap: 0.7rem;
                font-size: 1rem;
                border-radius: 2px;
            }

            .language-switch {
                margin-left: 0;
                margin-top: 0.5rem;
            }

            .navbar,
            .language-switch {
                display: none;
                flex-direction: column;
                background: #222;
                position: absolute;
                top: 60px;
                left: 0;
                width: 40%;
                padding: 1rem;
                z-index: 999;
            }

            .navbar.open .navbar,
            .navbar.open .language-switch {
                display: flex;
            }

            .navbar li a {
                border-radius: 8px;
                padding: 0.5rem 1rem;
                display: block;
            }

            .navbar.show,
            .language-switch.show {
                display: flex;
            }

            .hamburger {
                display: block;
                cursor: pointer;
                font-size: 1.5rem;
                color: white;
            }
        }

        /*For my Tablet  */
        /* Medium devices (tablets, ≥768px and <992px) */
        @media (min-width: 768px) and (max-width: 991.98px) {
            nav {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .navbar {
                gap: 0.7rem;
                font-size: 1rem;
            }

            .language-switch {
                margin-left: 0;
                margin-top: 0.5rem;
            }

            .navbar,
            .language-switch {
                display: none;
                flex-direction: column;
                background: #222;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                padding: 1rem;
                z-index: 999;
            }

            .navbar.open .navbar,
            .navbar.open .language-switch {
                display: flex;
            }

            .navbar.show,
            .language-switch.show {
                display: flex;
            }

            .hamburger {
                display: block;
                cursor: pointer;
                font-size: 1.5rem;
                color: white;
            }
        }

        /* Large devices (laptops/desktops, ≥992px and <1200px) */
        /*For my Laptop  */
        @media (min-width: 992px) and (max-width: 1199.98px) {
            .hamburger {
                display: none;
            }
            .translation-globe-logo{
                /* display: none; */
                order: 2;
            }
        }

        /* Extra large devices (large desktops, ≥1200px) */
        /*For my Large Monitor*/
        @media (min-width: 1200px) {
            .hamburger {
                display: none;
            }
            .translation-globe-logo{
                order: 2;
                /* display: none; */
            }
        }
    </style>
</header>





    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const hamburger = document.querySelector(".hamburger");
        const navbar = document.querySelector(".navbar");
        const languageSwitch = document.querySelector(".language-switch");
        const langToggle = document.querySelector(".lang-toggle");

        // Hamburger click
        hamburger.addEventListener("click", () => {
            const isNavbarOpen = navbar.classList.contains("show");

            // Close language dropdown
            languageSwitch.classList.remove("show");

            // Toggle navbar
            navbar.classList.toggle("show", !isNavbarOpen);
        });

        // Language toggle click
        langToggle.addEventListener("click", () => {
            const isLanguageOpen = languageSwitch.classList.contains("show");

            // Close navbar
            navbar.classList.remove("show");

            // Toggle language dropdown
            languageSwitch.classList.toggle("show", !isLanguageOpen);
        });
    });


    /*
    document.addEventListener("DOMContentLoaded", function() {
        const langToggle = document.querySelector(".lang-toggle");
        const langDropdown = document.querySelector(".lang-dropdown");

        langToggle.addEventListener("click", function(e) {
            e.stopPropagation();
            langDropdown.classList.toggle("open");
        });

        document.addEventListener("click", function(e) {
            if (!langDropdown.contains(e.target)) {
                langDropdown.classList.remove("open");
            }
        });

        const hamburger = document.getElementById("hamburger");
        const navbar = document.getElementById("navbar");
        const languageSwitch = document.getElementById("languageSwitch");

        hamburger.addEventListener("click", function() {
            console.log("Yes it is Clicked");
            navbar.classList.toggle("show");
            // languageSwitch.classList.toggle("show");
        });
    });*/
</script>
