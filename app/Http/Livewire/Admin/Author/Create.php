<?php

namespace App\Http\Livewire\Admin\Author;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $description;
    
    protected $rules = [
        'first_name' => 'required|min:2|max:191',
        'last_name' => 'required|min:2|max:191',
        'description' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Author') ])]);
        
        Author::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'description' => $this->description,            
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.author.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Author') ])]);
    }
}
