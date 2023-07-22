<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\QuentityProduct;
use Illuminate\Support\Facades\Auth;

class ShopPage extends Component
{
    use WithPagination;
    public $products;
    public $product_id;
    public $prod  ;
    public $size ='لا يوجد';
    public $count = 0;
    public $quentity = 1;

    public function mount($products)
    {
        $this->products = $products;
    }
    public function save()
    {
        $cart_details = new CartItem();
        $cart_details->product_id = $this->product_id;
        $cart_details->quantity = 1;
        $cart_details->mac =  request()->ip();
        $cart_details->product_price = $this->prod->price;
        $cart_details->size = $this->size;
        $cart_details->user_id = Auth::id();

        $cart_details->save();
     // dd($this->quentity .'??'. $this->product_id);
      //  $this->count = 0;
      session()->flash('message', __('front.added_successfully'));
      $this->emit('productAdded');
      $this->reset( 'size');

      $this->dispatchBrowserEvent('closemodal');




    }


    public function openModel($id)
    {

       $this->count = 1;
       $this->product_id = $id;
       $this->prod = Product::find($id);


    }




    public function render()
    {

        return view('livewire.shop-page'
        ,[
            'prod' => Product::find($this->product_id),


        ]
    );
    }
}
