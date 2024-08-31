<x-guest-layout>
    @section('title', 'Login Page')
    <div class="min-w-96 ml-8 mt-14">
        <h2 class="text-3xl font-bold font-serif">Selamat Datang !</h2>
        <p class="text-sm font-semibold mt-1.5">Silahkan login akun anda</p>
        <!-- Session Status -->
        <div class="mt-36">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="NIP" :value="__('NIP')" />
                    <x-text-input id="NIP" class="block mt-1 w-full" type="text" name="NIP" :value="old('NIP')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('NIP')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
