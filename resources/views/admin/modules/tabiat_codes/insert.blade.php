@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')
<form-component action="{{ $model->insert_uri }}" method="post" page_title="{{ get_page_title() }}">
  <template slot="controls" slot-scope="{ form, form_data }">

    <i-multiselect 
        :form="form" 
        :form_data="form_data" 
        name="tabiat_product_id" 
        title="محصول"
        :options="{{ get_option_from_array($tabiat_products) }}" 
    ></i-multiselect>

    <i-textarea 
        type="text" 
        :form="form" 
        :form_data="form_data" 
        name="codes" 
        title="کدها"
    ></i-textarea>
    <div>هر خط یک کد</div>

  </template>
</form-component>
@endsection
