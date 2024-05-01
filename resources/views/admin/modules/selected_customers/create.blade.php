@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')
<form-component action="{{ $model->store_uri }}" method="post" page_title="{{ get_page_title() }}">

  <template slot="controls" slot-scope="{ form, form_data }">

    @include('admin.modules.selected_customers.form_create_right')

  </template>
  
  <template slot="left" slot-scope="{ form, form_data }">

    @include('admin.modules.selected_customers.form_create_left')

  </template>
  
</form-component>
@endsection
