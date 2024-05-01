@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')
<form-component action="{{ $model->update_uri }}" method="put" page_title="{{ get_page_title() }}">
  <template slot="controls" slot-scope="{ form, form_data }">
    
    @include($form_path)

  </template>
</form-component>
@endsection

