<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $category;

    public $name;
    public $sort_order;
    public $is_active;
    
    public $rules;  

    public function mount(Category $category){
        $this->category = $category;
        $this->name = $this->category->name;
        $this->sort_order = $this->category->sort_order;
        $this->is_active = $this->category->is_active;    

        // Initialize rules 
        # I do this because ignore the unique id
        $this->rules = [
            'name' => 'required|min:2|unique:categories,name,'.$this->category->id,
            'sort_order' => 'nullable|numeric|min:1',
            'is_active' => 'sometimes',        
        ];    
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Category') ]) ]);
        
        $this->category->update([
            'name' => $this->name,
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.category.update', [
            'category' => $this->category
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Category') ])]);
    }
}
