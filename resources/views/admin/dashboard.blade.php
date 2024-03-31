<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('SISTEM PENDAFTARAN SANTRI BARU') }}
                </div>

            </div>
        </div>

    </div>

    <div class="grid grid-cols-2 gap-4">
        <x-bladewind.card class=" hover:shadow-gray-300">
            <h1 style="font-size: 70px" class="font-bold text-center">{{ $userCount }}</h1>
            <span class="text-center">Seluruh Santri</span>
        </x-bladewind.card>

        <x-bladewind.card class=" hover:shadow-gray-300">
            <h1 style="font-size: 70px" class="font-bold text-center">{{ $userMTSCount }}</h1>
            <span class="text-center">Santri MTS</span>
        </x-bladewind.card>

        <x-bladewind.card class=" hover:shadow-gray-300">
            <h1 style="font-size: 70px" class="font-bold text-center">{{ $userMACount }}</h1>
            <span class="text-center">Santri MA</span>
        </x-bladewind.card>
        <x-bladewind.card class=" hover:shadow-gray-300">
            <h1 style="font-size: 70px" class="font-bold text-center">{{ $userSMKCount }}</h1>
            <span class="text-center">Santri SMK</span>
        </x-bladewind.card>
    </div>

</x-app-layout>
