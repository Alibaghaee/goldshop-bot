<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\Content;
use App\Models\General\Product;
use App\Models\General\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($slug, Request $request)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $products = Product::limitedByField()->whereHas('tags', function ($query) use ($tag) {
            $query->where('tags.id', $tag->id);
        })->isActive()->paginate(600);

        return view(getSiteBladePath('modules.product.search-by-tag'), compact('products', 'tag'));
    }

    public function searchContents($slug, Request $request)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $contents = Content::whereHas('tags', function ($query) use ($tag) {
            $query->where('tags.id', $tag->id);
        })->isActive()->paginate(16);

        return view(getSiteBladePath('modules.content.search-by-tag'), compact('contents', 'tag'));
    }


}
