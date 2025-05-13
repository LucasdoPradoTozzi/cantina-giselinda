<div class="flex items-center space-x-4 bg-white rounded-2xl shadow p-4 w-full max-w-md">

    <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xl">
        <img src="{{ ($customer->photo_path) ? asset('storage/photos/' . $customer->photo_path) :  asset('images/noPhoto.jpg') }}"
            alt="Foto do Cliente"
            class="w-16 h-16 rounded-full border border-white/20 object-cover">
    </div>

    <div>
        <a href="/customers/{{ $customer->id }}"
            wire:navigate
            class="text-lg font-semibold text-gray-900 hover:underline hover:text-blue-600 transition">
            {{ $customer->name }}
        </a>

        <div class="text-sm text-gray-600 space-y-1 mt-1">
            @if($customerBirthday)
            <div><strong>Aniversário:</strong> {{ $customerBirthday }}</div>
            @endif

            @if($customer->doc1)
            <div><strong>RG:</strong> {{ $customer->doc1 }}</div>
            @endif

            @if($customer->doc2)
            <div><strong>CPF:</strong> {{ $customer->doc2 }}</div>
            @endif

            @if($customer->email)
            <div><strong>Email:</strong> {{ $customer->email }}</div>
            @endif
        </div>
    </div>
</div>