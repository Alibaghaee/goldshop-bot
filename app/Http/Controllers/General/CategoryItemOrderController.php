<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\Category;
use Illuminate\Http\Request;

class CategoryItemOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $items    = $category->items()->select('title', 'id')->get();
        $endpoint = route('categories.order.store', ['category' => $category->id]);
        return view('admin.globals.sort', compact('items', 'endpoint'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category, Request $request)
    {
        $request->validate([
            'items_data.*.id' => 'exists:category_items,id',
        ]);

        foreach ($request->items_data as $key => $item) {
            $category->items()->findOrFail($item['id'])->update(['order' => ++$key]);
        }

        success_flash();
        return response(['redirect' => $category->items_uri]);
    }
}
