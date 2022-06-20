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
                    <form method="GET" action="{{ route('room.filter', $room_status->id) }}">
                        @csrf

                        <x-dropdown-link :href="route('room.filter', $room_status->id)"
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

            @foreach ($rooms as $room)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center"> <!--container-->

                    <!-- Vacant room -->
                    @php
                        $statusName = $room->room_status->room_status_name;
                    @endphp
                    @if ($statusName =='vacant')
                    <a href="{{ route('room.show', ['room' => $room]) }}">
                        <div class="p-6 bg-green-400 border-b border-gray-200">
                            Room number: {{ $room->room_number }}<br>
                            Room type: {{ $room->room_type->room_type_name }}<br>
                            Room status: {{ $room->room_status->room_status_name }}<br>
                            Base price: {{ $room->base_price }}<br>
                            Room area: {{ $room->room_area }}<br>
                        </div>
                    </a>
                    @endif

                    @if ($statusName == 'reserved')
                    <a href="{{ route('room.show', ['room' => $room]) }}">
                        <div class="p-6 bg-yellow-200 border-b border-gray-200">
                            Room number: {{ $room->room_number }}<br>
                            Room type: {{ $room->room_type->room_type_name }}<br>
                            Room status: {{ $room->room_status->room_status_name }}<br>
                            Base price: {{ $room->base_price }}<br>
                            Room area: {{ $room->room_area }}<br>
                        </div>
                    </a>
                    @endif

                    @if ($statusName == 'occupied')
                    <a href="{{ route('room.show', ['room' => $room]) }}">
                        <div class="p-6 bg-yellow-300 border-b border-gray-200">
                            Room number: {{ $room->room_number }}<br>
                            Room type: {{ $room->room_type->room_type_name }}<br>
                            Room status: {{ $room->room_status->room_status_name }}<br>
                            Base price: {{ $room->base_price }}<br>
                            Room area: {{ $room->room_area }}<br>
                        </div>
                    </a>
                    @endif

                    @if ($statusName == 'dirty-vacant')
                    <a href="{{ route('room.show', ['room' => $room]) }}">
                        <div class="p-6 bg-red-400 border-b border-gray-200">
                            Room number: {{ $room->room_number }}<br>
                            Room type: {{ $room->room_type->room_type_name }}<br>
                            Room status: {{ $room->room_status->room_status_name }}<br>
                            Base price: {{ $room->base_price }}<br>
                            Room area: {{ $room->room_area }}<br>
                        </div>
                    </a>
                    @endif

                    @if ($statusName == 'cleaning' || $statusName == 'dirty' || $statusName == 'maintenance')
                    <a href="{{ route('room.show', ['room' => $room]) }}">
                        <div class="p-6 bg-red-500 border-b border-gray-200">
                            Room number: {{ $room->room_number }}<br>
                            Room type: {{ $room->room_type->room_type_name }}<br>
                            Room status: {{ $room->room_status->room_status_name }}<br>
                            Base price: {{ $room->base_price }}<br>
                            Room area: {{ $room->room_area }}<br>
                        </div>
                    </a>
                    @endif

                    <div class="bg-white text-blue-600">
                        <div class="text-center hover:bg-gray-50 hover:text-gray-900">
                            <form method="GET" action="{{ route('room.show', ['room' => $room]) }}">
                                @csrf
                                <button type="submit">Click to view</button>
                            </form>
                        </div>

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

                    </div>
                </div>
            @endforeach

            @can('isAdmin', App\Room::class)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> <!--container-->
                <form class="p-6 bg-white border-b border-gray-200 hover:bg-gray-700 hover:text-white text-center" method="GET" action="{{ route('room-create') }}">
                    @csrf
                    <button onclick="{{ route('room-create') }}" class="text-2xl p-6">Add room</button>
                </form>
            </div>
            @endcan
        </div>
    </div>
</x-app-layout>
