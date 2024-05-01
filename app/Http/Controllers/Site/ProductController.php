<?php

namespace App\Http\Controllers\Site;

use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Models\General\Category;
use App\Models\General\Package;
use App\Models\General\Product;
use App\Models\General\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource according to requested type.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProductFilters $filters, Package $package)
    {
        $products = $package->products()->isActive()->limitedByField()->filter($filters)->get();

        $all_tags_title = Tag::whereHas('products', function ($query) use ($products) {
            $query->whereIn('products.id', $products->pluck('id'));
        })->pluck('title');

        $categories = Category::with([
            'items' => function ($query) use ($all_tags_title) {
                $query->whereIn('title', $all_tags_title);
            },
        ])
            ->where('module_id', 31)
            ->get();

        return view(getSiteBladePath('modules.product.index'), compact('products', 'categories'));
    }

    public function search(Request $request, ProductFilters $filters, Package $package)
    {
        $category_items_id = array_keys(array_filter($request->tags));

        if (count($category_items_id) == 0 && $request->title = '') {
            return $package->products()->isActive()->limitedByField()->paginate(12);
        }

        ;
        return $package->products()->isActive()->limitedByField()->filter($filters)->paginate(12);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = $package->products()->isActive()->getBySlug($slug);

        return view(getSiteBladePath('modules.product.show'), compact('product'));
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function search(Request $request, ProductFilters $filters)
    // {
    //     $products = Product::filter($filters)->paginate(16);

    //     return view(getSiteBladePath('modules.product.search'), compact('products'));
    // }

    public function categories(Request $request, Package $package)
    {
        return view(getSiteBladePath('modules.product.categories'), compact('package'));
    }
}
