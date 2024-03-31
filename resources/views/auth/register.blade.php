<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block w-full mt-1" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>


        {{-- Schools --}}
        <div class="mt-4">
            <x-input-label for="id_school" :value="__('Jenjang Pendidikan')" />
            <select id="id_school" name="id_school"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Pilih Jenjang</option>
                @foreach ($schools as $school)
                    <option value="{{ $school['id'] }}">{{ $school['name'] }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('id_school')" class="mt-2" />
        </div>


        <!-- Date of Birth -->
        <div class="mt-4">
            <x-input-label for="date_of_birth" :value="__('Tanggal Lahir')" />
            <x-text-input id="date_of_birth" class="block w-full mt-1" type="date" name="date_of_birth"
                :value="old('date_of_birth')" />
            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
        </div>

        <!-- NISN -->
        <div class="mt-4">
            <x-input-label for="nisn" :value="__('NISN')" />
            <x-text-input id="nisn" class="block w-full mt-1" type="text" name="nisn" :value="old('nisn')"
                required />
            <x-input-error :messages="$errors->get('nisn')" class="mt-2" />
        </div>

        <!-- Parent Name -->
        <div class="mt-4">
            <x-input-label for="parent_name" :value="__('Nama Orang Tua')" />
            <x-text-input id="parent_name" class="block w-full mt-1" type="text" name="parent_name"
                :value="old('parent_name')" required />
            <x-input-error :messages="$errors->get('parent_name')" class="mt-2" />
        </div>

        <!-- Profile Photo -->
        <div class="mt-4">
            <x-input-label for="profile_photo_path"
                class="block text-sm font-medium text-gray-700">{{ __('Pas Photo 4/6') }}</x-input-label>
            <x-bladewind.filepicker name="proof_of_payment" required="true" placeholder="Upload proof of payment" />
            <x-input-error :messages="$errors->get('profile_photo_path')" class="mt-2" />
        </div>

        <!-- ID Card of Parent -->
        <div class="mt-4">
            <x-input-label for="id_card_parent"
                class="block text-sm font-medium text-gray-700">{{ __('ID Card of Parent') }}</x-input-label>
            <input id="id_card_parent" type="file" name="id_card_parent" accept="image/*" class="block w-full mt-1">
            <x-input-error :messages="$errors->get('id_card_parent')" class="mt-2" />
        </div>

        <!-- ID Family Card -->
        <div class="mt-4">
            <x-input-label for="id_family_card"
                class="block text-sm font-medium text-gray-700">{{ __('ID Family Card') }}</x-input-label>
            <input id="id_family_card" type="file" name="id_family_card" accept="image/*" class="block w-full mt-1">
            <x-input-error :messages="$errors->get('id_family_card')" class="mt-2" />
        </div>

        <!-- KIP (Kartu Indonesia Pintar) -->
        <div class="mt-4">
            <x-input-label for="kip"
                class="block text-sm font-medium text-gray-700">{{ __('KIP (Jika Ada)') }}</x-input-label>
            <input id="kip" type="file" name="kip" accept="image/*" class="block w-full mt-1">
            <x-input-error :messages="$errors->get('kip')" class="mt-2" />
        </div>


        <!-- Boarding -->
        <div class="mt-4">
            <label for="is_boarding"
                class="block text-sm font-medium text-gray-700">{{ __('Asrama / Non Asrama') }}</label>
            <div class="mt-2">
                <input type="radio" id="is_boarding_yes" name="is_boarding" value="1"
                    {{ old('is_boarding') == '1' ? 'checked' : '' }} class="mr-2">
                <label for="is_boarding_yes" class="inline-block font-medium text-gray-700">Asrama</label>
            </div>
            <div class="mt-2">
                <input type="radio" id="is_boarding_no" name="is_boarding" value="0"
                    {{ old('is_boarding') == '0' ? 'checked' : '' }} class="mr-2">
                <label for="is_boarding_no" class="inline-block font-medium text-gray-700">Non Asrama</label>
            </div>
            <x-input-error :messages="$errors->get('is_boarding')" class="mt-2" />
        </div>



        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
