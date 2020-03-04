<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * login
     *
     * @param AuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthRequest $request)
    {
        $credentials = $request->validated();

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Register
     *
     * @param AuthRequest $request
     * @return mixed
     */
    public function register(AuthRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);
        unset($data['c_password']);

        $user = User::create($data);

        $user['test'] = $request->route()->getName();

        return $user->toJson();
    }
}
