<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> <!--container-->
                <div class="p-6 bg-white border-b border-gray-200">
                    Room: {{$room->room_number}} <br>
                    Room status: {{$room->room_status->room_status_name}} <br>
                    Room type: {{$room->room_type->room_type_name}} <br>
                    Base Price: {{$room->base_price}} <br>
                    Room area: {{$room->room_area}} <br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
