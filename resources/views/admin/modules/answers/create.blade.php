@extends('admin.layouts.dashboard')

@section('title', get_page_title())

@section('middle')
<form-component action="{{ $model->store_uri }}" method="post" page_title="{{ get_page_title() }}">
  <template slot="controls" slot-scope="{ form, form_data }">

    @include($model->form_create_path)

  </template>

  <template slot="left" slot-scope="{ form, form_data }">

    <div>

        @foreach($ticket->items as $item)
            <div class="bg-grey-light rounded p-4 mb-8">
                <div class="flex flex-wrap mb-4">
                    <div class="w-full md:w-1/2">
                        <span class="font-bold">پاسخ دهنده:</span> {{ optional($item->creator)->fullname }}
                    </div>
                    <div class="w-full md:w-1/2">
                        <span class="font-bold">تاریخ ثبت:</span>
                        <span class="ltr inline-block">{{ $item->created_at_fa }}</span>
                    </div>
                </div>
                <div>
                    <span class="font-bold">متن پاسخ: <br></span> {!! $item->body !!}
                </div>
                @if($item->file)
                    <div class="ltr">
                        <a href="{{ $item->file }}">فایل پیوست</a>
                    </div>
                @endif
            </div>
        @endforeach


        <div class="bg-grey-light rounded p-4">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2">
                    <span class="font-bold">تاریخ ثبت:</span>
                    <span class="ltr inline-block">{{ $ticket->created_at_fa }}</span>
                </div>
                <div class="w-full md:w-1/2">
                    <span class="font-bold">تاریخ آخرین بروزرسانی:</span>
                    <span class="ltr inline-block">{{ $ticket->updated_at_fa }}</span>
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2">
                    <span class="font-bold">ثبت کننده:</span> {{ optional($ticket->creator)->fullname }}
                </div>
                <div class="w-full md:w-1/2">
                    <span class="font-bold">دریافت کننده:</span> {{ optional($ticket->receiver)->fullname }}
                </div>
            </div>
            <div class="mb-4">
                <span class="font-bold">وضعیت:</span> {{ $ticket->status_title }}
            </div>
            <div class="mb-4">
                <span class="font-bold">عنوان:</span> {{ $ticket->title }}
            </div>
            <div>
                <span class="font-bold">متن تیکت: <br></span> {!! $ticket->body !!}
            </div>
            @if($ticket->file)
                <div class="ltr">
                    <a href="{{ $ticket->file }}">فایل پیوست</a>
                </div>
            @endif
        </div>
    </div>

  </template>


</form-component>
@endsection
