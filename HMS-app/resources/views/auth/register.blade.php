<x-guest-layout title="Register">
    <style>
        .register-page { min-height: 100vh; padding: 2rem 1rem; background: #f5f8fb; }
        .register-shell { display: grid; max-width: 1080px; margin: 0 auto; overflow: hidden; border: 1px solid #e1e8ed; border-radius: 24px; background: #fff; box-shadow: 0 22px 55px rgba(16, 42, 67, .13); }
        .register-visual { position: relative; display: flex; min-height: 280px; align-items: flex-end; padding: clamp(2rem, 5vw, 4rem); background: linear-gradient(180deg, rgba(16, 42, 67, .08), rgba(16, 42, 67, .86)), url('https://images.unsplash.com/photo-1551076805-e1869033e561?auto=format&fit=crop&w=1200&q=85') center/cover; }
        .register-visual-content { max-width: 27rem; color: #fff; }
        .register-eyebrow { margin-bottom: .75rem; color: #8de3df; font-size: .78rem; font-weight: 800; letter-spacing: .14em; }
        .register-visual h1 { margin: 0; font-size: clamp(2rem, 4vw, 3.25rem); font-weight: 800; line-height: 1.08; }
        .register-visual p { margin: 1rem 0 0; color: #e6fffa; font-size: 1.05rem; line-height: 1.65; }
        .register-form-panel { padding: clamp(1.5rem, 5vw, 3.5rem); }
        .register-form-wrap { max-width: 34rem; margin: 0 auto; }
        .register-brand-row { display: flex; align-items: flex-end; gap: 0; margin-bottom: 1.25rem; color: #2cb1bc; font-size: 1rem; font-weight: 800; letter-spacing: .1em; }
        .register-brand { display: block; width: 4rem; height: 4rem; margin-right: -.1rem; object-fit: contain; }
        .register-brand-row span { margin-bottom: .55rem; }
        .register-title { margin: 0; color: #102a43; font-size: clamp(1.8rem, 4vw, 2.35rem); font-weight: 800; line-height: 1.05; }
        .register-copy { margin: .6rem 0 2rem; color: #627d98; }
        .register-label { display: block; margin-bottom: .45rem; color: #243b53; font-size: .9rem; font-weight: 800; }
        .register-input, .register-select { width: 100%; min-height: 3.1rem; border: 1px solid #bcccdc; border-radius: 12px; color: #102a43; }
        .register-input:focus, .register-select:focus { border-color: #2cb1bc; box-shadow: 0 0 0 .2rem rgba(44, 177, 188, .18); }
        .register-submit { min-height: 3.25rem; border: 0; border-radius: 12px; background: #102a43; font-weight: 800; }
        .register-submit:hover, .register-submit:focus { background: #2cb1bc; color: #102a43; }
        .register-footer { margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid #e1e8ed; color: #627d98; font-size: .92rem; text-align: center; }
        .register-link { color: #486581; font-weight: 700; text-decoration: none; }
        .register-link:hover { color: #2cb1bc; }
        @media (min-width: 768px) { .register-page { padding: 3rem 1.5rem; } .register-shell { grid-template-columns: minmax(0, 1.08fr) minmax(430px, .92fr); } .register-visual { min-height: 760px; } }
    </style>

    <main class="register-page">
        <div class="register-shell">
            <section class="register-visual" aria-label="Healthcare registration">
                <div class="register-visual-content">
                    <h1>Start your care journey.</h1>
                    <p>Create your patient account to find departments, reserve appointments, and keep your care organized.</p>
                </div>
            </section>

            <section class="register-form-panel">
                <div class="register-form-wrap">
                    <div class="register-brand-row">
                        <img class="register-brand" src="{{ asset('assets/logo.png') }}" alt="eAppointment Care logo">
                        <span>eAppointment Care</span>
                    </div>
                    <h2 class="register-title">Create your patient account</h2>
                    <p class="register-copy">Add your details to get started with eAppointment Care.</p>

                    <x-jet-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label class="register-label" for="name">{{ __('Name') }}</label>
                <x-jet-input id="name" class="register-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <label class="register-label" for="email">{{ __('Email') }}</label>
                <x-jet-input id="email" class="register-input" type="email" name="email" :value="old('email')" required placeholder="email address" />
            </div>

            <div class="mt-4">
                <label class="register-label" for="date_of_birth">{{ __('Date of Birth') }}</label>
                <x-jet-input id="date_of_birth" class="register-input" type="date" name="date_of_birth" :value="old('date_of_birth')" required />
            </div>

            <div class="mt-4">
                <label class="register-label" for="blood_group">{{ __('Blood Group') }}</label>
                <select id="blood_group" name="blood_group" class="register-select" required>
                    <option value="">Select blood group</option>
                    @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bloodGroup)
                        <option value="{{ $bloodGroup }}" @selected(old('blood_group') === $bloodGroup)>{{ $bloodGroup }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <label class="register-label" for="phone">{{ __('Phone') }}</label>
                <x-jet-input id="phone" class="register-input" type="tel" name="phone" :value="old('phone', '+880')" required autocomplete="tel" placeholder="+8801XXXXXXXXX" pattern="\+8801[3-9][0-9]{8}" minlength="14" maxlength="14" title="Enter an 11-digit Bangladesh mobile number starting with +880, for example +8801712345678" />
            </div>

            <div class="mt-4">
                <label class="register-label" for="password">{{ __('Password') }}</label>
                <x-jet-input id="password" class="register-input" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <label class="register-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                <x-jet-input id="password_confirmation" class="register-input" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-between mt-6">
                <x-jet-button class="register-submit">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>

                    <div class="register-footer">
                        Already have an account?
                        <a class="register-link" href="{{ route('login') }}">Sign in here</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        const phoneInput = document.getElementById('phone');

        phoneInput.addEventListener('input', function () {
            const digits = this.value.replace(/\D/g, '');
            const localNumber = digits.startsWith('880') ? digits.slice(3) : digits;

            this.value = '+880' + localNumber.slice(0, 10);
        });
    </script>
</x-guest-layout>
