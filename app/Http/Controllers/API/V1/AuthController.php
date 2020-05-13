<?php
namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;

// use Validator;

class AuthController extends Controller {
    public function login(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $request->user();

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;

            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeeks(1);
            }

            $token->save();

            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        }
        return response()->json([
            'message' => 'data not found'
        ], 404);
    }

    public function getUser(Request $request) {
        return response()->json($request->user());
    }

    public function logout(Request $request) {
        $token = $request->user()->token();
        $token->revoke();

        return response()->json([
            'message' => 'success to logout'
        ]);
    }
}