@props(['class' => ''])

<th {{ $attributes->merge(['class' => "w-1/3 px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider border border-gray-700 $class"]) }}>
    {{ $slot }}
</th>