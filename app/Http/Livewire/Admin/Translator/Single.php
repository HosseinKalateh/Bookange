<?php

namespace App\Http\Livewire\Admin\Translator;

use App\Models\Translator;
use Livewire\Component;

class Single extends Component
{

    public $translator;

    public function mount(Translator $translator){
        $this->translator = $translator;
    }

    public function delete()
    {
        $this->translator->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Translator') ]) ]);
        $this->emit('translatorDeleted');
    }

    public function render()
    {
        return view('livewire.admin.translator.single')
            ->layout('admin::layouts.app');
    }
}
