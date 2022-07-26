<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col justify-center"> <!--container-->
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col">
                    Room: {{$room->room_number}} <br>
                    Room status: {{$room->room_status->room_status_name}} <br>
                    Room type: {{$room->room_type->room_type_name}} <br>
                    Base Price: {{$room->base_price}} <br>
                    Room area: {{$room->room_area}} <br>
                    @php
                        $imgs = $room->gallery;
                    @endphp
                    @foreach ($imgs as $img_src)
                        <img src="{{ $img_src->img_url }}" alt="">
                    @endforeach
                    @can('book', $room)
                    <div class="text-center hover:bg-blue-500 hover:text-gray-900">
                        <form method="POST" action="{{ route('book.push', ['room' => $room]) }}">
                            @csrf
                            <button type="submit">Book this room</button>
                        </form>
                    </div>
                    @endcan

                    @can('unbook', $room)
                        <div class="text-left ml-2 text-center">
                            Already chosen! (...To confirm reservation, please redirect to Booked)
                        </div>
                        <div class="text-center hover:bg-blue-500 hover:text-gray-900">
                            <form method="POST" action="{{ route('book.pop', ['room' => $room]) }}">
                                @csrf
                                <button type="submit">Unbook this room</button>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
