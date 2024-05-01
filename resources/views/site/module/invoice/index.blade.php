@extends('site.layout.master')

@section('content')

    <div class="w-full h-full text-right  bg-slate-400">

        <div class="mx-auto  ">

            <div class="container   rounded p-5">
                <div class="mx-auto py-5 border rounded shadow flex bg-slate-200 flex flex-col">

                    @foreach($invoices as $invoice )

                        <div
                            class="flex flex-row justify-between rounded bg-white p-1 mb-3 mx-2 hover:shadow cursor-pointer text-gray-600">
                            <div class="flex flex-row border p-1 ml-3">
                                <div>شناسه صورت حساب</div>
                                <div>:</div>
                                <div>{{$invoice->id}}</div>
                            </div>

                            <div class="flex flex-row border p-1 ml-3">
                                <div>تاریخ</div>
                                <div>:</div>
                                <div>{{$invoice->created_at}}</div>
                            </div>

                            <div class="flex flex-row  p-1 ml-3">
                                <a
                                    href="{{route('site.moadian.send',$invoice->id)}}"
                                    class="inline-block cursor-pointer bg-blue-600 hover:bg-blue-700 text-gray-50 rounded p-1">ارسال</a>

                            </div>
                        </div>

                    @endforeach

                </div>
            </div>


        </div>

    </div>
@endsection
