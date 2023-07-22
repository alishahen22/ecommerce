<?php

namespace App\Http\Controllers\Front;

use App\Models\Size;
use App\Models\Order;

use App\Models\Slider;
use App\Models\Contact;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\QuentityProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $products = Product::paginate(12);
        $categories = Category::all();
        $sliders = Slider::all();
        $products = Product::get();
        $category_id = null;
        if (request()->category) {
            $category_id = Category::where('title_en', request()->category)->first();
            if ($category_id) {
                $category_id = $category_id->id;
            }
            }
        // dd($category_id);

        $products = Product::query()->where(function ($q) use ($category_id) {
            if (\request()->category&&$category_id != null) {
                $q->whereCategoryId($category_id);
            }
        })->when(\request()->sort, function ($q, $sort) {
            if ($sort == 'low_high') {
                $q->orderBy('price');
            } elseif ($sort == 'high_low') {
                $q->orderByDesc('price');
            } elseif ($sort == 'newness') {
                $q->orderByDesc('id');
            }
        })->when(request()->price,function($q)
        {
            if (request()->price == '0-50') {
                $q->whereBetween('price', [0, 50]);
            }elseif (request()->price == '50-100') {
                $q->whereBetween('price', [50, 100]);
            }elseif (request()->price == '100-150') {
                $q->whereBetween('price', [100, 150]);
            }elseif (request()->price == '150-200') {
                $q->whereBetween('price', [150, 200]);
            }elseif (request()->price == '200') {
                $q->where('price', '>', 200);
            }
        })
       ->where('quantity' , '>' , 0)
       ->get();
             //    dd($products);

        return view('front.home.index' , compact('products' , 'categories' , 'sliders'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
        $carts = CartItem::where('user_id',Auth::id())->get();
        return  view('front.cart' , compact('carts'));
    }


    public function addQuentityToCart(Request $request)
    {
        $request->validate([
            'quantity' => 'required|array',
        ]);
        foreach ($request->quantity as $id => $quantity) {
            $cart = CartItem::find($id);
            $cart->quantity = $quantity;
            $cart->save();
        }

         return redirect()->back();
    }

    public function deleteFromCart( $id)
    {

         CartItem::find($id)->delete();
         return redirect()->back()->with('success', 'Product deleted successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCheckout(Request $request)
    {
        if (Auth::check()) {
            // $request->validate([
            //     'name' => 'required',
            //     'email' => 'required',
            //     'full_address' => 'required',
            //     'phone' => 'required|numeric',
            // ]);

            $carts = CartItem::where('user_id',Auth::id())->with('product')->get();
            if ($carts->count() == 0) {
                return redirect()->back()->with('error', 'Your cart is empty');
            }

            $order = new Order();
            $order->full_name = $request->name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->full_address = implode(',' , $request->full_address);
            $order->total = $request->total;
             $order->sub_total =   $request->total;
            $order->user_id = Auth::id();
            $order->save();
       //     save order items
            foreach ($carts as $cart) {
                $size_id = \App\Models\Size::where('size_en', $cart->size)->first();
                if ($size_id) {
                    $size_id = $size_id->id;
                }
                $productCount = QuentityProduct::where('product_id', $cart->product_id)->where('size_id',$size_id)->first();

                if ($productCount->quentity < $cart->quantity) {
                    return redirect()->back()->with('error', 'Sorry, the quantity of the product is not available');
                }
                $order->OrderItem()->create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'product_name' => session()->get('lang') == 'ar' ? $cart->product->title_ar : $cart->product->title_en,
                    'quantity' => $cart->quantity,
                    'chosen_size' => $cart->size,
                    'product_price' => $cart->product_price,
                    'sub_total' => $cart->product_price * $cart->quantity,
                ]);
                //delete cart items
                CartItem::find($cart->id)->delete();
                //update product quentity

                $productCount->quentity = $productCount->quentity - $cart->quantity;
                $productCount->save();
                //update product quentity in product table
                $product = Product::find($cart->product_id);
                $product->quantity = $product->quantity - $cart->quantity;
                $product->save();


            }



            return redirect()->back()->with('success', 'Your order has been successfully');

        }
        return redirect()->back()->with('success', 'You must login first');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function shop()
    {
       return view('front.shop');
    }

    public function showCategory(Request $request )
    {
        $categories = Category::all();
     //   $category =$id != 'all'?  Category::select('id')->findOrFail($id):'';
        $category = Category::where('title_en', $request->category)->first();
        $id = $category ? $category->id : 'all';

        $products = Product::query()->where(function ($q) use ($id) {
            if ($id != 'all') {
                $q->whereCategoryId($id);
            }
        })->when(\request()->sort, function ($q, $sort) {
            if ($sort == 'low_high') {
                $q->orderBy('price');
            } elseif ($sort == 'high_low') {
                $q->orderByDesc('price');
            } elseif ($sort == 'newness') {
                $q->orderByDesc('id');
            }
        })->when(request()->price,function($q)
        {
            if (request()->price == '0-50') {
                $q->whereBetween('price', [0, 50]);
            }elseif (request()->price == '50-100') {
                $q->whereBetween('price', [50, 100]);
            }elseif (request()->price == '100-150') {
                $q->whereBetween('price', [100, 150]);
            }elseif (request()->price == '150-200') {
                $q->whereBetween('price', [150, 200]);
            }elseif (request()->price == '200') {
                $q->where('price', '>', 200);
            }
        })->where('quantity' , '>' , 0)
           ->get();
       return view('front.shop' , compact('products' , 'categories'));
    }

    public function addToCart(Request $request)
    {
        return $request->all();
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->back()->with('success', __('front.msqSent'));
    }


    public function userLogout()
    {
        auth()->logout();
        return redirect()->to('/');
    }

}

