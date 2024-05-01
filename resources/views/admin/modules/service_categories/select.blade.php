@extends('admin.layouts.dashboard')

@section('title', get_page_title('Select Services'))

@section('middle')
    
    <div class="w-full flex flex-col">
      <div class="rhc-title flex">
          <svg class="w-6 h-6 fill-current mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 384"><path d="M341.333 0H42.667C19.198 0 0 19.198 0 42.667v298.666C0 364.802 19.198 384 42.667 384h298.666C364.802 384 384 364.802 384 341.333V42.667C384 19.198 364.802 0 341.333 0zm-192 298.667L42.667 192l29.864-29.864 76.802 76.802L311.469 76.802l29.864 29.865-192 192z"/></svg>
          @lang('Select Services For') : {{ $category->title }}
      </div>
      <service-select-group-checkbox 
      endpoint="{{ $endpoint }}"
      :services="{{ json_encode($services) }}"
      :active-items="{{ json_encode($active_items) }}"
      >
      </service-select-group-checkbox>
    </div>

@endsection