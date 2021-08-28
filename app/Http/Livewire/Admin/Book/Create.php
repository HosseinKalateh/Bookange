<?php

namespace App\Http\Livewire\Admin\Book;

use App\Models\Book;
use App\Models\Author;
use App\Models\Translator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

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

    public function mount() 
    {
        $this->authors = Author::all();
        $this->translators = Translator::all();

        $this->bookAuthors = array();
        $this->bookTranslators = array();
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Book') ])]);
        
        if($this->getPropertyValue('picture') and is_object($this->picture)) {
            $this->picture = $this->getPropertyValue('picture')->store('public/images/books');
        }

        $book = Book::create([
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
        $book->authors()->attach($this->bookAuthors);

        // Relation With Translator 
        $book->translators()->attach($this->bookTranslators);

        return redirect('admin/books');
    }

    public function render()
    {
        return view('livewire.admin.book.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Book') ])]);
    }
}
