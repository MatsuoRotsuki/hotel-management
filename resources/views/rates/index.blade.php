<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ratings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl justify-self-center justify-center font-semibold text-center">
                        RATING FORM
                    </h2>
                    <div>
                        {{$avgRate}}
                    </div>
                    <div>
                        <form action="{{ route('rates.create') }}" method="POST" class="mb-4">
                            @csrf
                            <div class="mb-4">
                                <label for="rating" class="sr-only"></label>
                                <select name="rating" id="rating-selector" class="mb-4">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>

                                @error('rating')
                                <div class="text-red-500 mt-2 text-sm">
                                    Bạn chưa thể đánh giá khi chưa thuê phòng!
                                </div>
                                @enderror
                                @error('alreadyRated')
                                <div class="text-red-500 mt-2 text-sm">
                                    Bạn chỉ được đánh giá 1 lần thôi
                                </div>
                                @enderror

                                <label for="comment" class="sr-only"></label>
                                <textarea name="comment" id="comment" cols="30" rows="3" class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('comment') border-red-500 @enderror" placeholder="{{ auth()->user()->firstname }} ơi, hãy viết cảm nhận của bạn về khách sạn nhé"></textarea>
                                @error('body')
                                    <div class="text-red-500 mt-2 text-sm">
                                        Bạn phải viết bình luận mới đánh giá được!
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="text-white px-4 py-2 rounded font-medium bg-gray-700">Hoàn thành</button>
                            </div>
                        </form>

                        @if($rates->count())
                            @foreach ($rates as $rate)
                                <x-rate :rate="$rate"></x-rate>
                            @endforeach

                            {{-- {{ $rates->links() }} --}}
                        @else
                            <p> Chưa có lượt đánh giá nào </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
