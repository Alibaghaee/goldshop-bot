@extends('site.layout.master')

@section('content')

    <div class="w-full h-full text-right  bg-slate-400">

        <div class="mx-auto  ">

            <div class="container   rounded p-5">


                <div class="mx-auto my-10  py-5 border rounded shadow flex flex-col bg-slate-200">

                    <div class="p-3  underline decoration-slate-600 ">اطالاعات پرداخت صورت حساب</div>
                    <form action="{{route('site.invoice_payment.store')}}" method="post"
                          class="flex flex-col">
                        @csrf
                        <input type="hidden" class="p-2 rounded" name="invoice_id" value="{{$invoice->id}}">
                        <div class="grid  grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 ">
                            <div class=" flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شماره سوییچ پرداخت</div>
                                <input type="text" class="p-2 rounded" name="Iinn" placeholder="شماره سوییچ پرداخت">
                            </div>
                            <div class=" flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شماره پذیرنده
                                    فروشگاهی</div>
                                <input type="text" class="p-2 rounded" name="Acn" placeholder="شماره پذیرنده
فروشگاهی">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1"> شماره پایانه</div>
                                <input type="text" class="p-2 rounded" name="Trmn" placeholder=" شماره پایانه">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شماره پیگیری</div>
                                <input type="text" class="p-2 rounded" name="Trn" placeholder="شماره پیگیری">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شماره كارت پرداخت
                                    كننده صورتحساب</div>
                                <input type="text" class="p-2 rounded" name="Pcn" placeholder="شماره كارت پرداخت
كننده صورتحساب">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شماره/شناسه ملی/كد
                                    فراگیر اتباع غیر ایرانی
                                    پرداخت كننده
                                    صورتحساب</div>
                                <input type="text" class="p-2 rounded" name="Pid" placeholder="شماره/شناسه ملی/كد
فراگیر اتباع غیر ایرانی
پرداخت كننده
صورتحساب">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">تاریخ و زمان پرداخت
                                    صورتحساب</div>
                                <input type="date" class="p-2 rounded" name="Pdt" placeholder="تاریخ و زمان پرداخت
صورتحساب">
                            </div>

                        </div>

                        <br>
                        <button type="submit"
                                class="mx-auto bg-slate-700 hover:bg-slate-800 rounded p-4 text-white w-full md:w-fit lg:w-fit  inline-block ">
                            ثبت
                        </button>
                    </form>

                </div>
            </div>


        </div>

    </div>
@endsection
