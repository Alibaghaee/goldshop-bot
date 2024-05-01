@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')

    {{-- <sortable-items v-if="{{ $items->count() }}" :items="{{ $items }}" endpoint_uri="{{ $endpoint }}"></sortable-items> --}}

    <sortable-tree-list v-if="{{ $items->count() }}" :items="{{ $items }}" endpoint_uri="{{ $endpoint }}" max_level="{{ isset($max_level) ? $max_level : 1 }}">
        <template slot="item" slot-scope="{item, scope}">
            <span>@{{ item.title }}</span>
        </template>
    </sortable-tree-list>

    <div v-else class="w-full text-pink text-xl flex justify-center">موردی برای مرتب سازی وجود ندارد.</div>

@endsection