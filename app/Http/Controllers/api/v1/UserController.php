<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Requests\user\UserUpdate;
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
}
