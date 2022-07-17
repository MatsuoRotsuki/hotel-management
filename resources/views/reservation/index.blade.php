<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booked Rooms') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($selectedRooms)
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl justify-self-center justify-center font-semibold text-center">
                        PHÒNG ĐÃ CHỌN
                    </h2>

                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid" style="grid-template-columns: 1fr 1fr 1fr 1fr; grid-auto-rows: minmax(30px, auto); grid-gap: 1em; justify-items:stretch; align-items:stretch;">
                            @foreach ($selectedRooms as $room)
                                <div class="bg-yellow-200 overflow-hidden shadow-sm sm:rounded-lg text-center p-4">
                                    Room number: {{ $room->room_number }}<br>
                                    Room type: {{ $room->room_type->room_type_name }}<br>
                                    Room status: {{ $room->room_status->room_status_name }}<br>
                                    Base price: {{ number_format($room->base_price) }}<br>
                                    Room area: {{ $room->room_area }}<br>
                                </div>
                            @endforeach

                        </div>
                        <div class="text-left text-sm ml-6">
                            <p>Total money: {{ number_format($totalMoney) }}</p>
                            <p>Length of stay: {{ $days }} {{ Str::plural('day', $days) }}</p>
                            <p>Number of people: {{ $reservation->num_of_people }}</p>
                            @can('update', $reservation)
                                <a href="{{ route('book.update.render', $reservation) }}" class="hover:text-gray-500">Modify</a>
                            @endcan
                            <a href="{{ route('book.confirm') }}" class="hover:text-gray-500">Submit</a>
                        </div>
                </div>

                @endif

                @if ($queueRooms)
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl justify-self-center justify-center font-semibold text-center">
                        TRONG TRẠNG THÁI CHỜ
                    </h2>

                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid" style="grid-template-columns: 1fr 1fr 1fr 1fr; grid-auto-rows: minmax(30px, auto); grid-gap: 1em; justify-items:stretch; align-items:stretch;">
                            @foreach ($queueRooms as $room)
                                <div class="bg-yellow-200 overflow-hidden shadow-sm sm:rounded-lg text-center p-4">
                                    Room number: {{ $room->room_number }}<br>
                                    Room type: {{ $room->room_type->room_type_name }}<br>
                                    Room status: {{ $room->room_status->room_status_name }}<br>
                                    Base price: {{ number_format($room->base_price) }}<br>
                                    Room area: {{ $room->room_area }}<br>
                                </div>
                            @endforeach

                        </div>
                        <div class="text-left text-sm ml-6">
                            <p>Total money: {{ number_format($totalMoney) }}</p>
                            <p>Length of stay: {{ $days }} {{ Str::plural('day', $days) }}</p>
                            <p>Number of people: {{ $reservation->num_of_people }}</p>
                            <p>In queue... Please wait for the staff to confirm your reservation</p>
                            @can('update', $reservation)
                                <a href="{{ route('book.update.render', $reservation) }}" class="hover:text-gray-500">Modify</a>
                            @endcan
                            {{-- <form action="{{ route('book.destroy', $reservation) }}" method="POST">
                                <button type="submit" class="hover:text-gray-500">Unbook</button>
                            </form> --}}
                            <a href="{{ route('book.destroy', $reservation) }}" class="hover:text-gray-500">Unbook</a>
                        </div>

                </div>
                @endif

                @if ($confirmedRooms)
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl justify-self-center justify-center font-semibold text-center">
                        ĐƯỢC XÁC NHẬN
                    </h2>

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
                        <div class="text-left text-sm ml-6">
                            <p>Total money: {{ number_format($totalMoney) }}</p>
                            <p>Length of stay: {{ $days }} {{ Str::plural('day', $days) }}</p>
                            <p>Number of people: {{ $reservation->num_of_people }}</p>
                            @can('update', $reservation)
                                <a href="{{ route('book.update.render', $reservation) }}" class="hover:text-gray-500">Modify</a>
                            @endcan
                        </div>
                </div>
                @endif

                @if ($checkedInRooms)
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl justify-self-center justify-center font-semibold text-center">
                        ĐÃ CHECK-IN
                    </h2>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid" style="grid-template-columns: 1fr 1fr 1fr 1fr; grid-auto-rows: minmax(30px, auto); grid-gap: 1em; justify-items:stretch; align-items:stretch;">
                            @foreach ($checkedInRooms as $room)
                                <div class="bg-yellow-200 overflow-hidden shadow-sm sm:rounded-lg text-center p-4">
                                    Room number: {{ $room->room_number }}<br>
                                    Room type: {{ $room->room_type->room_type_name }}<br>
                                    Room status: {{ $room->room_status->room_status_name }}<br>
                                    Base price: {{ $room->base_price }}<br>
                                    Room area: {{ $room->room_area }}<br>
                                </div>
                            @endforeach

                        </div>
                        <div class="text-left text-sm ml-6">
                            <p>Total money: {{ number_format($totalMoney) }}</p>
                            <p>Length of stay: {{ $days }} {{ Str::plural('day', $days) }}</p>
                            <p>Number of people: {{ $reservation->num_of_people }}</p>
                            @can('checkout', $reservation)
                                <a href="{{ route('book.makeCheckout', $reservation) }}" class="hover:text-gray-500">Check-out</a>
                            @endcan
                        </div>
                </div>
                @endif


                @if (!Auth::user()->guest->reservations()->whereIn('reservation_status_id', [1,2,3,4])->count())
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                        <a href="{{ route('book.create.render') }}">Yêu cầu đơn đặt phòng mới</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
