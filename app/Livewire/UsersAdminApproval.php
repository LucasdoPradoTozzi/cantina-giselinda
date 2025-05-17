<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersAdminApproval extends Component
{
    use WithPagination;

    public $search = '';

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function approveUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->is_approved = 1;
        $user->save();
        
        session()->flash('message', 'Usuário aprovado com sucesso!');
    }

    public function rejectUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        
        session()->flash('message', 'Usuário rejeitado e removido com sucesso!');
    }

    public function render()
    {
        $users = User::where('is_approved', 0)
            ->when($this->search, function ($query) {
                return $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.users-admin-approval', ['users' => $users]);
    }
}
