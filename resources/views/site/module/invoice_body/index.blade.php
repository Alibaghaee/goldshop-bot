@extends('site.layout.master')

@section('content')

    <div class="w-full h-full text-right  bg-slate-400">

        <div class="mx-auto  ">

            <div class="container   rounded p-5">
                <div class="mx-auto py-5 border rounded shadow flex bg-slate-200 flex flex-col">
                    @foreach($invoiceBodies as $invoiceBody )

                        <div class="flex flex-row">
                            <div>شناسه صورت حساب</div>
                            <div>{{$invoiceBody->invoice_id}}</div>

                        </div>

                    @endforeach

                </div>
            </div>


        </div>

    </div>
@endsection
