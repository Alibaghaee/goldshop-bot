<div class="flex flex-wrap">
    <div class="w-full md:w-1/2 px-3">
        <div>
            <span class="font-bold">@lang('ID'):</span> {{ $model->id }}
        </div>

        <div>
            <span class="font-bold">@lang('Name'):</span> {{ $model->log_name }}
        </div>

        <div>
            <span class="font-bold">@lang('Description'):</span> {{ $model->description }}
        </div>

        <div>
            <span class="font-bold">@lang('Created at'):</span> {{ $model->created_at }}
        </div>

        <div>
            <span class="font-bold">@lang('Subject Type'):</span> {{ class_basename($model->subject_type) }}
        </div>

        <div>
            <span class="font-bold">@lang('Subject ID'):</span> {{ $model->subject_id }}
        </div>

        <div>
            <span class="font-bold">@lang('Causer Type'):</span> {{ class_basename($model->causer_type) }}
        </div>

        <div>
            <span class="font-bold">@lang('Causer ID'):</span> {{ $model->causer_id }}
        </div>

        <div>
            <span class="font-bold">@lang('IP'):</span> {{ $model->ip }}
        </div>

        <div>
            <span class="font-bold">@lang('Hospital Name'):</span> {{ $model->hospital_title }}
        </div>

        <div>
            <span class="font-bold">@lang('Causer'):</span> 
            <pre>{{ json_encode($model->causer, JSON_PRETTY_PRINT) }}</pre>
        </div>

    </div>
    <div class="w-full md:w-1/2 px-3">
        <div>
            <div><span class="font-bold">@lang('Properties'):</span> </div>
            <pre>{{ json_encode($model->properties, JSON_PRETTY_PRINT) }}</pre>
        </div>
    </div>
</div>