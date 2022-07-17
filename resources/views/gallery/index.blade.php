<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gallery') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display:grid; grid-template-columns: 1fr 1fr 1fr; grid-auto-rows: minmax(30px, auto); grid-gap: 1em; justify-items:stretch; align-items:stretch;">
            @foreach ($pictures as $picture)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center">
                <div class="bg-white border-b border-gray-200">
                    <a href="{{ route('room.show', $picture->room) }}" alt="Click to view room"><img src="{{ $picture->img_url }}" alt=""></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
