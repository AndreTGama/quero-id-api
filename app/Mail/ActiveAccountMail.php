<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ActiveAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $name;
    private $code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $email, string $name, string $code)
    {
        $this->email = $email;
        $this->name = $name;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('New Account');
        $this->to($this->email, $this->name);
        $url = env('APP_URL_ACTIVE') . "/" . $this->code;

        return $this->view('mail.activeaccountmail', [
            'email' => $this->email,
            'name' => $this->name,
            'url' => $url,
            'code' => $this->code
        ]);
    }
}
