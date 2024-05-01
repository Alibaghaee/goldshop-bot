@extends(getSiteBladePath('layouts.master'))

@section('title', $title ?? '')

@section('content')
    
    <div class="max-w-md mx-auto h-screen flex justify-center items-center p-4 leading-loose">
        <profile-edit 
        action="{{ $endpoint }}" 
        method="put"
        page_title="{{ $title }}"
        >
            <template slot="controls" slot-scope="{ form, form_data }">

                <div class="w-full px-2 text-grey-darker">
                    <div class="w-full flex justify-between p-3 px-2 rounded bg-grey-lighter mb-3">
                        <div class="ml-2">کد ملی داوطلب: </div>
                        <div class="font-bold">{{ $profile->national_code }}</div>
                    </div>

                    @foreach(auth()->user()->fields as $field)
                        @if($field->name == 'description')  
                            {{-- empty for description --}}
                        @else
                        <div class="w-full flex justify-between p-3 px-2 rounded bg-grey-lighter mb-3">
                            <div class="ml-2">{{ $field->label }}</div>

                            <div class="font-bold">
                                @if($field->name == 'gender')
                                    {{ $profile->gender_title }}
                                @elseif($field->name == 'field_of_study')
                                    {{ $profile->field_of_study_title }}
                                @elseif($field->name == 'grade')
                                    {{ $profile->grade_title }}
                                @elseif($field->name == 'province_id')
                                    {{ $profile->province_title }}
                                @elseif($field->name == 'city_id')
                                    {{ $profile->city_title }}
                                @else
                                    {{ $profile->{$field->name} }}
                                @endif  
                            </div>

                        </div>
                        @endif  
                    @endforeach

                </div>

                <div class="w-full md:w-1/2 px-2">
                    <i-text 
                        type="password" 
                        :form="form" 
                        :form_data="form_data" 
                        name="password" 
                        title="رمز عبور *"
                    ></i-text>
                </div>

                <div class="w-full md:w-1/2 px-2">
                    <i-text 
                        type="password" 
                        :form="form" 
                        :form_data="form_data" 
                        name="password_confirmation" 
                        title="تکرار رمز عبور *"
                    ></i-text>
                </div>

                {{-- <div class="w-full md:w-1/2 px-2">
                    <i-text 
                        type="text" 
                        :form="form" 
                        :form_data="form_data" 
                        name="address" 
                        title="آدرس دقیق پستی جهت ارسال محصول *"
                        value="{{ $profile['address'] }}"
                    ></i-text>
                </div>

                <div class="w-full md:w-1/2 px-2">
                    <i-text 
                        type="text" 
                        :form="form" 
                        :form_data="form_data" 
                        name="postal_code" 
                        title="کد پستی جهت ارسال مرسوله *"
                        value="{{ $profile['postal_code'] }}"
                    ></i-text>
                </div>

                
                <div class="w-full md:w-1/2 px-2">
                    <i-multiselect 
                        :form="form" 
                        :form_data="form_data" 
                        name="province_id" 
                        title="استان"
                        :options="{{ $provinces }}" 
                        :value="{{ get_selected_option_from_array($provinces->toArray(), $profile['province_id']) }}" 
                    ></i-multiselect>
                </div>

                
                <div class="w-full md:w-1/2 px-2">
                    <i-multiselect 
                        :form="form" 
                        :form_data="form_data" 
                        name="city_id" 
                        title="شهر"
                        :options="{{ $cities }}" 
                        :value="{{ get_selected_option_from_array($cities->toArray(), $profile['city_id']) }}" 
                    ></i-multiselect>
                </div> --}}

            </template>
        </profile-edit>
    </div>
    
@endsection
