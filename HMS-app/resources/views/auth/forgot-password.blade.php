<x-guest-layout>
    <style>
        .reset-page { min-height: 100vh; padding: 2rem 1rem; background: #f5f8fb; }
        .reset-shell { display: grid; max-width: 1080px; min-height: 640px; margin: 0 auto; overflow: hidden; border: 1px solid #e1e8ed; border-radius: 24px; background: #fff; box-shadow: 0 22px 55px rgba(16, 42, 67, .13); }
        .reset-visual { position: relative; display: flex; min-height: 280px; align-items: flex-end; padding: clamp(2rem, 5vw, 4rem); background: linear-gradient(180deg, rgba(16, 42, 67, .08), rgba(16, 42, 67, .86)), url('https://images.unsplash.com/photo-1584982751601-97dcc096659c?auto=format&fit=crop&w=1200&q=85') center/cover; }
        .reset-visual-content { max-width: 27rem; color: #fff; }
        .reset-eyebrow { margin-bottom: .75rem; color: #8de3df; font-size: .78rem; font-weight: 800; letter-spacing: .14em; }
        .reset-visual h1 { margin: 0; font-size: clamp(2rem, 4vw, 3.25rem); font-weight: 800; line-height: 1.08; }
        .reset-visual p { margin: 1rem 0 0; color: #e6fffa; font-size: 1.05rem; line-height: 1.65; }
        .reset-form-panel { display: flex; align-items: center; padding: clamp(1.5rem, 5vw, 4rem); }
        .reset-form-wrap { width: 100%; max-width: 27rem; margin: 0 auto; }
        .reset-brand { display: inline-flex; width: 3rem; height: 3rem; align-items: center; justify-content: center; margin-bottom: 1.25rem; border-radius: 14px; background: #2cb1bc; color: #102a43; font-size: 1.5rem; font-weight: 800; }
        .reset-title { margin: 0; color: #102a43; font-size: clamp(1.8rem, 4vw, 2.35rem); font-weight: 800; line-height: 1.05; }
        .reset-copy { margin: .6rem 0 2rem; color: #627d98; line-height: 1.6; }
        .reset-label { display: block; margin-bottom: .45rem; color: #243b53; font-size: .9rem; font-weight: 800; }
        .reset-input { width: 100%; min-height: 3.25rem; border: 1px solid #bcccdc; border-radius: 12px; color: #102a43; }
        .reset-input:focus { border-color: #2cb1bc; box-shadow: 0 0 0 .2rem rgba(44, 177, 188, .18); }
        .reset-submit { min-height: 3.25rem; border: 0; border-radius: 12px; background: #102a43; font-weight: 800; }
        .reset-submit:hover, .reset-submit:focus { background: #2cb1bc; color: #102a43; }
        .reset-footer { margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid #e1e8ed; color: #627d98; font-size: .92rem; text-align: center; }
        .reset-link { color: #486581; font-weight: 700; text-decoration: none; }
        .reset-link:hover { color: #2cb1bc; }
        @media (min-width: 768px) { .reset-page { padding: 3rem 1.5rem; } .reset-shell { grid-template-columns: minmax(0, 1.08fr) minmax(360px, .92fr); } .reset-visual { min-height: 640px; } }
    </style>

    <main class="reset-page">
        <div class="reset-shell">
            <section class="reset-visual" aria-label="Password recovery">
                <div class="reset-visual-content">
                    <div class="reset-eyebrow">eAppointment Care</div>
                    <h1>Keep your care within reach.</h1>
                    <p>Reset your password securely and return to managing your appointments with confidence.</p>
                </div>
            </section>

            <section class="reset-form-panel">
                <div class="reset-form-wrap">
                    <div class="reset-brand" aria-hidden="true">+</div>
                    <h2 class="reset-title">Reset your password</h2>
                    <p class="reset-copy">Enter your registered email and we will send you a secure password reset link.</p>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">{{ session('status') }}</div>
                    @endif

                    <x-jet-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div>
                            <label class="reset-label" for="email">{{ __('Email address') }}</label>
                            @if(request('email'))
                                <x-jet-input id="email" class="reset-input bg-gray-100 cursor-not-allowed" type="email" :value="request('email')" placeholder="email address" autocomplete="email" disabled aria-disabled="true" title="This email was provided from the login page." />
                                <input type="hidden" name="email" value="{{ request('email') }}">
                            @else
                                <x-jet-input id="email" class="reset-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" placeholder="email address" />
                            @endif
                        </div>

                        <x-jet-button class="reset-submit w-full mt-6">
                            {{ __('Email Password Reset Link') }}
                        </x-jet-button>
                    </form>

                    <div class="reset-footer">
                        Remembered your password?
                        <a class="reset-link" href="{{ route('login') }}">Return to login</a>
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-guest-layout>
