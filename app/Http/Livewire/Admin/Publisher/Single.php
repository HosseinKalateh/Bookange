<?php

namespace App\Http\Livewire\Admin\Publisher;

use App\Models\Publisher;
use Livewire\Component;

class Single extends Component
{

    public $publisher;

    public function mount(Publisher $publisher){
        $this->publisher = $publisher;
    }

    public function delete()
    {
        $this->publisher->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Publisher') ]) ]);
        $this->emit('publisherDeleted');
    }

    public function render()
    {
        return view('livewire.admin.publisher.single')
            ->layout('admin::layouts.app');
    }
}
