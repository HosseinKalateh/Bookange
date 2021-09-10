<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\User;

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
            abort(403, 'Access denied');
        }
    }
}
