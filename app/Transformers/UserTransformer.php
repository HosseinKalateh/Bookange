<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;
use App\Models\Book;
use App\Transformers\BookTransformer;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'usernmae' => $user->username,
            'email' => $user->email,
            'bio' => $user->bio,
            'age' => $user->age,
            'wishlist' => $this->getWishlistBooks(json_decode($user->wishlist))
        ];
    }

    // Get Books By Id 
    private function getWishlistBooks($wishlist)
    {
        $books = Book::find($wishlist);

        return fractal($books, BookTransformer::class);
    }
}
