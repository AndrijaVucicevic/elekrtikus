<?php

namespace App\Http\Controllers;

use App\Mail\SignUpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public static function SendMailSignupEmail($name,$email,$email_verified_at)
    {
        $data=[
            'first_name'=>$name,
            'verification_code'=>$email_verified_at
        ];
        Mail::to($email)->send(new SignUpMail($data));
    }




}
