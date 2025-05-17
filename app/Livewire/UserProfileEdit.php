<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfileEdit extends Component
{
    use WithFileUploads;
    
    public $name;
    public $email;
    public $current_password;
    public $password;
    public $password_confirmation;
    public $photo;
    
    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|max:255',
        'current_password' => 'nullable|required_with:password',
        'password' => 'nullable|min:8|confirmed',
        'photo' => 'nullable|image|max:1024', // 1MB Max
    ];
    
    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }
    
    public function update()
    {
        $this->validate();
        
        $user = Auth::user();
        
        // Check if email is being changed and it's already taken
        if ($this->email !== $user->email) {
            $this->validate([
                'email' => 'unique:users,email'
            ]);
        }
        
        // Check current password if password is being changed
        if ($this->password) {
            if (!Hash::check($this->current_password, $user->password)) {
                $this->addError('current_password', 'A senha atual está incorreta.');
                return;
            }
        }
        
        // Update user information
        $user->name = $this->name;
        $user->email = $this->email;
        
        if ($this->password) {
            $user->password = Hash::make($this->password);
        }
        
        // Handle photo upload if provided
        if ($this->photo) {
            // Delete old photo if it exists
            if ($user->photo_path) {
                Storage::disk('public')->delete('photos/' . $user->photo_path);
            }
            
            // Store new photo
            $photoPath = $this->photo->store('photos', 'public');
            $user->photo_path = basename($photoPath);
        }
        
        $user->save();
        
        session()->flash('message', 'Perfil atualizado com sucesso!');
        
        // Reset form fields
        $this->reset(['current_password', 'password', 'password_confirmation', 'photo']);
    }
    
    public function render()
    {
        return view('livewire.user-profile-edit');
    }
}
