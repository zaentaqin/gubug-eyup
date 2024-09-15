<?php

namespace App\Livewire;

use App\Models\Catalog;
use Livewire\Component;
use App\Models\DisableDate;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class BookingPage extends Component
{
    use WithPagination;

    public $decorations;
    public $additionalItems;

    public $date;
    public $name;
    public $address;
    public $weddingLocation;
    public $note;

    public $cart = [];
    public $grandTotal = 0;

    public $disableDates = [];

    public function mount()
    {
        $this->decorations = Catalog::where('category', 'Decoration')->get();
        $this->additionalItems = Catalog::where('category', 'Additional Item')->get();
        $this->disableDates = DisableDate::pluck('date')->toArray();

        $this->calculateGrandTotal();
    }

    public function updateDate($selectedDate)
    {
        $this->date = $selectedDate;
    }

    public function addToCart($id)
    {
        $item = Catalog::find($id);

        $index = collect($this->cart)->search(function ($cartItem) use ($id) {
            return $cartItem['id'] === $id;
        });

        if ($index !== false) {
            $this->cart[$index]['quantity']++;
        } else {
            $this->cart[] = [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => 1,
            ];
        }

        $this->calculateGrandTotal();
    }

    public function removeFromCart($id)
    {
        $this->cart = collect($this->cart)->filter(function ($cartItem) use ($id) {
            return $cartItem['id'] !== $id;
        })->values()->toArray();

        $this->calculateGrandTotal();
    }

    public function increaseQuantity($id)
    {
        $index = collect($this->cart)->search(function ($cartItem) use ($id) {
            return $cartItem['id'] === $id;
        });

        if ($index !== false) {
            $this->cart[$index]['quantity']++;
            $this->calculateGrandTotal();
        }
    }

    public function decreaseQuantity($id)
    {
        $index = collect($this->cart)->search(function ($cartItem) use ($id) {
            return $cartItem['id'] === $id;
        });

        if ($index !== false && $this->cart[$index]['quantity'] > 1) {
            $this->cart[$index]['quantity']--;
            $this->calculateGrandTotal();
        }
    }

    public function calculateGrandTotal()
    {
        $this->grandTotal = collect($this->cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function submitForm()
    {
        if (empty($this->cart)) {
            session()->flash('error', 'Keranjang belanja tidak boleh kosong.');
            return;
        }

        $message = "Pesanan Baru:\n" .
            "- Tanggal Pemesanan: $this->date\n" .
            "- Nama: $this->name\n" .
            "- Alamat: $this->address\n" .
            "- Lokasi Pernikahan: $this->weddingLocation\n" .
            "- Catatan: $this->note";

        $message .= "\nKeranjang:\n";
        foreach ($this->cart as $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $message .= "- " . $item['name'] . " (" . $item['quantity'] . " x " . number_format($item['price']) . " = " . number_format($itemTotal) . ")\n";
        }

        $message .= "\nTotal Harga: " . number_format($this->grandTotal, 0, ',', '.');
        $encodedMessage = urlencode($message);

        $phoneNumber = '6289509464569';

        $whatsappURL = "https://wa.me/$phoneNumber?text=$encodedMessage";

        return redirect()->to($whatsappURL);
    }

    public function render()
    {
        return view('livewire.booking-page', [
            'decorations' => $this->decorations,
            'additionalItems' => $this->additionalItems,
            'cart' => $this->cart,
            'grandTotal' => $this->grandTotal,
            'disableDates' => $this->disableDates,
        ]);
    }
}
