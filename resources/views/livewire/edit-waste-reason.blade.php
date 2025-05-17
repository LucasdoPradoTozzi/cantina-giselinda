@section('title', 'Editar Motivo de Descarte')
<div>
    <div class="pt-4">
        <x-forms.form wire:submit.prevent="update">
            <x-forms.input wire:model="name" label="Nome do Motivo" name="name" />
            <x-forms.input-text wire:model="description" label="Descrição do Motivo" name="description" />

            <x-forms.divider />

            <x-forms.button wire:loading.attr="disabled" type="submit">Atualizar</x-forms.button>
            @if ($errors->has('form'))
            <div class="bg-red-100 text-red-700 border border-red-400 px-4 py-3 rounded mb-4">
                {{ $errors->first('form') }}
            </div>
            @endif
        </x-forms.form>
    </div>
</div>