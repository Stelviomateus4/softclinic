<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0A3D3B">
    <title>{{ $setting->name ?? 'SoftClinic' }} — {{ __('ui.login') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/softsales.css') }}" rel="stylesheet">
</head>
<body class="ss-login">
    <div class="ss-login-page">
        <div class="ss-login-bg" aria-hidden="true"></div>

        @include('partials.lang-switcher', ['class' => 'ss-lang-login'])

        <div class="ss-login-shell">
            <div class="ss-login-brand ss-animate-in">
                <div class="ss-login-brand-mark">
                    <i class="fas fa-clinic-medical" aria-hidden="true"></i>
                </div>
                <h1>{{ $setting->name ?? 'SoftClinic' }}</h1>
                <p>{{ __('ui.brand_tagline') }}</p>
            </div>

            <div class="ss-login-form ss-animate-in-delay">
                @if ($success = Session::get('success'))
                    <div class="ss-alert ss-alert-success" role="status">{{ $success }}</div>
                @endif

                @if ($errors->any())
                    <div class="ss-alert ss-alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" autocomplete="on">
                    @csrf

                    <div class="ss-field">
                        <label class="ss-label" for="name">{{ __('ui.username') }}</label>
                        <input
                            id="name"
                            class="form-control ss-input"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            autofocus
                            required
                            placeholder="admin"
                        >
                    </div>

                    <div class="ss-field">
                        <label class="ss-label" for="password">{{ __('ui.password') }}</label>
                        <div class="ss-password-wrap">
                            <input
                                id="password"
                                class="form-control ss-input"
                                name="password"
                                type="password"
                                required
                                placeholder="••••••••"
                            >
                            <button type="button" class="ss-password-toggle" id="togglePassword" aria-label="{{ __('ui.show_password') }}">
                                {{ __('ui.show') }}
                            </button>
                        </div>
                    </div>

                    <div class="ss-field-row">
                        <label class="ss-check">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            {{ __('ui.remember_me') }}
                        </label>
                    </div>

                    <button type="submit" class="ss-btn ss-btn-primary ss-btn-block">
                        {{ __('ui.login') }}
                    </button>
                </form>
            </div>

            <div class="ss-login-credit ss-animate-in-delay">
                {{ __('ui.developed_by') }} <strong>Milton Manjate</strong><br>
                SoftSales Solutions ·
                <a href="https://github.com/miltonmanjate" target="_blank" rel="noopener">github.com/miltonmanjate</a>
            </div>
        </div>
    </div>

    <script>
        (function () {
            var toggle = document.getElementById('togglePassword');
            var input = document.getElementById('password');
            if (!toggle || !input) return;
            var showLabel = @json(__('ui.show'));
            var hideLabel = @json(__('ui.hide'));
            var showAria = @json(__('ui.show_password'));
            var hideAria = @json(__('ui.hide_password'));
            toggle.addEventListener('click', function () {
                var show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                toggle.textContent = show ? hideLabel : showLabel;
                toggle.setAttribute('aria-label', show ? hideAria : showAria);
            });
        })();
    </script>
</body>
</html>
