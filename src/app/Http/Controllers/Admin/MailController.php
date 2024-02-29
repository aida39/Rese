<?php

namespace App\Http\Controllers\Admin;

use App\Mail\AdminMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SendMailRequest;
use App\Models\User;

class MailController extends Controller
{
    public function showMailForm()
    {
        return view('admin/mail');
    }

    public function sendMail(SendMailRequest $request)
    {
        $data = $request->all();
        $emails = User::pluck('email')->all();

        Mail::to($emails)->send(new AdminMail($data['mail_subject'], $data['mail_message']));

        return redirect('/admin/done/mail');
    }

    public function doneMail()
    {
        return view('admin/mail_done');
    }
}
