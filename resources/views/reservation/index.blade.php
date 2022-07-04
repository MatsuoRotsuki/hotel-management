<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booked Rooms') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl justify-self-center justify-center font-semibold text-center">
                        QUEUE
                    </h2>
                    @if ($queueRooms->count())
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid" style="grid-template-columns: 1fr 1fr 1fr 1fr; grid-auto-rows: minmax(30px, auto); grid-gap: 1em; justify-items:stretch; align-items:stretch;">
                            @foreach ($queueRooms as $room)
                                <div class="bg-yellow-200 overflow-hidden shadow-sm sm:rounded-lg text-center p-4">
                                    Room number: {{ $room->room_number }}<br>
                                    Room type: {{ $room->room_type->room_type_name }}<br>
                                    Room status: {{ $room->room_status->room_status_name }}<br>
                                    Base price: {{ $room->base_price }}<br>
                                    Room area: {{ $room->room_area }}<br>
                                </div>
                            @endforeach

                        </div>
                        <div>
                            <a href="{{ route('book.confirm') }}">Submit</a>
                        </div>
                    @endif

                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl justify-self-center justify-center font-semibold text-center">
                        RESERVATION CONFIRMED
                    </h2>
                    @if ($confirmedRooms->count())
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid" style="grid-template-columns: 1fr 1fr 1fr 1fr; grid-auto-rows: minmax(30px, auto); grid-gap: 1em; justify-items:stretch; align-items:stretch;">
                            @foreach ($confirmedRooms as $room)
                                <div class="bg-yellow-200 overflow-hidden shadow-sm sm:rounded-lg text-center p-4">
                                    Room number: {{ $room->room_number }}<br>
                                    Room type: {{ $room->room_type->room_type_name }}<br>
                                    Room status: {{ $room->room_status->room_status_name }}<br>
                                    Base price: {{ $room->base_price }}<br>
                                    Room area: {{ $room->room_area }}<br>
                                </div>
                            @endforeach

                        </div>
                    @endif
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl justify-self-center justify-center font-semibold text-center">
                        RECEPTIONIST CONFIRMED
                    </h2>
                    @if ($confirmedRooms->count())
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid" style="grid-template-columns: 1fr 1fr 1fr 1fr; grid-auto-rows: minmax(30px, auto); grid-gap: 1em; justify-items:stretch; align-items:stretch;">
                            @foreach ($confirmedRooms as $room)
                                <div class="bg-yellow-200 overflow-hidden shadow-sm sm:rounded-lg text-center p-4">
                                    Room number: {{ $room->room_number }}<br>
                                    Room type: {{ $room->room_type->room_type_name }}<br>
                                    Room status: {{ $room->room_status->room_status_name }}<br>
                                    Base price: {{ $room->base_price }}<br>
                                    Room area: {{ $room->room_area }}<br>
                                </div>
                            @endforeach

                        </div>
                    @endif
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl justify-self-center justify-center font-semibold text-center">
                        CHECKED IN
                    </h2>
                    @if ($confirmedRooms->count())
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid" style="grid-template-columns: 1fr 1fr 1fr 1fr; grid-auto-rows: minmax(30px, auto); grid-gap: 1em; justify-items:stretch; align-items:stretch;">
                            @foreach ($confirmedRooms as $room)
                                <div class="bg-yellow-200 overflow-hidden shadow-sm sm:rounded-lg text-center p-4">
                                    Room number: {{ $room->room_number }}<br>
                                    Room type: {{ $room->room_type->room_type_name }}<br>
                                    Room status: {{ $room->room_status->room_status_name }}<br>
                                    Base price: {{ $room->base_price }}<br>
                                    Room area: {{ $room->room_area }}<br>
                                </div>
                            @endforeach

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
