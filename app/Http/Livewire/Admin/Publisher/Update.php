<?php

namespace App\Http\Livewire\Admin\Publisher;

use App\Models\Publisher;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $publisher;

    public $name;
    
    protected $rules = [
        'name' => 'required|min:2|max:191|unique:publishers,name',        
    ];

    public function mount(Publisher $publisher){
        $this->publisher = $publisher;
        $this->name = $this->publisher->name;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Publisher') ]) ]);
        
        $this->publisher->update([
            'name' => $this->name,            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.publisher.update', [
            'publisher' => $this->publisher
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Publisher') ])]);
    }
}
