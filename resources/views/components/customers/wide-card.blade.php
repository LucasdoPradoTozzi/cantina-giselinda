@props(['customer'])

<x-panel class="flex gap-x-6">
    <!-- <div>
        <img src="{{ asset('storage/photos/' . $customer->photo_path) }}" alt="{{$customer->name}}" class="w-32 h-32 rounded-xl">
    </div> -->

    <div class="flex-1 flex flex-col">
        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800">
            <a href="/customers/{{$customer->id}}">
                {{ $customer->name }}
            </a>
        </h3>
    </div>

    <div>

    </div>
</x-panel>