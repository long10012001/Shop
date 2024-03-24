<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function send_mail()
    {
        $to_name = "long";
        $to_email = "longb1910250@student.ctu.edu.vn";
        $data = array("name" => "Mail từ tài khoản khách hàng", "body" => "Mail gửi về vấn đề đơn hàng");
        Mail::send('send_mail', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email)->subject('test mail');
            $message->from($to_email, $to_name);
        });
    }
}
