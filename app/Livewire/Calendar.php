<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\DisableDate;
use Carbon\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    public $orders = [];
    public $disabledDates = [];

    public function mount()
    {
        // Load all order events
        foreach (Order::all() as $order) {
            $this->orders[] = [
                'id' => $order->id,
                'title' => $order->name,
                'start' => Carbon::parse($order->date)->format('Y-m-d'), // Use 'start' to match FullCalendar format
            ];
        }

        // Load all disabled dates from the database
        $this->disabledDates = DisableDate::pluck('date')->toArray();
    }

    // Method to disable a date and save it to the database
    public function disableDate($date)
    {
        // Save disabled date to database if not already present
        if (!in_array($date, $this->disabledDates)) {
            DisableDate::create(['date' => $date]);
            $this->disabledDates[] = $date; // Add to array of disabled dates
        }
    }

    public function render()
    {
        return view('livewire.calendar', [
            'orders' => $this->orders, // Pass order data
            'disabledDates' => $this->disabledDates, // Pass disabled dates
        ]);
    }
}
