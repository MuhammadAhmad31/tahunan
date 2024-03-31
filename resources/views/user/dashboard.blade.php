<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-bladewind.alert type="success" class="mb-5">
                Selamat Anda Telah Berhasil Mendaftar
            </x-bladewind.alert>

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 style="font-size: 40px">Data Santri</h1>
                    <ul>
                        <li><strong>ID:</strong> {{ $id }}</li>
                        <li><strong>Nama:</strong> {{ $name }}</li>
                        <li><strong>Email:</strong> {{ $email }}</li>
                        <li><strong>Jenjang Pendidikan:</strong> {{ $jenjang_pendidikan }}</li>
                        <li><strong>Tanggal Lahir:</strong> {{ $tanggal_lahir }}</li>
                        <li><strong>NISN:</strong> {{ $nisn }}</li>
                        <li><strong>Orang Tua:</strong> {{ $orang_tua }}</li>
                        <li><strong>Asrama:</strong> {{ $asrama }}</li>
                    </ul>

                    {{-- <div class="my-4">
                        <h2>Foto 4x6</h2>
                        <div style="width: 200px;">
                            <img src="{{ asset('storage/' . $profile_photo_path) }}" alt="Foto Profil">
                        </div>
                    </div>

                    <div class="my-4">
                        <h2>KTP Orang Tua</h2>
                        <div style="width: 200px">
                            <img src="{{ asset('storage/' . $id_card_parent) }}" alt="KTP Orang Tua">
                        </div>
                    </div>

                    <div class="my-4">
                        <h2>Kartu Keluarga</h2>
                        <div style="width: 200px">
                            <img src="{{ asset('storage/' . $id_family_card) }}" alt="Kartu Keluarga">
                        </div>
                    </div>

                    <div class="my-4">
                        <h2>KIP</h2>
                        @if (!empty($kip))
                            <div style="width: 200px">
                                <img src="{{ asset('storage/' . $kip) }}" alt="KIP">
                            </div>
                        @else
                            <p>Tidak ada KIP</p>
                        @endif
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
