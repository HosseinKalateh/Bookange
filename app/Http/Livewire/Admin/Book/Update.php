<?php

namespace App\Http\Livewire\Admin\Book;

use App\Models\Book;
use App\Models\Author;
use App\Models\Translator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $book;

    public $name;
    public $category_id;
    public $publisher_id;
    public $price;
    public $ISBN;
    public $number_of_pages;
    public $published_at;
    public $description;
    public $picture;

    ##
    public $authors;
    public $translators;

    public $bookAuthors;
    public $bookTranslators;
    
    protected $rules = [
        'category_id' => 'required',        
        'publisher_id' => 'required',        
        'price' => 'required|numeric',
        'ISBN' => 'required',        
        'number_of_pages' => 'required',        
        'published_at' => 'required',        
        'description' => 'required',  
        'bookAuthors' => 'required',
        'bookTranslators' => 'required'      
    ];

    public function mount(Book $book){
        $this->book = $book;
        $this->name = $this->book->name;
        $this->category_id = $this->book->category_id;
        $this->publisher_id = $this->book->publisher_id;
        $this->price = $this->book->price;
        $this->ISBN = $this->book->ISBN;
        $this->number_of_pages = $this->book->number_of_pages;
        $this->published_at = $this->book->published_at;
        $this->description = $this->book->description;
        $this->picture = $this->book->picture;      

        $this->authors = Author::all();
        $this->translators = Translator::all();

        $authors = $book->authors;

        $this->bookAuthors = array();
        foreach ($authors as $key => $value) {
            $this->bookAuthors[] = $value->id;
        }

        $translators = $book->translators;  

        $this->bookTranslators = array();
        foreach ($translators as $key => $value) {
            $this->bookTranslators[] = $value->id;
        }
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Book') ]) ]);
        
        if($this->getPropertyValue('picture') and is_object($this->picture)) {
            $this->picture = $this->getPropertyValue('picture')->store('public/images/books');
        }

        $this->book->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'publisher_id' => $this->publisher_id,
            'price' => $this->price,
            'ISBN' => $this->ISBN,
            'number_of_pages' => $this->number_of_pages,
            'published_at' => $this->published_at,
            'description' => $this->description,
            'picture' => $this->picture,            
        ]);

        ## Book Relations ## 

        // Relation With Author
       $this->book->authors()->sync($this->bookAuthors);

        // Relation With Translator 
        $this->book->translators()->sync($this->bookTranslators);
    }

    public function render()
    {
        return view('livewire.admin.book.update', [
            'book' => $this->book
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Book') ])]);
    }
}
