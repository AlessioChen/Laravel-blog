<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthLogoutRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\AuthLoginResource;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
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
     * Attempt logout
     *
     * @param AuthLogoutRequest $request
     * @return string
     */
    public function logout(AuthLogoutRequest $request)
    {


        Auth::user()->currentAccessToken()->delete();


        return response(null, 204);
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

        // Check if email is already taken
        if (User::where('email', $request->email)->exists()) {
            throw new Exception('user already exist');
        }



        //Save user

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);



        return new AuthResource($user);
    }
}
