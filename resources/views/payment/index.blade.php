<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl marker:font-semibold text-center">
                        HÓA ĐƠN THUÊ PHÒNG
                    </h2>
                    <p class="text-sm text-center">{{ date("Y/m/d") }}</p>
                    @foreach ($reservations as $reservation)

                    <div>
                        {{number_format($reservation->totalMoney())}}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
