<header>
    <nav class="nav-container">
        <!--Website Logo-->
        <div class="logo">
            <a href="{{ url('/') }}" class="logo">
                {{-- {{ __('messages.web-app-name') }} --}}
                <img src="/app-logo/app-logo-design_new.png" alt="Logo" />
            </a>
        </div>

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
            <li><a href="{{ route('home') }}"
                    class="nav-link {{ request()->is('/') ? 'active' : '' }}">{{ __('messages.home') }}</a></li>
            <li><a href="{{ route('guide') }}"
                    class="nav-link {{ request()->is('guide*') ? 'active' : '' }}">{{ __('messages.guide') }}</a></li>
            <!--
            <li><a href="{{ route('sukhsma-vyayama') }}" class="nav-link {{ request()->is('sukhsmavyayama*') ? 'active' : '' }}">{{ __('messages.sukhsmavyayama') }}</a></li>
            <li><a href="{{ route('sthula-vyayama') }}" class="nav-link {{ request()->is('sthulavyayama*') ? 'active' : '' }}">{{ __('messages.sthulavyayama') }}</a></li>
            -->
            <li><a href="{{ route('show-asana') }}"
                    class="nav-link {{ request()->is('show-asana*') ? 'active' : '' }}">{{ __('messages.show-asana') }}</a>
            </li>
            <li><a href="{{ route('gallery') }}"
                    class="nav-link {{ request()->is('gallery*') ? 'active' : '' }}">{{ __('messages.gallery') }}</a>
            </li>
            {{-- <li><a href="{{ route('videos') }}"
                    class="nav-link {{ request()->is('videos*') ? 'active' : '' }}">{{ __('messages.videos') }}</a>
            </li> --}}
            <!-- New Utility links-->
            {{-- <li><a href="{{ route('cover-letter') }}"
                    class="nav-link {{ request()->is('cover-letter*') ? 'active' : '' }}">{{ __('messages.cover-letter') }}</a>
            </li>
            <li><a href="{{ route('cv-generator') }}"
                    class="nav-link {{ request()->is('cv-generator*') ? 'active' : '' }}">{{ __('messages.cv-generator') }}</a></li>
            <li><a href="{{ route('currency-converter') }}"
                    class="nav-link {{ request()->is('currency-converter*') ? 'active' : '' }}">{{ __('messages.currency-converter') }}</a></li>
            <li><a href="{{ route('nepali-calendar') }}"
                    class="nav-link {{ request()->is('nepali-calendar*') ? 'active' : '' }}">{{ __('messages.nepali-calendar') }}</a>
            </li> --}}
            <li><a href="{{ route('mantra-shloka-bhajan') }}"
                    class="nav-link {{ request()->is('mantra*') ? 'active' : '' }}">{{ __('messages.mantra') }}</a>
            </li>
        </ul>

        <div class="language-switch" id="languageSwitch">
            @php $currentLocale = app()->getLocale(); @endphp
            <a href="{{ route('set-locale', 'en') }}"
                class="lang {{ $currentLocale === 'en' ? 'highlight' : '' }}">{{ __('messages.English') }}</a>
            <a href="{{ route('set-locale', 'fi') }}"
                class="lang {{ $currentLocale === 'fi' ? 'highlight' : '' }}">{{ __('messages.Finnish') }}</a>
            <a href="{{ route('set-locale', 'np') }}"
                class="lang {{ $currentLocale === 'np' ? 'highlight' : '' }}">{{ __('messages.NP') }}</a>
        </div>
    </nav>

    <style>/* === Base / Desktop-first styles === */
header {
  width: 100%;
  background: #1B4D3F;
  color: #fff;
  padding: 0.7rem 0;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
  position: relative;
  z-index: 10;
}

.nav-container {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 1rem;
}

img {
  width: 120px;
  height: auto;
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
  order: 2;
}

.nav-link {
  color: #fff;
  text-decoration: none;
  font-weight: 500;
}
.nav-link.active {
  border-bottom: 2px solid #fff;
}

.language-switch {
  display: none; /* hidden by default, toggled via JS */
  flex-direction: column;
  background: #155e4b;
  position: absolute;
  border-radius: 8px;
  top: 60px;
  right: 390px;
  width: 10%;
  padding: 1rem;
  z-index: 999;
}
.navbar.show, .language-switch.show {
  display: flex;
}

.translation-globe-logo{ order: 3; } .logo{ order: 1; }



.hamburger {
  display: none; /* visible only on mobile */
  font-size: 1.8rem;
  cursor: pointer;
  color: white;
}

/* === Mobile first (phones <576px) === */
@media (max-width: 575.98px) {
  .navbar {
    display: none; /* hidden by default */
    flex-direction: column;
    background: #155e4b;
    position: absolute;
    top: 60px;
    left: 0;
    width: 60%;
    padding: 1rem;
    border-radius: 8px;
    background-color: #222;
  }
  .language-switch { display: none; flex-direction: column; background: #155e4b; position: absolute; border-radius: 8px; margin-top: 14.5px; top: 60px; left: 0; width: 60%; padding: 1rem; z-index: 999; }
  .navbar.show {
    display: flex;
  }
  .hamburger {
    display: block;
    cursor: pointer; font-size: 1.5rem; color: white; margin-right: 5px;
  }
  .nav-container{ display: flex; flex-direction: row; }

  .translation-globe-logo{ order: 3; } .logo{ order: 1; }
  
}

/* === Tablets (576px–767px) === */
@media (min-width: 576px) and (max-width: 767.98px) {
  .navbar {
    display: none;
    flex-direction: column;
    background: #000;
    position: absolute;
    top: 60px;
    left: 0;
    width: 60%;
    padding: 1rem;
    border-radius: 60px;
    background-color: #222;
  }
  
  .navbar.show {
    display: flex;
  }
  .hamburger {
    display: block;
  }
}

/* === Medium tablets (768px–991px) === */
@media (min-width: 768px) and (max-width: 991.98px) {
  .navbar {
    display: none;
    flex-direction: column;
    background-color: #222;
    position: absolute;
    top: 60px;
    left: 0;
    width: 100%;
    padding: 1rem;
  }
  .navbar.show {
    display: flex;
  }
  .hamburger {
    display: block;
  }
}

/* === Laptops (992px–1199px) === */
@media (min-width: 992px) {
  .hamburger {
    display: none;
  }
}

/* === Large desktops (≥1200px) === */
@media (min-width: 1200px) {
  .hamburger {
    display: none;
  }
}
    </style>
</header>





<script>
    document.addEventListener("DOMContentLoaded", function() {
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
