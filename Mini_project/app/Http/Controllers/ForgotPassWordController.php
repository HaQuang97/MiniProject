<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPassWordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function __invoke(Request $request)
    {
        // TODO: Implement __invoke() method.
        $this->validateEmail($request);
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
        if($request->expectsJson()) {
            return $response == Password::RESET_LINK_SENT
                ? response()->json(['message' => 'Reset link sent to your email.', 'status' => true], 201)
                : response()->json(['message' => 'Unable to send reset link', 'status' => false], 401);
        }
    }


}
