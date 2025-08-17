<div class="locale-switcher">
    <div class="dropdown">
        <button class="btn btn-outline-success dropdown-toggle" type="button" id="localeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="flag-icon flag-icon-{{ app()->getLocale() }}"></span>
            {{ strtoupper(app()->getLocale()) }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="localeDropdown">
            <li><a class="dropdown-item" href="{{ route('set-locale', 'en') }}">
                <span class="flag-icon flag-icon-en"></span> English
            </a></li>
            <li><a class="dropdown-item" href="{{ route('set-locale', 'fi') }}">
                <span class="flag-icon flag-icon-fi"></span> Suomi
            </a></li>
            <li><a class="dropdown-item" href="{{ route('set-locale', 'np') }}">
                <span class="flag-icon flag-icon-np"></span> नेपाली
            </a></li>
        </ul>
    </div>
</div>

<style>
.locale-switcher {
    display: inline-block;
}

.locale-switcher .btn {
    font-size: 0.9rem;
    padding: 0.375rem 0.75rem;
    border-color: #22c55e;
    color: #15803d;
}

.locale-switcher .btn:hover {
    background-color: #22c55e;
    border-color: #22c55e;
    color: white;
}

.locale-switcher .dropdown-item {
    padding: 0.5rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.locale-switcher .dropdown-item:hover {
    background-color: #f0fdf4;
    color: #15803d;
}

.flag-icon {
    width: 1.2em;
    height: 1.2em;
    border-radius: 2px;
    margin-right: 0.5rem;
}

.flag-icon-en {
    background: linear-gradient(to bottom, #012169 0%, #012169 50%, #fff 50%, #fff 100%);
}

.flag-icon-fi {
    background: linear-gradient(to right, #fff 0%, #fff 30%, #003580 30%, #003580 100%);
}

.flag-icon-np {
    background: linear-gradient(to bottom, #dc143c 0%, #dc143c 100%);
}
</style> 