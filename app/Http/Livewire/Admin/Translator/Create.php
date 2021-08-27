<?php

namespace App\Http\Livewire\Admin\Translator;

use App\Models\Translator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    
    protected $rules = [
        'first_name' => 'required|min:2|max:191',        'last_name' => 'required|min:2|max:191',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Translator') ])]);
        
        Translator::create([
            'first_name' => $this->first_name,            'last_name' => $this->last_name,            
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.translator.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Translator') ])]);
    }
}
