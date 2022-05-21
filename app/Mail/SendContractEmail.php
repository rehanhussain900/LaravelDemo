<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContractEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contract)
    {
        $this->data['contract'] = $contract;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contract' , $this->data)
                        ->attach(public_path('contracts/contract-' . $this->data['contract']->id . '.pdf'), [
                            'as' => 'contract.pdf',
                            'mime' => 'application/pdf',
                    ]);
    }
}
