<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;

class AccountsController extends Controller
{
    public function sendEmail(Request $request)
    {
        $email_address = $request->email;
        $credentials = ['email' => $email_address];
        $response = Password::sendResetLink($credentials, function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return 'saq';
            case Password::INVALID_USER:
                return 'no';
        }
    }
}
