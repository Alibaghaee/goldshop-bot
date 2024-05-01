@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')
<form-component action="{{ $model->update_uri }}" method="put" page_title="{{ get_page_title() }}">
    <template slot="controls" slot-scope="{ form, form_data }">
  
      {!! csrf_field() !!}
      
      @include($edit_form ? $model->form_edit_path : $model->form_create_path)
  
    </template>

    <template slot="left" slot-scope="{ form, form_data }">
        {{-- <div v-text="form_data"></div> --}}
    </template>
</form-component>
@endsection
