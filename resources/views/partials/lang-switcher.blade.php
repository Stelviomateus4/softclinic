{{-- Language switcher: English (UK) / Portuguese (Portugal) --}}
@php($current = app()->getLocale())
<div class="ss-lang {{ $class ?? '' }}" role="group" aria-label="{{ __('ui.language') }}">
    <a
        href="{{ route('locale.switch', 'en') }}"
        class="ss-lang-btn {{ $current === 'en' ? 'is-active' : '' }}"
        title="{{ __('ui.english') }}"
        aria-label="{{ __('ui.english') }}"
        hreflang="en"
    >
        <span class="ss-flag ss-flag-en" aria-hidden="true">
            <svg viewBox="0 0 60 40" xmlns="http://www.w3.org/2000/svg">
                <rect width="60" height="40" fill="#012169"/>
                <path d="M0,0 L60,40 M60,0 L0,40" stroke="#fff" stroke-width="8"/>
                <path d="M0,0 L60,40 M60,0 L0,40" stroke="#C8102E" stroke-width="5"/>
                <path d="M30,0 V40 M0,20 H60" stroke="#fff" stroke-width="14"/>
                <path d="M30,0 V40 M0,20 H60" stroke="#C8102E" stroke-width="8"/>
            </svg>
        </span>
        <span class="ss-lang-code">EN</span>
    </a>
    <a
        href="{{ route('locale.switch', 'pt') }}"
        class="ss-lang-btn {{ $current === 'pt' ? 'is-active' : '' }}"
        title="{{ __('ui.portuguese') }}"
        aria-label="{{ __('ui.portuguese') }}"
        hreflang="pt"
    >
        <span class="ss-flag ss-flag-pt" aria-hidden="true">
            <svg viewBox="0 0 60 40" xmlns="http://www.w3.org/2000/svg">
                <rect width="60" height="40" fill="#006600"/>
                <rect x="24" width="36" height="40" fill="#FF0000"/>
                <circle cx="24" cy="20" r="7.5" fill="#FFCC00"/>
                <circle cx="24" cy="20" r="5" fill="#FF0000"/>
                <circle cx="24" cy="20" r="3" fill="#fff"/>
            </svg>
        </span>
        <span class="ss-lang-code">PT</span>
    </a>
</div>
