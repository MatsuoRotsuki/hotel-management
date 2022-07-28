<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rooms') }}
        </h2>
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <div>
                        Filter by status
                    </div>
                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <form method="GET" action="{{ route('room') }}">
                    @csrf

                    <x-dropdown-link :href="route('room')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('All') }}
                    </x-dropdown-link>
                </form>

                @foreach ($room_statuses as $room_status)
                    <form method="GET" action="{{ route('room.filter', $room_status->room_status_id) }}">
                        @csrf

                        <x-dropdown-link :href="route('room.filter', $room_status->room_status_id)"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __(Str::title($room_status->room_status_name)) }}
                        </x-dropdown-link>
                    </form>
                @endforeach
            </x-slot>
        </x-dropdown>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display:grid; grid-template-columns: 1fr 1fr 1fr 1fr; grid-auto-rows: minmax(30px, auto); grid-gap: 1em; justify-items:stretch; align-items:stretch;">
            @php
                function canReserve($status_id){
                            switch ($status_id){
                                case 1:
                                case 4:
                                case 7:
                                    return true;
                                    break;
                                case 2:
                                case 3:
                                case 5:
                                case 6:
                                    return false;
                                    break;
                                default:
                                    return false;
                                    break;
                            }
                        }

                        function getColor($status_id){
                            switch($status_id){
                                case 1:
                                    return 'bg-green-400'; //vacant
                                    break;
                                case 2:
                                    return 'bg-yellow-300'; //occupied
                                    break;
                                case 3:
                                    return 'bg-yellow-200'; //reserved
                                    break;
                                case 4:
                                    return 'bg-orange-500';
                                    break;
                                case 5:
                                    return 'bg-slate-500';
                                    break;
                                case 6:
                                    return 'bg-red-500';
                                    break;
                                case 7:
                                    return 'bg-blue-400';
                                    break;
                                default:
                                    return 'bg-slate-300';
                                    break;
                            }
                        }
            @endphp
            @foreach ($rooms as $room)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center"> <!--container-->


                    @php
                        $statusName = $room->room_status->room_status_name;
                        $displayColor = getColor($room->room_status->room_status_id);
                    @endphp

                    <a href="{{ route('room.show', ['room' => $room]) }}">
                        <div class="p-6 {{ $displayColor }} border-b border-gray-200">
                            Room number: {{ $room->room_number }}<br>
                            Room type: {{ $room->room_type->room_type_name }}<br>
                            Room status: {{ $room->room_status->room_status_name }}<br>
                            Base price: {{ number_format($room->base_price) }}<br>
                            Room area: {{ $room->room_area }}<br>
                        </div>
                    </a>


                    <div class="bg-white text-blue-600">
                        <div class="text-center hover:bg-gray-50 hover:text-gray-900">
                            <form method="GET" action="{{ route('room.show', ['room' => $room]) }}">
                                @csrf
                                <button type="submit">Click to view</button>
                            </form>
                        </div>

                        @can('isGuest', App\Room::class)

                        @can('book', $room)
                        <div class="text-center hover:bg-gray-50 hover:text-gray-900">
                            <form method="POST" action="{{ route('book.push', ['room' => $room]) }}">
                                @csrf
                                <button type="submit">Book this room</button>
                            </form>
                        </div>

                        {{-- @if(canReserve($room->room_status->room_status_id))
                            @php
                                $roomGuestId = $room->reservations->pluck('guest')->pluck('guest_id');
                                if(Auth::user()->confirmed_information){
                                    $userGuestId = Auth::user()->guest->guest_id;

                                } else {
                                    $userGuestId = null;
                                }
                            @endphp
                            @if (!$roomGuestId->contains($userGuestId))
                                @if(Auth::user()->guest->reservations->whereIn('reservation_status_id', [1])->first())
                                <div class="text-center hover:bg-gray-50 hover:text-gray-900">
                                    <form method="POST" action="{{ route('book.push', ['room' => $room]) }}">
                                        @csrf
                                        <button type="submit">Book this room</button>
                                    </form>
                                </div>
                                @endif
                            @else
                                <div class="text-left ml-2">
                                    Already chosen! (...To confirm reservation, please redirect to Booked)
                                </div>
                                <div class="text-center hover:bg-gray-50 hover:text-gray-900">
                                    <form method="POST" action="{{ route('book.pop', ['room' => $room]) }}">
                                        @csrf
                                        <button type="submit">Unbook this room</button>
                                    </form>
                                </div>
                            @endif --}}
                        {{-- @else
                            @if ($room->bookedBy(Auth::user()))
                                <div class="text-center hover:bg-gray-50 hover:text-gray-900">
                                    You've booked this room
                                </div>
                            @endif
                        @endif --}}
                        @endcan
                        @can('unbook', $room)
                            <div class="text-left ml-2">
                                Already chosen! (...To confirm reservation, please redirect to Booked)
                            </div>
                            <div class="text-center hover:bg-gray-50 hover:text-gray-900">
                                <form method="POST" action="{{ route('book.pop', ['room' => $room]) }}">
                                    @csrf
                                    <button type="submit">Unbook this room</button>
                                </form>
                            </div>
                        @endcan

                        @can('hasBooked', $room)
                            <div class="text-center hover:bg-gray-50 hover:text-gray-900">
                                You've booked this room
                            </div>
                        @endcan

                        @can('hasCheckedIn', $room)
                            <div class="text-center hover:bg-gray-50 hover:text-gray-900">
                                You are staying in this room
                            </div>
                        @endcan

                        @endcan <!-- End guest display -->


                        @can('isAdmin', App\Room::class)
                        <div class="text-center hover:bg-gray-50 hover:text-gray-900">
                            <form method="GET" action="{{ route('room.update', ['room' => $room]) }}">
                                @csrf
                                <button type="submit">Modify</button>
                            </form>
                        </div>

                        <div class="text-center hover:bg-gray-50 hover:text-gray-900">
                            <form method="POST" action="{{ route('room.destroy', ['room' => $room]) }}">
                                @csrf
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                        @endcan
                        {{-- <div class="text-center hover:bg-gray-50 hover:text-gray-900">
                            {{ Auth::user()->confirmed_information }}
                        </div> --}}
                    </div>
                </div>
            @endforeach
            @auth
            @can('isAdmin', App\Room::class)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center"> <!--container-->
                <form class="p-6 bg-white border-b border-gray-200 hover:bg-gray-700 hover:text-white" method="GET" action="{{ route('room-create') }}">
                    @csrf
                    <button onclick="{{ route('room-create') }}" class="text-2xl p-6">Add room</button>
                </form>
                @if ($rooms->count() == 0)
                    <div class="p-4">
                        There are no room yet!
                    </div>
                @endif
            </div>
            @else
                @if ($rooms->count() == 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center px-4 pt-10 pb-10 text-xl">
                        There are no room yet!
                    </div>
                @endif
            @endcan
            @endauth
        </div>
    </div>
    {{$rooms->links()}}
</x-app-layout>
