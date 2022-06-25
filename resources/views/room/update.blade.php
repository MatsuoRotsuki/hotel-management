@php
    $room_types = App\Models\RoomType::all();
    $room_statuses = App\Models\RoomStatus::all();
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Room Update') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> <!--container-->
                <div class="p-6 bg-white text-xl font-semibold text-center">
                    Room {{ $room->room_number }}
                </div>
                <div class="items-center flex-col flex sm:justify-center">
                    <form method="POST" action="{{ route('room.update',$room) }}" class="flex items-center flex-col sm:justify-center">
                        @csrf
                        <label for="room_number">Room number</label>
                        <input type="text" name="room_number" value="{{ $room->room_number }}">
                        <label for="room_number">Room area</label>
                        <input type="number" name="room_area" value="{{ $room->room_area }}">
                        <label for="room_number">Room type</label>
                        <select name="room_type" id="room_type_select">
                            @foreach ($room_types as $room_type)
                                <option value="{{ $room_type->id }}">{{ Str::title($room_type->room_type_name) }}</option>
                            @endforeach
                        </select>
                        <label for="room_number">Base price</label>
                        <input type="text" name="base_price" value="{{ $room->base_price }}">
                        <label for="room_number">Room status</label>
                        <select name="room_status" id="room_status_select">
                            @foreach ($room_statuses as $room_status)
                                <option value="{{$room_status->id}}"
                                    @if ($room->room_status_id == $room_status->id)
                                        selected
                                    @endif>{{ Str::title($room_status->room_status_name) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-blue-400 text-white p-4">Done</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
