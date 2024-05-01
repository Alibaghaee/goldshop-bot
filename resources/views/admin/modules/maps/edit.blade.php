@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')



    <form-component is_clone="{{isset($isClone) ? 'set' : 'notset'}}" action="{{ $model->update_uri }}" method="put"
                    page_title="{{ get_page_title() }}">
        <template slot="controls" slot-scope="{ form, form_data }">

            {!! csrf_field() !!}
            @if(isset($cloneAddress))
                @include($cloneAddress)
            @else
                @include($edit_form ? $model->form_edit_path : $model->form_create_path)
            @endif

        </template>

{{--          <template slot="left" slot-scope="{ form, form_data }">--}}

{{--            <iframe width="100%" height="500" class="mb-6 rounded" src="{{ $model->map_uri }}"></iframe>--}}
{{--            <iframe width="100%" height="500" class="mb-6 rounded" src="{{ $model->neshan_map_uri }}"></iframe>--}}

{{--          </template>--}}
    </form-component>
@endsection
