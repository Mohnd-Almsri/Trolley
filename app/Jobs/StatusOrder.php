<?php

namespace App\Jobs;

use App\Models\Order;
use App\Traits\SendMessageTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class StatusOrder implements ShouldQueue
{
    use Queueable,SendMessageTrait;

    /**
     * Create a new job instance.
     */
    public $order;
    public $status;
    public $number;
    public function __construct($order, $status,$number)
    {
        $this->order = $order;
        $this->status = $status;
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        if ($this->status ==1) {
            $this->status ='Processing';
        }elseif ($this->status ==2) {
            $this->status ='shipping';
        }elseif ($this->status ==3) {
            $this->status ='delivered';
        }
       $this->orderStauts($this->status,$this->number);
        Order::find($this->order->id)->update(['status' => $this->status]);

    }
}
