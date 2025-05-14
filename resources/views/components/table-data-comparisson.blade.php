@props(['minQuantity', 'maxQuantity'])

@php
$slotValue = intval(trim($slot));
$tooltipText = '';
$colorClass = 'bg-green-600';

if ($slotValue < $minQuantity) {
    $colorClass='bg-red-600' ;
    $tooltipText='Abaixo da quantidade mínima' ;
    } elseif ($slotValue> $maxQuantity) {
    $colorClass = 'bg-yellow-500 text-black';
    $tooltipText = 'Acima da quantidade máxima';
    }
    @endphp

    <td class="w-1/5 px-6 py-4 text-center whitespace-nowrap border border-gray-700 {{ $colorClass }}">
        @if ($tooltipText)
        <div class="relative inline-block group">
            {{ $slot }}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline ml-1 text-white group-hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <title>{{ $tooltipText }}</title>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18a9 9 0 100-18 9 9 0 000 18z" />
            </svg>
            <div class="absolute z-10 hidden group-hover:block top-full left-1/2 transform -translate-x-1/2 mt-2 px-3 py-2 bg-gray-800 text-white text-xs rounded shadow-lg whitespace-nowrap">
                {{ $tooltipText }}
            </div>
        </div>
        @else
        {{ $slot }}
        @endif
    </td>