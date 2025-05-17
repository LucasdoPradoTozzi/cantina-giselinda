<?php

namespace App\Livewire;

use App\Models\WasteReason;
use Livewire\Component;

class WasteReasonCreate extends Component
{
    public $name;
    public $description;

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

    public function store()
    {
        $this->validate();

        WasteReason::create([
            'name' => $this->name,
            'description' => $this->description
        ]);

        session()->flash('message', 'Motivo de descarte criado com sucesso!');
        return redirect()->route('waste-reasons.index');
    }

    public function render()
    {
        return view('livewire.waste-reason-create');
    }
}
