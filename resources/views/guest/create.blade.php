<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Information Update') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl justify-self-center justify-center font-semibold text-center">
                        Please fill in your personal information
                    </h2>
                    <div class="flex flex-col">
                        <form method="POST" action="{{ route('guest.create') }}" class="flex flex-col items-center">
                            @csrf
                            @error('date')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập ngày sinh!
                                </div>
                            @enderror
                            <input type="date" name="dob" value="{{ old('dob') }}">
                            @error('address')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập địa chỉ
                                </div>
                            @enderror
                            <input type="text" name="address" placeholder="Adress" value="{{ old('address')}}">
                            @error('phone')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập số điện thoại
                                </div>
                            @enderror
                            <input type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                            @error('city')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập tỉnh / thành phố
                                </div>
                            @enderror
                            <input type="text" name="city" placeholder="City" value="{{ old('city') }}">
                            @error('country')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập quốc tịch!
                                </div>
                            @enderror
                            <input type="text" name="country" placeholder="Country" value="{{ old('country') }}">
                            @error('passport')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập số hộ chiếu
                                </div>
                            @enderror
                            <input type="text" name="passport" placeholder="Passport ID (optional)" value="{{ old('passport') }}">
                            @error('cccd')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập số căn cước công dân
                                </div>
                            @enderror
                            <input type="text" name="cccd" placeholder="Identification number" value="{{ old('cccd') }}">
                            <button class="p-4 bg-black text-white">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
