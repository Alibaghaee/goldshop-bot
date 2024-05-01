@foreach($form->fields as $field)
    @if($field->type == 1)

        @if($field->name == 'postal_code')

            <div class="w-full md:w-1/2 px-2">
                <i-postal-code 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="postal_code" 
                    title="کد پستی جهت ارسال مرسوله *"
                ></i-postal-code>
            </div>

        @else

            <div class="w-full md:w-1/2 px-2">
                <i-text 
                    type="text" 
                    :form="form" 
                    :form_data="form_data" 
                    name="{{ $field->name }}" 
                    title="{{ $field->label }}"
                ></i-text>
            </div>

        @endif

    @elseif($field->type == 2)

        <div class="w-full md:w-1/2 px-2">
            <i-textarea 
                :advance_editor="true"
                :form="form" 
                :form_data="form_data" 
                name="{{ $field->name }}" 
                title="{{ $field->label }}"
            ></i-textarea>
        </div>  

    @elseif($field->type == 3)

        @if($field->name == 'province_id')

            <div class="w-full md:w-1/2 px-2">
                <i-province 
                    :form="form" 
                    :form_data="form_data" 
                ></i-province>         
            </div>

        @else

            <div class="w-full md:w-1/2 px-2">
                <i-multiselect 
                    :form="form" 
                    :form_data="form_data" 
                    name="{{ $field->name }}" 
                    title="{{ $field->label }}"
                    :options="{{ json_encode($field->getOptions()) }}" 
                ></i-multiselect>
            </div>
            
        @endif

    @elseif($field->type == 4)

        <div class="w-full md:w-1/2 px-2">
            <i-checkbox 
                :form="form" 
                :form_data="form_data" 
                name="{{ $field->name }}" 
                title="{{ $field->label }}"
            ></i-checkbox>
        </div>   

    @endif

@endforeach

<div class="w-full md:w-1/2 px-2" v-if="form_data.payment_type == 2">
    <i-text 
        type="text" 
        :form="form" 
        :form_data="form_data" 
        name="discount_code" 
        title="کد تخفیف"
    ></i-text>
</div>