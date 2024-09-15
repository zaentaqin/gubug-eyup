<?php

namespace App\Livewire;

use App\Models\Catalog;
use Livewire\Component;

class Homepage extends Component
{


    public $decorations;
    public $additionalItems;

    public function mount()
    {
        $this->decorations = Catalog::where('category', 'Decoration')->get();
        $this->additionalItems = Catalog::where('category', 'Additional Item')->get();
    }

    public function render()
    {
        $catalogs = Catalog::inRandomOrder()->limit(12)->get();
        return view('livewire.home-page', [
            'catalogs' => $catalogs
        ]);
    }
}
