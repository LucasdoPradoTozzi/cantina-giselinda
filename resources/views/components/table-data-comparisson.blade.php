@props(['minQuantity', 'maxQuantity'])

@php
$slotValue = intval(trim($slot));
$isOutOfRange = false;
$tooltipText = '';

$isOutOfRange = $slotValue < $minQuantity || $slotValue> $maxQuantity;
    if ($slotValue < $minQuantity) { $tooltipText='Abaixo da quantidade mínima' ; } elseif ($slotValue> $maxQuantity) {
        $tooltipText = 'Acima da quantidade máxima';
        }
        @endphp

        <td class="w-1/3 px-6 py-4 text-center whitespace-nowrap text-white border border-gray-700
    {{ $isOutOfRange ? 'bg-red-600' : 'bg-green-600' }}">
            @if ($isOutOfRange)
            <div class="relative inline-block">
                {{ $slot }}
                <div class="absolute top-1/2 left-full ml-2 transform -translate-y-1/2 p-2 bg-gray-800 text-white text-xs rounded shadow-lg">
                    {{ $tooltipText }}
                </div>
            </div>

            @else
            {{ $slot }}
            @endif
        </td>