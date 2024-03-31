<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        @if (Session::get('user_role') == 'user')
            <div>
                <x-input-label for="nisn" :value="__('Nisn')" />
                <x-text-input id="nisn" name="nisn" type="text" class="block w-full mt-1" :value="old('nisn', $user->nisn)"
                    required autocomplete="nisn" />
                <x-input-error class="mt-2" :messages="$errors->get('nisn')" />
            </div>

            <div>
                <x-input-label for="parent_name" :value="__('Parent_Name')" />
                <x-text-input id="parent_name" name="parent_name" type="text" class="block w-full mt-1"
                    :value="old('parent_name', $user->parent_name)" required autocomplete="parent_name" />
                <x-input-error class="mt-2" :messages="$errors->get('parent_name')" />
            </div>

            <div>
                <x-input-label for="id_school" :value="__('School')" />
                <select id="id_school" name="id_school" class="block w-full mt-1">
                    @foreach ($schools as $school)
                        <option value="{{ $school['id'] }}" @if ($oldSchoolId == $school['id']) selected @endif>
                            {{ $school['name'] }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('id_school')" />
            </div>

            <div>
                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                <input id="date_of_birth" type="date" name="date_of_birth" class="block w-full mt-1"
                    value="{{ old('date_of_birth', $user->date_of_birth ?? '') }}" />
                <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
            </div>

            <div class="mt-4">
                <x-input-label for="is_boarding" :value="__('Asrama / Non Asrama')" />
                <select id="is_boarding" name="is_boarding" class="block w-full mt-1">
                    <option value="1" {{ $user->is_boarding ? 'selected' : '' }}>Asrama</option>
                    <option value="0" {{ !$user->is_boarding ? 'selected' : '' }}>Non Asrama</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('is_boarding')" />
            </div>
        @endif

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="block w-full mt-1" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-blue-button>{{ __('Save') }}</x-blue-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
