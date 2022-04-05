<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class joinus extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $mail = $this->view('mail.joinus',compact('data'))
                    ->from('website@care-hub.net')
                    ->subject('Join App');
                    
        if(isset($this->data['Real_Path'])){
            $mail ->attach($this->data['Real_Path'],
            [
                'as' => $this->data['att_as'],
                'mime' => $this->data['att_mime'],
            ]);
        }
                    

    //    if (isset($this->data['attachments'])){
    //        $v = $this->data['attachments'];
    //        $mail = $mail->attach($v["path"], [
    //            'as' => $v["as"],
    //            'mime' => $v["mime"],
    //        ]);
    //    }

        return $mail;
    }
}
