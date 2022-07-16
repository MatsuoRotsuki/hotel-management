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
                            @error('dob')
                            <div class="text-red-500 mt-2 text-sm">
                                Nhập ngày sinh!
                            </div>
                            @enderror
                            <div class="mt-4">
                                <x-label for="dob" :value="__('Date of birth')" />

                                <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" autofocus />
                            </div>


                                @error('address')
                                    <div class="text-red-500 mt-2 text-sm">
                                        Nhập địa chỉ
                                    </div>
                                @enderror
                            <div class="mt-4">
                                <x-label for="address" :value="__('Address')" />

                                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" autofocus />
                            </div>
                            @error('phone')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập số điện thoại
                                </div>
                            @enderror
                            <div class="mt-4">
                                <x-label for="phone" :value="__('Phone number')" />

                                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" autofocus />
                            </div>
                            @error('city')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập tỉnh / thành phố
                                </div>
                            @enderror
                            <div class="mt-4">
                                <x-label for="city" :value="__('City')" />

                                <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" autofocus />
                            </div>
                            @error('country')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập quốc tịch!
                                </div>
                            @enderror
                            <div class="mt-4">
                                <x-label for="country" :value="__('Country')" />

                                <x-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" autofocus />
                            </div>
                            @error('passport')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập số hộ chiếu
                                </div>
                            @enderror
                            <div class="mt-4">
                                <x-label for="passport" :value="__('Passport ID (optional)')" />

                                <x-input id="passport" class="block mt-1 w-full" type="text" name="passport" :value="old('passport')" autofocus />
                            </div>
                            @error('cccd')
                                <div class="text-red-500 mt-2 text-sm">
                                    Nhập số căn cước công dân
                                </div>
                            @enderror
                            <div class="mt-4">
                                <x-label for="cccd" :value="__('Identification number(optional)')" />

                                <x-input id="cccd" class="block mt-1 w-full" type="text" name="cccd" :value="old('cccd')" autofocus />
                            </div>
                            <button class="p-4 bg-black text-white mt-2 rounded-lg">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
