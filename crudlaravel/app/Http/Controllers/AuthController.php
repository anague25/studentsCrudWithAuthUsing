<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        try {

            $data = $request->validated();

            if (Auth::attempt($data)) {

                $user = Auth::user();
                $token = $user->createToken('MY_SECRET_KEY')->plainTextToken;


                return response()->json([
                    'status_code' => 1,
                    'status_message' => 'User logged',
                    'user' => $user,
                    'token' => $token

                ], 200);
            } else {
                return response()->json([
                    'status_code' => 0,
                    'status_message' => 'Invalid information',

                ], 403);
            }
        } catch (Exception $e) {

            return response()->json($e);
        }
    }



    public function register(Request $request)
    {


        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:6',

        ]);



        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer',

        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
