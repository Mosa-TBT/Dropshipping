<?php


// there is some probluem with concurency in timer calling !!!

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use Exception;
use Illuminate\Http\Request;
use App\Models\subscribers;
use Illuminate\Support\Facades\Mail;
use Route;
use App\Models\temp_email_for_varifying;


class FotterPagesController extends Controller
{
    public function showPages() {

        $rout_name = Route::current()->uri();

        if($rout_name == 'about') {

            return view('about');

        }else if($rout_name == 'contuct') {

            return view('contuct_us');

        }else if($rout_name == 'support') {

            return view('customer_support');

        }else if($rout_name == 'faq') {

            return view('FAQ');

        }

    }


    public function store(Request $request) {

        $rout_name = Route::current()->uri();

        if($rout_name == 'save_new_subscriber') {
        
            $already_exist = subscribers::where('Email', $request->email)->get();

            if(count($already_exist) == 0) {

                $subscribers = new subscribers();

                $subscribers->email = $request->email;

                $subscribers->save();

                echo json_encode(['is_added' => true]);

            }else {

                echo json_encode(['is_added' => false]);

            }

        }

    }

}



