<x-auth-layout>
    <form method="POST" action="{{ route('register.organizer.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Organization Name -->
        <div class="mt-4">
            <x-input-label for="organization_name" :value="__('Organization Name')" />
            <x-text-input id="organization_name" class="block mt-1 w-full" type="text" name="organization_name" :value="old('organization_name')" required />
            <x-input-error :messages="$errors->get('organization_name')" class="mt-2" />
        </div>

        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description (Optional)')" />
            <x-textarea
            id="description"
            name="description"
            label="Description (Optional)"
            placeholder="Tell us about your organization..."
            :error="$errors->has('description')"
            rows="4"
        />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Website -->
        <div class="mt-4">
            <x-input-label for="website" :value="__('Website (Optional)')" />
            <x-text-input id="website" class="block mt-1 w-full" type="url" name="website" :value="old('website')" placeholder="https://example.com" />
            <x-input-error :messages="$errors->get('website')" class="mt-2" />
        </div>

        <!-- Logo -->
        <div class="mt-4">
            <x-input-label for="logo" :value="__('Logo (Optional)')" />
            <input id="logo" class="block mt-1 w-full text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 dark:file:bg-gray-700 dark:file:text-gray-200 dark:hover:file:bg-gray-600" type="file" name="logo" accept="image/*" />
            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Max file size: 2MB</p>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register as Organizer') }}
            </x-primary-button>
        </div>
    </form>
</x-auth-layout>
