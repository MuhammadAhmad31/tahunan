<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Santri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-bladewind.table exclude_columns="id, marital_status" divider="thin" :action_icons="$action_icons"
                        :data="$students" has_border="true" no_data_message="The santri is empty"
                        message_as_empty_state="true" searchable="true" search_placeholder="Cari santri" />
                </div>
            </div>
        </div>
    </div>

    <x-bladewind.modal name="get-detail" title="" size="omg" cancel_button_label="">
        <div class="flex gap-4 justify-center">
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
