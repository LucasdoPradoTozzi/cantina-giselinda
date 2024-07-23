@props(['href'])

<td class="w-1/3px-6 py-4 text-center whitespace-nowrap text-white border border-gray-700">
    <a href="{{ $href }}" class="text-white hover:text-gray-300">{{ $slot }}</a>
</td>