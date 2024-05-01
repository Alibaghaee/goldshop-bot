<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewProject extends Mailable
{
    use Queueable, SerializesModels;

    private $data;
    private $file_path;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $file_path)
    {
        $this->data      = $data;
        $this->file_path = $file_path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.project.new', [
            'data'      => $this->data,
            'file_path' => $this->file_path,
        ]);
    }
}
