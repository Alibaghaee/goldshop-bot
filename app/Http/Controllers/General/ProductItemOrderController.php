<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\Product;
use Illuminate\Http\Request;

class ProductItemOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        // need refactor
        $items     = $product->items()->with('children')->where('parent_item_id', null)->orderBy('order')->orderBy('parent_item_id')->select('title', 'id')->get();
        $endpoint  = route('products.order.store', ['product' => $product->id]);
        $max_level = $product->depth;
        return view('admin.globals.sort', compact('items', 'endpoint', 'max_level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, Request $request)
    {
        $request->validate([
            'items_data.*.id' => 'exists:product_items,id',
        ]);

        // need refactor
        foreach ($request->items_data as $key => $item) {
            $product->items()->findOrFail($item['id'])->update([
                'order'          => ++$key,
                'parent_item_id' => null,
            ]);
            if (count($item['children'])) {
                foreach ($item['children'] as $child_key => $child_item) {
                    $product->items()->findOrFail($child_item['id'])->update([
                        'order'          => ++$child_key,
                        'parent_item_id' => $item['id'],
                    ]);
                }
            }
        }

        success_flash();
        return response(['redirect' => $product->items_uri]);
    }
}
