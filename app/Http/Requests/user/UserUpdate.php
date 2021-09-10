<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->route("user");

        $authenticatedUser = auth()->user();

         // Check That Authenticated User Is Same With User
        if ($user->id == $authenticatedUser->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->route("user");
       
        return [
            'name' => 'required|string|min:3|max:255',
            'username' => 'nullable|string|min:2|max:255|unique:users,username,'.$user->id,
            'bio'      => 'nullable|string',
            'age'      => 'nullable|numeric|min:0',
        ];
    }
}
