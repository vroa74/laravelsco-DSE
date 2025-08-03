<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Helpers\AvatarHelper;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    public $photo;
    public $state = [
        'name' => '',
        'email' => '',
    ];

    public function mount()
    {
        $this->state = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ];
    }

    public function updateProfileInformation()
    {
        $this->validate([
            'state.name' => 'required|string|max:255',
            'state.email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();
        
        $user->update([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
        ]);

        // Manejar foto de perfil
        if ($this->photo) {
            // Eliminar foto anterior si existe
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Guardar nueva foto
            $photoPath = $this->photo->store('profile-photos', 'public');
            $user->update(['profile_photo_path' => $photoPath]);
        }

        $this->photo = null;
        $this->emit('saved');
        
        // Forzar actualización de la vista para mostrar la nueva foto
        $this->dispatch('$refresh');
    }

    public function deleteProfilePhoto()
    {
        $user = auth()->user();
        
        if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }
        
        $user->update(['profile_photo_path' => null]);
        
        // Forzar actualización de la vista
        $this->dispatch('$refresh');
    }

    public function generateAvatar($name, $size = 80)
    {
        return AvatarHelper::generate($name, $size);
    }

    public function updatedPhoto()
    {
        // Este método se ejecuta cuando se selecciona una nueva foto
        if ($this->photo) {
            // Forzar actualización de la vista para mostrar la vista previa
            $this->dispatch('$refresh');
        }
    }

    public function render()
    {
        return view('livewire.profile.update-profile-information-form');
    }
} 