<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartBar extends Component
{

    public $cartTotal = 0;
    public $x = 0;
    public $total = 0;
    protected $listeners = ['productAdded' => '$refresh'];

    public function deleteProduct($id)
    {

        CartItem::find($id)->delete();
        session()->flash('message', 'product successfully deleted.');
        $this->emit('productDeleted');


    }

    public function render()
    {

        return view('livewire.cart-bar' ,
        [
            'products' => CartItem::where('user_id' , Auth::id())->get(),

        ]);
    }

}
