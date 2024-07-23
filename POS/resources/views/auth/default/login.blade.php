<x-guest-layout>
    @php
        $type = app('request')->input('type');
    @endphp
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login', ['type' => $type]) }}">
        @csrf

        <!-- Input Login Email/ Username/ Phone-->

        <!-- Default using email -->
        @empty($type)
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        @endempty

        <!-- If $type is set-->
        @isset($type)
            <!-- Input login using username/ phone -->
            @if ($type == 'name')
                <div>
                    <x-input-label for="name" :value="__('Username')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="'username'" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            @elseif ($type == 'phone')
                <div>
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
            @endif
        @endisset

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Login Method Menu -->
        <div class="mt-4">
            <div class="text-center">
                <span class="text-gray-700 dark:text-gray-300">{{ __('Login with:') }}</span>

                @isset($type)
                    <a href="{{ url('/login') }}"
                        class="text-indigo-600 hover:text-indigo-400 hover:underline">{{ __('Email') }}</a>
                    <span class="text-gray-700 dark:text-gray-300"> | </span>

                    @if ($type == 'phone')
                        <a href="{{ url('/login?type=name') }}"
                            class="text-indigo-600 hover:text-indigo-400 hover:underline">{{ __('Username') }}</a>
                    @else
                        <a href="{{ url('/login?type=phone') }}"
                            class="text-indigo-600 hover:text-indigo-400 hover:underline">{{ __('Phone') }}</a>
                    @endif
                @endisset

                @empty($type)
                    <a href="{{ url('/login?type=name') }}"
                        class="text-indigo-600 hover:text-indigo-400 hover:underline">{{ __('Username') }}</a>
                    <span class="text-gray-700 dark:text-gray-300"> | </span>
                    <a href="{{ url('/login?type=phone') }}"
                        class="text-indigo-600 hover:text-indigo-400 hover:underline">{{ __('Phone') }}</a>
                @endempty
            </div>
        </div>
    </form>
</x-guest-layout>
