<i-multiselect
    :form="form"
    :form_data="form_data"
    name="Inty"
    title="نوع صورتحساب"
    :options="{{json_encode($intyList)}}"
></i-multiselect>

<i-multiselect
    :form="form"
    :form_data="form_data"
    name="pattern"
    title="الگو"
    :options="{{json_encode($patternList)}}"
></i-multiselect>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="subject"
    title="موضوع"
    :options="{{json_encode($subjectList)}}"
></i-multiselect>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="client"
    title="خریدار"
    :options="{{json_encode($clientList)}}"
></i-multiselect>


<i-multiselect
    :form="form"
    :form_data="form_data"
    name="settlement_method"
    title="روش تسویه"
    :options="{{json_encode($settlementMethodList)}}"
></i-multiselect>



{{--<i-text--}}
{{--    type="text"--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="Tins"--}}
{{--    title="شماره اقتصادی فروشنده"--}}
{{--></i-text>--}}


{{--<i-multiselect--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="Tob"--}}
{{--    title="نوع شخص خریدار"--}}
{{--    :options="{{json_encode($tobList)}}"--}}
{{--></i-multiselect>--}}


<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="Irtaxid"
    title="شناسه صورتحساب مرجع"
></i-text>


<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="Sstid"
    title="شناسه كالا/خدمت"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="Sstt"
    title="شرح كالا/خدمت"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="Am"
    title="تعداد/مقدار"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="Mu"
    title="واحد اندازه گیری"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="Fee"
    title="مبلغ واحد"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="Dis"
    title=" مبلغ تخفیف"
></i-text>


<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="Vra"
    title="نرخ مالیات بر ارزش افزوده"
></i-text>

<i-text
    type="text"
    :form="form"
    :form_data="form_data"
    name="Vra"
    title="نرخ مالیات بر ارزش افزوده"
></i-text>


{{--<i-date--}}
{{--    :form="form"--}}
{{--    :form_data="form_data"--}}
{{--    name="Indati2m"--}}
{{--    title="تاریخ و زمان ایجاد صورتحساب"--}}
{{--></i-date>--}}


<i-date
    :form="form"
    :form_data="form_data"
    name="Indatim"
    title="تاریخ و زمان صدور صورتحساب"
></i-date>





