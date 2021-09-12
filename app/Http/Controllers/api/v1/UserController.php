<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Requests\user\UserUpdate;
use App\Models\User;
use App\Models\Book;

class UserController extends ApiController
{
    // Show User
    public function show(User $user)
    {
        $authenticatedUser = auth()->user();

        // Check That Authenticated User Is Same With User
        if ($user->id == $authenticatedUser->id) {
            return $this->showOne($user, 200);
        } else {
            abort(403, 'This action is unauthorized.');
        }
    }

    // Update User
    public function update(UserUpdate $request, User $user)
    {

        $user->name     = $request->name;
        $user->username = $request->username ?? null;
        $user->bio      = $request->bio ?? null;
        $user->age      = $request->age ?? null;

        $user->save();

        return $this->showOne($user, 200);
    }

    // Show User Wishlist
    public function showWishlist(User $user)
    {
        $authenticatedUser = auth()->user();

        // Check That Authenticated User Is Same With User
        if ($user->id == $authenticatedUser->id) {
            return $this->showOne($user, 200);
        } else {
            abort(403, 'This action is unauthorized.');
        }
    }

    // Update User Wishlist
    public function updateWishlist(User $user, Book $book)
    {
        $authenticatedUser = auth()->user();

        // Check That Authenticated User Is Same With User
        if ($user->id == $authenticatedUser->id) {

            $wishlist = json_decode($user->wishlist);
            if (!empty($wishlist) && in_array($book->id, $wishlist)) {
                // The Book Is Exist In Wishlist Now
                return $this->showErrorMessage('The book is in the user wishlist now', 400);
            } else {
                // Add Book To Wishlist
                $wishlist[] = $book->id;
                $user->wishlist = json_encode($wishlist);
                $user->save();
                return $this->showOne($user, 200);
            }   
        } else {
            abort(403, 'This action is unauthorized.');
        }
    }
}
