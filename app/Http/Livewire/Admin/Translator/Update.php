<?php

namespace App\Http\Livewire\Admin\Translator;

use App\Models\Translator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $translator;

    public $first_name;
    public $last_name;
    
    protected $rules = [
        'first_name' => 'required|min:2|max:191',        'last_name' => 'required|min:2|max:191',        
    ];

    public function mount(Translator $translator){
        $this->translator = $translator;
        $this->first_name = $this->translator->first_name;
        $this->last_name = $this->translator->last_name;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Translator') ]) ]);
        
        $this->translator->update([
            'first_name' => $this->first_name,            'last_name' => $this->last_name,            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.translator.update', [
            'translator' => $this->translator
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Translator') ])]);
    }
}
