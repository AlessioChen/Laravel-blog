<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\AuthLoginResource;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Attempt login
     *
     * @param AuthLoginRequest $request
     * @return AuthLoginResource
     * @throws ValidationException
     */
    public function login(AuthLoginRequest $request): AuthLoginResource
    {


        $user = User::where('email', $request->email)->firstOrFail();

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
        }

        return new AuthLoginResource($user);
    }


 /**
     * Attempt registration
     *
     * @param AuthRegisterRequest $request
     * @return AuthResource
     * @throws ValidationException
     * @throws Exception
     */
    public function register(AuthRegisterRequest $request): AuthResource
    {

        // Check if passwords corresponds

        if ($request->password1 != $request->password2) {
            throw ValidationException::withMessages([
                'password' => ["passwords don't match"],
            ]);
        }

        // Check if email is already taken

        if (User::where('email', $request->email)->exists()) {
            throw new Exception('user already exist');
        }

        //Save user

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password1,
        ]);



        return new AuthResource($user);
    }
}
