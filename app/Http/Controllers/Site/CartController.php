<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(Request $request)
    {
        $count          = Cart::content();
        $shipping_types = config('portal.shipping_types');
        return view(getSiteBladePath('modules.cart.index'), compact('contents', 'title', 'shipping_types'));
    }

    public function add(Request $request)
    {
        $product = Product::isActive()->findOrfail($request->product_id);

        Cart::add([
            'id'      => $product->id,
            'name'    => $product->title,
            'qty'     => 1,
            'price'   => $product->price,
            'options' => [
                'image'       => $product->image,
                'product_id'  => $product->id,
                'title'       => $product->title,
                'code'        => $product->code,
                'price'       => $product->price,
                'description' => $product->description,
                'detail'      => $product->detail,
                'link'        => $product->url,
            ],
        ])->associate('Product');
        return Cart::content();
    }

    public function update(Request $request)
    {
        return Cart::update($request->row_id, $request->count);
    }

    public function total()
    {
        return Cart::total();
    }

    public function destroy()
    {
        return Cart::destroy();
    }

    public function remove(Request $request)
    {
        return Cart::remove($request->row_id);
    }

    public function count(Request $request)
    {
        return Cart::count();
    }

    public function pay(Request $request)
    {
        $request->validate([
            'shipping_type' => 'required|in:1,2',
        ]);

        $shipping_type = $this->shippingType($request->shipping_type);
        $payable_price = Cart::subtotal('0', '', '') + $shipping_type['price'];

        // if ($payable_price <= 0) {
        //     return response(['redirect' => '/']);
        // }

        $purchase = auth()->guard('web')->user()->purchases()->create([
            'title'       => 'پرداخت سبد خرید',
            'description' => $shipping_type['name'],
            'price'       => $payable_price, // Rial
        ]);

        foreach (Cart::content() as $product) {
            $purchase->details()->create([
                'product_id'  => $product->options->product_id,
                'title'       => $product->options->title,
                'code'        => $product->options->code,
                'price'       => $product->options->price,
                'description' => $product->options->description,
                'detail'      => $product->options->detail,
                'image'       => $product->options->image,
                'count'       => $product->qty,
            ]);
        }

        // go to bank
        return response([
            'redirect' => '/' . app()->getLocale() . '/bank/request?id=' . $purchase->id,
        ]);
    }

    public function content()
    {
        return Cart::content();
    }

    private function shippingType($id)
    {
        return collect(config('portal.shipping_types'))
            ->where('id', $id)
            ->first();
    }
}
