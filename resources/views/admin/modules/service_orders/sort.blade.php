@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')
    {{-- <sortable-items v-if="{{ $items->count() }}" :items="{{ $items }}" endpoint_uri="{{ $endpoint }}"></sortable-items> --}}

    <sortable-tree-list v-if="{{ $items->count() }}" :items="{{ $items }}" endpoint_uri="{{ $endpoint }}" max_level="{{ isset($max_level) ? $max_level : 1 }}">
        <template slot="item" slot-scope="{item, scope}">
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center">
                    <img :src="item.icon" class="w-12 h-12">
                    <span class="ml-3" v-html="item.title"></span>
                </div>
                <div class="flex items-center">
                    <span class="mx-3 text-sm text-grey" v-if="item.options_count">@{{ item.options_count }} @lang('options')</span>
                    <a :href="item.edit_uri" target="_blank" class="rahco-center h-8 w-8 rounded-full p-2 flex no-underline bg-grey-lighter hover:bg-grey-light text-blue-dark hover:text-blue" title="edit">
                        <svg class="w-4 h-4 flex fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 192"><path d="M192.5 48h-.5.5zm112-48H256s26 17 31.6 48h16.9c17.6 0 31.5 13.9 31.5 31.5v32c0 17.6-13.9 32.5-31.5 32.5h-112c-17.6 0-32.5-14.9-32.5-32.5V80h-48v31.5c0 11.5 2.5 22.5 6.9 32.5 12.6 28.2 40.9 48 73.6 48h112c44.2 0 79.5-36.3 79.5-80.5v-32C384 35.3 348.7 0 304.5 0z"/><path d="M265.6 48c-12.1-28.3-40.1-48-73.1-48h-112C36.3 0 0 35.3 0 79.5v32C0 155.7 36.3 192 80.5 192H128s-25.8-17-32.1-48H80.5C62.9 144 48 129.1 48 111.5v-32C48 61.9 62.9 48 80.5 48h112c17.6 0 31.5 13.9 31.5 31.5V112h48V79.5c0-11.2-2.3-21.9-6.4-31.5z"/></svg>
                    </a>
                </div>
            </div>
        </template>
    </sortable-tree-list>

    <div v-else class="w-full text-pink text-xl flex justify-center">@lang('No Item')</div>

@endsection