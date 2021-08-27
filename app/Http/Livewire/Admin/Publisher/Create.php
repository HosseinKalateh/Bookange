<?php

namespace App\Http\Livewire\Admin\Publisher;

use App\Models\Publisher;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    
    protected $rules = [
        'name' => 'required|min:2|max:191|unique:publishers,name',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Publisher') ])]);
        
        Publisher::create([
            'name' => $this->name,            
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.publisher.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Publisher') ])]);
    }
}
