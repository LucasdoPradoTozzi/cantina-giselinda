@props(['class' => ''])

<td {{ $attributes->merge(['class' => "w-1/3 px-6 py-4 text-center whitespace-nowrap text-white border border-gray-700 $class"]) }}>
    {{ $slot }}
</td>