<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl justify-self-center justify-center font-semibold text-center">
                        RESERVATION FORM
                    </h2>
                    <div>
                        <form action="{{ route('book.create') }}" method="POST" class="flex flex-col justify-center items-center">
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
                                <label>Check-in date:</label>
                                <input type="date" name="checkin_date" value="{{ old('checkin_date') }}">
                            </div>
                            <div class="flex flex-row items-center justify-start">
                                <label>Check-out date:</label>
                                <input type="date" name="checkout_date" value="{{ old('checkout_date') }}">
                            </div>
                            <div class="flex flex-row items-center justify-start">
                                <label>Number of people:</label>
                                <input type="number" name="num_of_people" value="{{ old('num_of_people') }}">
                            </div>
                            <button class="p-4 bg-black text-white my-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
