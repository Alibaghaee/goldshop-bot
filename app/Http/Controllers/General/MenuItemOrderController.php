<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\Menu;
use Illuminate\Http\Request;

class MenuItemOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Menu $menu)
    {
        // need refactor
        $items     = $menu->items()->with('children.children')->where('parent_item_id', null)->orderBy('order')->orderBy('parent_item_id')->select('title', 'id')->get();
        $endpoint  = route('menus.order.store', ['menu' => $menu->id]);
        $max_level = $menu->depth;
        return view('admin.globals.sort', compact('items', 'endpoint', 'max_level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Menu $menu, Request $request)
    {
        $request->validate([
            'items_data.*.id' => 'exists:menu_items,id',
        ]);

        // need refactor
        foreach ($request->items_data as $key => $item) {
            $menu->items()->findOrFail($item['id'])->update([
                'order' => ++$key,
                'parent_item_id' => null,
            ]);
            if (count($item['children'])) {
                foreach ($item['children'] as $child_key => $child_item) {
                    $menu->items()->findOrFail($child_item['id'])->update([
                        'order' => ++$child_key,
                        'parent_item_id' => $item['id'],
                    ]);

                    if (count($child_item['children'])) {

                        foreach ($child_item['children'] as $sub_child_key => $sub_child_item) {

                            $menu->items()->findOrFail($sub_child_item['id'])->update([
                                'order' => ++$sub_child_key,
                                'parent_item_id' => $child_item['id'],
                            ]);
                        }
                    }
                }
            }
        }

        success_flash();
        return response(['redirect' => $menu->items_uri]);
    }
}
