@section('title', 'Editar Produto')
<div>
    <div class="pt-4">
        <x-forms.form wire:submit.prevent="update" enctype="multipart/form-data">
            <div class="mb-4 flex flex-col items-center justify-center">
                @if ($photo)
                <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="w-24 h-24 object-cover rounded-lg mb-2">
                @elseif ($product->photo_path)
                <img src="{{ asset('storage/photos/' . $product->photo_path) }}" alt="Foto atual" class="w-24 h-24 object-cover rounded-lg mb-2">
                @else
                <img src="{{ asset('images/noPhoto.jpg') }}" alt="Foto padrão" class="w-24 h-24 object-cover rounded-lg mb-2">
                @endif
                <div>
                    <input type="file" id="photo" wire:model="photo" class="hidden">
                    <label for="photo"
                        class="inline-block cursor-pointer bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                        Selecionar foto
                    </label>
                    @error('photo')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <x-forms.input wire:model="name" label="Nome do Produto" name="name" />
            <x-forms.input-text wire:model="description" label="Descrição do Produto" name="description" />
            <x-forms.input-money wire:model.live.debounce.300ms="value" label="Valor do Produto" name="value" />
            <x-forms.input-money wire:model.live.debounce.300ms="buyValue" label="Valor de Compra do Produto" name="buyValue" />
            <x-forms.select wire:model="productTypeId" label="Tipo do Produto" name="product_type_id">
                <option value=""></option>
                @foreach($productTypes as $productType)
                <option value="{{$productType->id}}">
                    {{$productType->name}}
                </option>
                @endforeach
            </x-forms.select>
            <x-forms.input wire:model.live.debounce.300ms="minimumAmount" label="Estoque Minimo" name="minimumAmount" />
            <x-forms.input wire:model.live.debounce.300ms="maximumAmount" label="Estoque Máximo" name="maximumAmount" />
            <x-forms.divider />
            <x-forms.button wire:loading.attr="disabled" type="submit">Salvar</x-forms.button>
            @if ($errors->has('form'))
            <div class="bg-red-100 text-red-700 border border-red-400 px-4 py-3 rounded mb-4">
                {{ $errors->first('form') }}
            </div>
            @endif
        </x-forms.form>
    </div>
</div>
