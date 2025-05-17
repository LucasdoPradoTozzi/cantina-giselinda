<?php

namespace App\Livewire;

use App\Models\WasteReason;
use Livewire\Component;

class EditWasteReason extends Component
{
    public WasteReason $wasteReason;
    public $name;
    public $description;

    public function mount(WasteReason $wasteReason)
    {
        $this->wasteReason = $wasteReason;
        $this->name = $wasteReason->name;
        $this->description = $wasteReason->description;
    }

    protected function rules()
    {
        return [
            'name' => 'required|max:60',
            'description' => 'required|max:255'
        ];
    }

    protected $messages = [
        'name.required' => 'O nome é obrigatório.',
        'name.max' => 'O nome não pode ter mais que 60 caracteres.',
        'description.required' => 'A descrição é obrigatória.',
        'description.max' => 'A descrição não pode ter mais que 255 caracteres.'
    ];

    public function update()
    {
        $this->validate();

        $this->wasteReason->update([
            'name' => $this->name,
            'description' => $this->description
        ]);

        session()->flash('message', 'Motivo de descarte atualizado com sucesso!');
        return redirect()->route('waste-reasons.index');
    }

    public function render()
    {
        return view('livewire.edit-waste-reason');
    }
}
