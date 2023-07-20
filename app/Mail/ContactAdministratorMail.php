<?php

namespace App\Mail;


use App\Http\Requests\ContactAdminRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ContactAdministratorMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData = "")
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Test Email')->view('frontend.email.email');
    }
    public function sendMail(ContactAdminRequest $request)
    {
        $mailData = [
            "name" => $request->input("name"),
            "email" => $request->input('email'),
            "message" => $request->input("message")
        ];

        Mail::to("ignjat1122@gmail.com")->send(new ContactAdministratorMail($mailData));

        return redirect()->route("contactAdmin")->with("success", "Mail sended successfuly");
    }

}
