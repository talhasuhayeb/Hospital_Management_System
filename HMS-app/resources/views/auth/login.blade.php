<x-guest-layout>
    <style>
        .login-page {
            min-height: 100vh;
            padding: 2rem 1rem;
            background: #f5f8fb;
        }

        .login-shell {
            display: grid;
            max-width: 1080px;
            min-height: 680px;
            margin: 0 auto;
            overflow: hidden;
            border: 1px solid #e1e8ed;
            border-radius: 24px;
            background: #fff;
            box-shadow: 0 22px 55px rgba(16, 42, 67, .13);
        }

        .login-visual {
            position: relative;
            display: flex;
            min-height: 300px;
            align-items: flex-end;
            padding: clamp(2rem, 5vw, 4rem);
            background: linear-gradient(180deg, rgba(16, 42, 67, .08), rgba(16, 42, 67, .86)), url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=85') center/cover;
        }

        .login-visual-content {
            position: relative;
            max-width: 27rem;
            color: #fff;
        }

        .login-eyebrow {
            margin-bottom: .75rem;
            color: #8de3df;
            font-size: .78rem;
            font-weight: 800;
            letter-spacing: .14em;
        }

        .login-visual h1 {
            margin: 0;
            font-size: clamp(2rem, 4vw, 3.25rem);
            font-weight: 800;
            line-height: 1.08;
        }

        .login-visual p {
            margin: 1rem 0 0;
            color: #e6fffa;
            font-size: 1.05rem;
            line-height: 1.65;
        }

        .login-form-panel {
            display: flex;
            align-items: center;
            padding: clamp(1.5rem, 5vw, 4rem);
        }

        .login-form-wrap {
            width: 100%;
            max-width: 27rem;
            margin: 0 auto;
        }

        .login-brand {
            display: inline-flex;
            width: 3rem;
            height: 3rem;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            border-radius: 14px;
            background: #2cb1bc;
            color: #102a43;
            font-size: 1.5rem;
            font-weight: 800;
        }

        .login-title {
            margin: 0;
            color: #102a43;
            font-size: clamp(1.8rem, 4vw, 2.35rem);
            font-weight: 800;
            line-height: 1.05;
        }

        .login-copy {
            margin: .6rem 0 2rem;
            color: #627d98;
        }

        .login-label {
            display: block;
            margin-bottom: .45rem;
            color: #243b53;
            font-size: .9rem;
            font-weight: 800;
        }

        .login-input {
            width: 100%;
            min-height: 3.25rem;
            border: 1px solid #bcccdc;
            border-radius: 12px;
            color: #102a43;
        }

        .login-input:focus {
            border-color: #2cb1bc;
            box-shadow: 0 0 0 .2rem rgba(44, 177, 188, .18);
        }

        .login-submit {
            min-height: 3.25rem;
            border: 0;
            border-radius: 12px;
            background: #102a43;
            font-weight: 800;
        }

        .login-submit:hover,
        .login-submit:focus {
            background: #2cb1bc;
            color: #102a43;
        }

        .login-link {
            color: #486581;
            font-size: .9rem;
            font-weight: 700;
            text-decoration: none;
        }

        .login-link:hover {
            color: #2cb1bc;
        }

        .login-register {
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid #e1e8ed;
            color: #627d98;
            font-size: .92rem;
            text-align: center;
        }

        @media (min-width: 768px) {
            .login-page {
                padding: 3rem 1.5rem;
            }

            .login-shell {
                grid-template-columns: minmax(0, 1.08fr) minmax(360px, .92fr);
            }

            .login-visual {
                min-height: 680px;
            }
        }
    </style>

    <main class="login-page">
        <div class="login-shell">
            <section class="login-visual" aria-label="Healthcare welcome">
                <div class="login-visual-content">
                    <div class="login-eyebrow">eAppointment Care</div>
                    <h1>Care that fits your life.</h1>
                    <p>Connect with the right department, choose a convenient time, and keep your appointments close at hand.</p>
                </div>
            </section>

            <section class="login-form-panel">
                <div class="login-form-wrap">
                    <div class="login-brand" aria-hidden="true">+</div>
                    <h2 class="login-title">Access your care portal</h2>
                    <p class="login-copy">Sign in to manage your appointments.</p>

                    <x-jet-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <label class="login-label" for="email">{{ __('Email address') }}</label>
                            <x-jet-input id="email" class="login-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" placeholder="email address" />
                        </div>

                        <div class="mt-4">
                            <label class="login-label" for="password">{{ __('Password') }}</label>
                            <x-jet-input id="password" class="login-input" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
                        </div>

                        <div class="flex items-center justify-between mt-5">
                            <label for="remember_me" class="flex items-center">
                                <x-jet-checkbox id="remember_me" name="remember" />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a id="forgot-password-link" class="login-link" href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
                            @endif
                        </div>

                        <x-jet-button class="login-submit w-full mt-6">
                            {{ __('Log in') }}
                        </x-jet-button>
                    </form>

                    <div class="login-register">
                        New to eAppointment Care?
                        <a class="login-link" href="{{ route('register') }}">Create an account</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        const forgotPasswordLink = document.getElementById('forgot-password-link');
        const loginEmailInput = document.getElementById('email');

        if (forgotPasswordLink && loginEmailInput) {
            forgotPasswordLink.addEventListener('click', function (event) {
                const email = loginEmailInput.value.trim();

                if (email) {
                    event.preventDefault();
                    window.location.assign(`${this.href}?email=${encodeURIComponent(email)}`);
                }
            });
        }
    </script>
</x-guest-layout>