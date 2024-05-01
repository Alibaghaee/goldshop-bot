@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')
<form-component action="{{ $action }}" method="post" page_title="{{ get_page_title() }}">
  <template slot="controls" slot-scope="{ form, form_data }">

    @include($model->form_copy_path)

  </template>
</form-component>
@endsection
