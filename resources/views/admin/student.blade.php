<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Santri') }}
        </h2>
    </x-slot>

    @if (session('error'))
        <x-bladewind.alert type="error">
            {{ session('error') }}
        </x-bladewind.alert>
    @endif

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid-cols-1">
                        <form id="filterForm" action="{{ route('admin.student') }}" method="GET"
                            class="flex items-center gap-2 mt-4 mb-3">

                            <!-- Filter by School -->
                            <x-input-label for="id_school" class="block text-sm font-medium text-gray-700">Filter
                                Jenjang:</x-input-label>
                            <div class="relative inline-block">
                                <select name="id_school" id="id_school"
                                    class="block max-w-full px-4 py-2 pr-8 leading-tight bg-white border border-gray-300 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline"
                                    onchange="this.form.submit()">
                                    <option value="">Semua Jenjang</option>
                                    @foreach ($schools as $school)
                                        <option value="{{ $school->id }}"
                                            {{ $school->id == $idSchool ? 'selected' : '' }}>
                                            {{ $school->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filter by Boarding -->
                            <x-input-label for="is_boarding" class="block text-sm font-medium text-gray-700">Filter
                                Asrama:</x-input-label>
                            <div class="relative inline-block w-48">
                                <select name="is_boarding" id="is_boarding"
                                    class="block w-full px-4 py-2 pr-8 leading-tight bg-white border border-gray-300 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline"
                                    onchange="this.form.submit()">
                                    <option value="">Semua</option>
                                    <option value="1" {{ $isBoarding == '1' ? 'selected' : '' }}>Asrama</option>
                                    <option value="0" {{ $isBoarding === '0' ? 'selected' : '' }}>Non Asrama
                                    </option>
                                </select>
                            </div>
                        </form>

                        <form action="{{ route('admin.student.export') }}" method="GET" class="mb-4">
                            <input type="hidden" name="id_school" value="{{ $idSchool }}">
                            <input type="hidden" name="is_boarding" value="{{ $isBoarding }}">
                            <button type="submit"
                                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                Download Excel
                            </button>
                        </form>
                    </div>

                    <x-bladewind.table exclude_columns="id, marital_status" divider="thin" :action_icons="$action_icons"
                        :data="$students" has_border="true" no_data_message="The santri is empty"
                        message_as_empty_state="true" searchable="true" search_placeholder="Cari santri"
                        compact="ture" />

                </div>
            </div>
        </div>
    </div>

    <x-bladewind.modal name="get-detail" title="" size="omg" cancel_button_label="">
        <div class="flex justify-center gap-4">
            <div class="mb-6">
                <p>Photo</p>
                <img src="" alt="Profile Photo" style="width: 200px;" id="profile_photo">
            </div>
            <div class="mb-6">
                <p>KTP Orang Tua</p>
                <img src="" alt="ID Card Parent" style="width: 200px;" id="id_card_parent">
            </div>
            <div class="mb-6">
                <p>Kartu Keluarga</p>
                <img src="" alt="ID Family Card" style="width: 200px;" id="id_family_card">
            </div>
            <div class="mb-6">
                <p>KIP</p>
                <img src="" alt="KIP" style="width: 200px;" id="kip">
                <p id="kip-text"></p>
            </div>

        </div>
    </x-bladewind.modal>


    <script>
        document.getElementById('id_school').addEventListener('change', function() {
            // Submit the form when value changes
            document.getElementById('filterForm').submit();
        });

        document.getElementById('is_boarding').addEventListener('change', function() {
            // Submit the form when value changes
            document.getElementById('filterForm').submit();
        });


        getDetail = (id) => {
            const detail = @json($detail);
            const student = detail[id];
            document.getElementById('profile_photo').src = student.profile_photo_path ? '{{ asset('storage/') }}' +
                '/' + student.profile_photo_path : '';
            document.getElementById('id_card_parent').src = student.id_card_parent ? '{{ asset('storage/') }}' + '/' +
                student.id_card_parent : '';
            document.getElementById('id_family_card').src = student.id_family_card ? '{{ asset('storage/') }}' + '/' +
                student.id_family_card : '';

            // Handling for KIP
            if (student.kip) {
                document.getElementById('kip').src = '{{ asset('storage/') }}' + '/' + student.kip;
                document.getElementById('kip').style.display = 'inline-block';
                document.getElementById('kip-text').innerText = '';
            } else {
                document.getElementById('kip').style.display = 'none'; // Hide the image
                document.getElementById('kip-text').innerText = 'KIP is empty'; // Show empty text
            }

            showModal('get-detail');
        }
    </script>



</x-app-layout>
