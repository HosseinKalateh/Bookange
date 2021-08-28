<?php

namespace App\Http\Livewire\Admin\Book;

use App\Models\Book;
use Livewire\Component;

class Single extends Component
{

    public $book;

    public function mount(Book $book){
        $this->book = $book;
    }

    public function delete()
    {
        $this->book->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Book') ]) ]);
        $this->emit('bookDeleted');
    }

    public function render()
    {
        return view('livewire.admin.book.single')
            ->layout('admin::layouts.app');
    }
}
