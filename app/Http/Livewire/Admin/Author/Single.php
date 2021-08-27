<?php

namespace App\Http\Livewire\Admin\Author;

use App\Models\Author;
use Livewire\Component;

class Single extends Component
{

    public $author;

    public function mount(Author $author){
        $this->author = $author;
    }

    public function delete()
    {
        $this->author->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Author') ]) ]);
        $this->emit('authorDeleted');
    }

    public function render()
    {
        return view('livewire.admin.author.single')
            ->layout('admin::layouts.app');
    }
}
