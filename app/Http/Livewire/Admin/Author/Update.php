<?php

namespace App\Http\Livewire\Admin\Author;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $author;

    public $first_name;
    public $last_name;
    public $description;
    
    protected $rules = [
        'first_name' => 'required|max:191',
        'last_name' => 'required|max:191',
        'description' => 'required',        
    ];

    public function mount(Author $author){
        $this->author = $author;
        $this->first_name = $this->author->first_name;
        $this->last_name = $this->author->last_name;
        $this->description = $this->author->description;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Author') ]) ]);
        
        $this->author->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'description' => $this->description,            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.author.update', [
            'author' => $this->author
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Author') ])]);
    }
}
