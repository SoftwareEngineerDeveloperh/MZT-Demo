<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Order

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
	
	public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        //
	$this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('2ph2xyxgab@coooooool.com','Example')
//		->view('emails.orders.shipped');
		->markdown('emails.orders.shipped,['url]=>$this->orderUrl]);
    }
}
