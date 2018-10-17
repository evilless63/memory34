<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {
        $objSend = new \stdClass();
        if ($request->has('name')) {
            $objSend->name = $request->name;
        }

        if ($request->has('phone')) {
            $objSend->phone = $request->phone;
        }

        if ($request->has('email')) {
            $objSend->email = $request->email;
        }

        if ($request->has('product')) {
            $objSend->product = $request->product;
        }

        if ($request->has('title')) {
            $objSend->title = $request->title;
        }

        if ($request->has('text')) {
            $objSend->text = $request->text;
        }

        $mailTo = 'info@memory34.ru';

        Mail::to($mailTo)->send(new SendEmail($$objSend));
    }
}
