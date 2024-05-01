@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')
<form-component action="{{ $model->store_uri }}" method="post" page_title="{{ get_page_title() }}">
  <template slot="controls" slot-scope="{ form, form_data }">

    @include($model->form_create_path)


  </template>

</form-component>


@endsection




