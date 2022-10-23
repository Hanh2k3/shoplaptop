<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    //

    public function send_mail() {

       
        $to_name = "lehanh29102019@gmail.com";
        $to_email = "lehanh29102019@gmail.com";//send to this email

        $data = array("name"=>"noi dung ten","body"=>"noi dung body"); //body of mail.blade.php
    
        Mail::send('pages.mail',compact('data'),function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test mail nhé');//send this mail with subject
        });
        return redirect() -> route('home.');
       
    }
}
