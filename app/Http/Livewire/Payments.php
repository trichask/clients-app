<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Livewire\Component;

class Payments extends Component
{
    public $search = null;
    protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.payments', [
            'payments' => Payment::with('client')->when($this->search, function($query) {
                return $query->whereHas('client', function($query) {
                    $searchTerm = "%{$this->search}%";
                    return $query->where('name', 'like', $searchTerm)->orWhere('surname', 'like', $searchTerm);
                });
            })->orderBy('created_at')->get()
        ]);
    }
}
