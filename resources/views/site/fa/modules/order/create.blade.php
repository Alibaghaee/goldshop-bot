@extends(getSiteBladePath('layouts.master'))

@section('title', __('messages.order') ?? '')

@section('content')
    
    <div class="bg-white text-grey-darker">
        <div class="container py-8 leading-loose text-black">

            <div class="text-grey-darker text-2xl mt-6 mb-10 font-bold">{{ __('messages.order') }}:</div>

            <site-form-component action="/fa/order" method="post">
              <template slot="controls" slot-scope="{ form, form_data }">

                
                <i-textarea 
                    :advance_editor="false"
                    :form="form" 
                    :form_data="form_data" 
                    name="request_info" 
                    title="مشخصات و نشانی متقاضی"
                ></i-textarea>

                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="product_type" 
                    title="نوع کالا"
                ></i-text>

                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="packing_type" 
                    title="نوع بسته بندی"
                ></i-text>

                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="weight" 
                    title="وزن تقریبی کالا"
                ></i-text>

                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="volume" 
                    title="حجم تقریبی کالا"
                ></i-text>

                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="origin" 
                    title="مبدا"
                ></i-text>

                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="destination" 
                    title="مقصد"
                ></i-text>

                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="preparation_time" 
                    title="زمان تقریبی آمادگی کالا برای بارگیری"
                ></i-text>

                <i-multiselect 
                    :form="form" 
                    :form_data="form_data" 
                    name="transportation_type" 
                    title="نوع وسیله حمل"
                    :options="{{ get_option_from_array($transportation_type) }}" 
                ></i-multiselect>

                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="fullname" 
                    title="نام مسئول پیگیری"
                ></i-text>

                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="mobile" 
                    title="موبایل"
                ></i-text>

                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="captcha" 
                    title="کد امنیتی"
                ></i-text>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/4"></div>
                    <div class="md:w-2/3 flex h-10 flex-row-reverse items-center">
                        <img src="{{ captcha_src('flat') }}" alt="captcha" class="refresh-captcha-img rounded cursor-pointer" data-refresh-config="flat" id="captcha-img">
                        <i class="refresh-captcha-img fa fa-refresh fa-2x ml-4 text-grey-light cursor-pointer hover:text-blue"></i>
                    </div>
                </div>

              </template>
            </site-form-component>

        </div>
    </div>
    
@endsection
