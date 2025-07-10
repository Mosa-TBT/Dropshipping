<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\temp_email_for_varifying;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use Exception;

class EmailVarificationController extends Controller
{
    function generateNumericVerificationCode($length = 6) {

        return str_pad(mt_rand(1, 999999), $length, '0', STR_PAD_LEFT);

    }
    
    public function sendEmail(Request $request) {

        $new_row = new temp_email_for_varifying();

        $varification_code = $this->generateNumericVerificationCode(6);

        $new_row->Email = $request->email;
        $new_row->varification_code = $varification_code;

        $new_row->save();


        try {

            Mail::to($request->email)->send(new TestEmail('Varifying your email', 'Your varification code is : ' . $varification_code));

            echo json_encode(['email_sent' => true, 'email_sent_at' =>  strval(time())]);


        } catch (Exception $exception) {

            temp_email_for_varifying::where('Email', $request->email)->get()->delete();

            echo json_encode(['email_sent' => false, 'message' => 'An error with this message occored ' . $exception]);

        }

    }

    public function varifyEmail(Request $request) {

        $row = temp_email_for_varifying::where('Email', $request->email)->first();

        error_log($request->email_was_sent_at);

        if(time() - $request->email_was_sent_at >= 30) {  // check if time for varification is left or not

            $row->delete();

            echo json_encode(['varifyied' => false]);

            die;

        }else {

            error_log($row->varification_code == $request->inserted_code);
        
            if($row->varification_code == $request->inserted_code) {

                $row->delete();

                echo json_encode(['varifyied' => true]);

            }else {

                $row->delete();

                echo json_encode(['varifyied' => false]);

            }

        }

    }
}
