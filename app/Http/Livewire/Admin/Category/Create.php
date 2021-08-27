<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $sort_order;
    public $is_active;
    
    protected $rules = [
        'name' => 'required|min:2|unique:categories,name',
        'sort_order' => 'nullable|numeric|min:1',
        'is_active' => 'sometimes',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Category') ])]);
        
        Category::create([
            'name' => $this->name,
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active ?? false,            
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.category.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Category') ])]);
    }
}
