@props(['rate' => $rate])

<div class="mb-4 p-2 rounded-lg" style="border-bottom: solid 1px rgba(66, 63, 63, 0.788)">
    <a href="{{ route('profile', ['guest' => $rate->guest]) }}" class="font-bold pr-3">{{ $rate->guest->user->first_name }} {{ $rate->guest->user->last_name }}</a><span class="text-gray-600 text-sm">{{ $rate->created_at->diffForHumans() }}</span>
    <p class="mb-2 ml-4">{{ $rate->rating }} star</p>
    <p class="mb-2 ml-8">{{ $rate->comment }}</p>

    @can('delete', $rate)
        <form action="{{ route('rates.destroy', $rate) }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 p-2 text-white rounded-lg ml-4">Xóa</button>
        </form>
    @endcan
{{--
<div class="flex items-center flex-col justify-center">

</div> --}}
</div>
