@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')
    <form-component action="{{ $action }}" method="post" page_title="{{ get_page_title() }}">
        <template slot="controls" slot-scope="{ form, form_data }">
            <copy-hospital :hospitals="{{ $hospitals }}"
                           :form="form"
                           :form_data="form_data"
            > </copy-hospital>

            <i-checkbox
                :form="form"
                :form_data="form_data"
                name="languages"
                title="@lang('Langueges')"
            ></i-checkbox>

            <i-checkbox
                :form="form"
                :form_data="form_data"
                name="rooms"
                title="@lang('Rooms')"
            ></i-checkbox>

            <i-checkbox
                :form="form"
                :form_data="form_data"
                name="beds"
                title="@lang('Beds')"
            ></i-checkbox>

            <i-checkbox
                :form="form"
                :form_data="form_data"
                name="service-types"
                title="@lang('Service Types')"
            ></i-checkbox>

            <i-checkbox
                :form="form"
                :form_data="form_data"
                name="services"
                title="@lang('Services')"
            ></i-checkbox>

            <i-checkbox
                :form="form"
                :form_data="form_data"
                name="services-options"
                title="@lang('Services Options')"
            ></i-checkbox>

            <i-checkbox
                :form="form"
                :form_data="form_data"
                name="services-categories"
                title="@lang('Services Categories')"
            ></i-checkbox>
        </template>
    </form-component>

@endsection

