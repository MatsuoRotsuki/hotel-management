<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservation Modification') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl justify-self-center justify-center font-semibold text-center">
                        RESERVATION UPDATE FORM
                    </h2>
                    <div>
                        <form action="{{ route('book.update', $reservation) }}" method="POST" class="flex flex-col justify-center items-center">
                            @csrf
                            @error('checkin_date')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập vào ngày check-in phải sau ngày hôm nay
                                </div>
                            @enderror
                            @error('checkout_date')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập ngày check-out phải sau ngày check-in và sau hôm nay
                                </div>
                            @enderror
                            @error('num_of_people')
                                <div class="text-red-500 mt-2 text-sm">
                                    Số người ở phải nhập vào dạng số và nhỏ hơn hoặc bằng 50
                                </div>
                            @enderror

                            <div class="flex flex-row items-center justify-start">
                                <label for="checkin_date">Check-in date:</label>
                                <input type="date" name="checkin_date" value="{{ $reservation->checkin_date }}">
                            </div>
                            <div class="flex flex-row items-center justify-start">
                                <label for="checkout_date">Check-out date:</label>
                                <input type="date" name="checkout_date" value="{{ $reservation->checkout_date }}">
                            </div>
                            <div class="flex flex-row items-center justify-start">
                                <label for="num_of_people">Number of people:</label>
                                <input type="number" name="num_of_people" value="{{ $reservation->num_of_people }}">
                            </div>
                            <button class="p-4 bg-black text-white my-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
