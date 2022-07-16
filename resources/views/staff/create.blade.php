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
                        STAFF CREATE FORM
                    </h2>
                    <div>

                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form action="{{ route('staff.create') }}" method="POST" class="flex flex-col justify-center items-center">
                            @csrf

                            <div class="mt-4">
                                <x-label for="firstname" :value="__('First name')" />

                                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus />
                            </div>


                            <div class="mt-4">
                                <x-label for="lastname" :value="__('Last name')" />

                                <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus />
                            </div>


                            <div class="mt-4">
                                <x-label for="username" :value="__('Username')" />

                                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
                            </div>

                            <div class="mt-4">
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                            </div>


                            <div class="mt-4">
                                <x-label for="password" :value="__('Password')" />

                                <x-input id="password" class="block mt-1 w-full"
                                                type="password"
                                                name="password"
                                                required autocomplete="new-password" />
                            </div>


                            <div class="mt-4">
                                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-input id="password_confirmation" class="block mt-1 w-full"
                                                type="password"
                                                name="password_confirmation" required />
                            </div>


                            <div class="mt-4">
                                <x-label for="gender" :value="__('Gender')" />

                                <select name="gender" id="gender" class="block mt-1 w-full">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>


                            <div class="mt-4">
                                <x-label for="dob" :value="__('Date of birth')" />

                                <x-input id="dob" class="block mt-1 w-full"
                                                type="date"
                                                name="dob" :value="old('dob')" />
                            </div>


                            <div class="mt-4">
                                <x-label for="address" :value="__('Address')" />

                                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus />
                            </div>


                            <div class="mt-4">
                                <x-label for="phone" :value="__('Phone')" />

                                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus />
                            </div>


                            <div class="mt-4">
                                <x-label for="identification_number" :value="__('Identification Number')" />

                                <x-input id="identification_number" class="block mt-1 w-full" type="text" name="identification_number" :value="old('identification_number')" required autofocus />
                            </div>


                            <div class="mt-4">
                                <x-label for="department_id" :value="__('Department')" />
                                <select name="department_id" id="department_id">
                                    @foreach ($departments as $department)
                                        <option value="{{$department->department_id}}">{{  $department->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mt-4">
                                <x-label for="salary" :value="__('Salary')" />

                                <x-input id="salary" class="block mt-1 w-full" type="text" name="salary" :value="old('salary')" required autofocus />
                            </div>


                            <x-button class="ml-4 mt-4">
                                {{ __('Create account') }}
                            </x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
