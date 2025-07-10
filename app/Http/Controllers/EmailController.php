<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail($reciever, $message, $subject) {

        $reciever = 'mosaonetwothree@gmail.com';
        $message = 'hello';
        $subject = 'test email from laravel';

        $response = Mail::to($reciever)->send(new TestEmail($message, $subject));

    }
}
