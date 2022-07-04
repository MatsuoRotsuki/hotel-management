<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> <!--container-->
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl justify-self-center justify-center font-semibold text-center">
                        ADD ROOM
                    </h2>
                    <div>
                        <form action="{{ route('room-create') }}" method="post" class="mb-4 grid items-center" style="grid-gap:0.5em;">
                        @csrf
                            <input type="text" name="room_number" placeholder="Room number" value="{{ old('room_number') }}">
                            <input type="number" name="room_area" placeholder="Room area" value="{{ old('room_area') }}">
                            <select name="room_type" id="type_selector">
                                @foreach ($room_types as $room_type)
                                    <option value="{{$room_type->id}}">{{ Str::title($room_type->room_type_name) }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="base_price" placeholder="Base Price" value="{{ old('base_price') }}">
                            <input type="text" name="img_url" placeholder="Paste a room image link" value="{{ old('img_url') }}">
                            <button type="submit" class="text-white px-4 py-2 rounded font-medium bg-slate-500">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
