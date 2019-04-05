<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Mail\WelcomeMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['login']]);
//    }

    public function index()
    {
    }

    public static function getResponse($data, $message, $code)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];
        if ($code != 200) {
            $response['success'] = false;
        }
        return response()->json($response, $code);
    }


    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


    /**
     * SignUp
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function register(RegisterFormRequest $request)
    {

        $user = new User();
        $user->fill($request->all());
        if (!$user->save()) {
            return self::getResponse(null, 'User create false', 403);
        }
        Mail::to($request['email'])->send(new WelcomeMail($user));
        return self::getResponse($user, 'User created successfully', 200);
    }

    /**
     * Login
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 400);
        }
        return response()->json(compact('token'));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        $newToken = auth()->refresh();
        return response($newToken, 200);
    }

    public function getUserInfor(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }

    public function updatePassword($id,Request $request){
        $user = User::find($id);
        if ($user->remember_token = $request->token) {
            $user->password = $request->password;
            $user->save();
            return response()->json(['message'=>'Reset Password Successfully']);
        }
        else return response()->json(['message'=>'Reset Password Fail']);
    }

}
