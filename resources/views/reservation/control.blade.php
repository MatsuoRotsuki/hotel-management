<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservation Control Panel') }}
        </h2>
    </x-slot>

    @php
        function getColor($status){
            switch($status){
                case 1:
                    return 'bg-green-500';
                default:
                    return 'bg-white';
            }
        }
    @endphp

    @foreach ($reservations as $reservation)
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 @if($reservation->displayWhite()) bg-white @else bg-gray-300 @endif border-b border-gray-200 grid" style="grid-auto-rows: minmax(30px, auto); grid-template-columns: 3fr 7fr; grid-gap: 0.5em; justify-items:center;">
                    <div class="flex flex-col justify-center">
                        <p>Guest name: <a href="{{ route('profile', ['guest' => $reservation->guest]) }}" class="font-bold pr-3">{{ $reservation->guest->user->first_name }} {{ $reservation->guest->user->last_name }}</a></p>
                        <p>Length of stay: {{ $reservation->days() }} {{ Str::plural('day', $reservation->days()) }}</p>
                        <p>Check-in date: {{ $reservation->checkin_date }}</p>
                        <p>Check-out date: {{$reservation->checkout_date}}</p>
                        <p>Number of people: {{ $reservation->num_of_people }}</p>
                        <p>Total cost: {{ number_format($reservation->totalMoney()) }}</p>
                        <p>Number of rooms: {{ $reservation->rooms->count() }}</p>
                        <p>Reservation status: {{Str::title($reservation->status->reservation_status_name)}}</p>
                    </div>
                    <div class="grid" style="grid-auto-rows: minmax(30px,auto); grid-template-columns: 1fr 1fr 1fr; justify-items: center">
                        @foreach ($reservation->rooms as $room)
                            <a href="{{ route('room.show', $room) }}" class="flex flex-col items-center p-3 bg-orange-500 mx-4" style="border: 1px solid black;">
                                <p>Room number: {{ $room->room_number }}</p>
                                <p>Base price: {{ number_format($room->base_price) }}</p>
                            </a>
                        @endforeach
                    </div>

                        {{-- {{ $reservation->guest->user->first_name }} {{ $reservation->guest->user->last_name }}<br>
                        {{ $reservation->days() }} day<br>
                        {{ $reservation->totalMoney() }} <br>
                        {{ $reservation->status->reservation_status_name }} <br>
                        @foreach ($reservation->rooms as $room)
                            {{ $room->room_number }} <br>
                            {{ $room->base_price }} <br>
                            <br>
                        @endforeach
                        <br> --}}
                </div>
                <div class="flex flex-row justify-center">
                    @if ($reservation->reservation_status_id === 2)
                        <a href="{{ route('book.makeConfirm', $reservation) }}" class="hover:bg-gray-300 text-center w-full">Confirm</a>
                        <a href="{{ route('book.makeDecline', $reservation) }}" class="hover:bg-gray-300 text-center w-full">Decline</a>
                    @elseif ($reservation->reservation_status_id === 1)
                        <a href="{{ route('book.makeDecline', $reservation) }}" class="hover:bg-gray-300 text-center w-full">Decline</a>
                    @elseif ($reservation->reservation_status_id === 3)
                        <a href="{{ route('book.makeCheckin', $reservation) }}" class="hover:bg-gray-300 text-center w-full">Check-in</a>
                        <a href="{{ route('book.cancel', $reservation) }}" class="hover:bg-gray-300 text-center w-full">Cancel</a>
                    @elseif ($reservation->reservation_status_id === 4)
                        <a href="{{ route('book.makeCheckout', $reservation) }}" class="hover:bg-gray-300 text-center w-full">Check-out</a>
                    @else
                        <a href="{{ route('book.makeDelete', $reservation) }}" class="hover:bg-gray-300 text-center w-full">Delete from database</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @if ($reservations->count() === 0)
        <p class="mt-8 mx-auto text-center">There's no reservation request</p>
    @endif
</x-app-layout>
