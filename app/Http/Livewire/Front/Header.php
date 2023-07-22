<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Header extends Component
{

    protected $listeners = ['productAdded' => '$refresh', 'productDeleted' => '$refresh'];


    public function render()
    {
        return view('livewire.front.header' , [
            'count' => \App\Models\CartItem::where("user_id",Auth::id())->count(),
        ] );
    }
}
