@extends('site.layout.master')

@section('content')

    <div class="w-full h-full text-right  bg-slate-400">

        <div class="mx-auto  ">

            <div class="container   rounded p-5">
                <div class="mx-auto my-2 py-5 border rounded shadow flex flex-col bg-slate-200">

                    <div class="p-3  underline decoration-slate-600 ">سرآمد صورت حساب</div>
                    <form action="{{route('site.invoice_header.store')}}" method="post"
                          class="flex flex-col">
                        @csrf
                        <input type="hidden" class="p-2 rounded" name="invoice_id" value="{{$invoice->id}}">
                        <div class="grid  grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 ">
{{--                            <div class=" flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">شماره منحصر به فرد--}}
{{--                                    مالیاتی--}}
{{--                                </div>--}}
{{--                                <input type="text" class="p-2 rounded" name="TaxId" placeholder="شماره منحصر به فرد--}}
{{--مالیاتی">--}}
{{--                            </div>--}}
                            <div class=" flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">تاریخ و زمان ایجاد
                                    صورتحساب
                                </div>
                                {{--                                <div--}}
                                {{--                                    class="relative"--}}
                                {{--                                    id="timepicker-inline-24"--}}
                                {{--                                    data-te-input-wrapper-init>--}}
                                {{--                                    <input--}}
                                {{--                                        name="Indati2mTime"--}}
                                {{--                                        type="text"--}}
                                {{--                                        class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"--}}
                                {{--                                        id="form3" />--}}
                                {{--                                    <label--}}
                                {{--                                        for="form3"--}}
                                {{--                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"--}}
                                {{--                                    >انتخاب ساعت</label--}}
                                {{--                                    >--}}
                                {{--                                </div>--}}
                                <input type="date" class="p-2 rounded" name="Indati2m" placeholder="تاریخ و زمان ایجاد
صورتحساب">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">تاریخ و زمان صدور
                                    صورتحساب
                                </div>
                                <input type="date" class="p-2 rounded" name="Indatim" placeholder="تاریخ و زمان صدور
صورتحساب">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">نوع صورتحساب</div>

                                <select name="Inty">
                                    @foreach(\App\Models\InvoiceHeader::$intyList as $inty)
                                        <option value="{{$inty['id']}}">{{$inty['name']}}</option>
                                    @endforeach
                                </select>

                                {{--                                <input type="text" class="p-2 rounded" name="Inty" placeholder="نوع صورتحساب">--}}
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1"> نوع پرواز</div>

                                <select name="Ft">
                                    <option value="">-</option>

                                @foreach(\App\Models\InvoiceHeader::$ftList as $inty)
                                        <option value="{{$inty['id']}}">{{$inty['name']}}</option>
                                    @endforeach
                                </select>
                                {{--                                <input type="text" class="p-2 rounded" name="Ft" placeholder=" نوع پرواز">--}}
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1"> سریال صورتحساب</div>
                                <input type="text" class="p-2 rounded" name="Inno" placeholder=" سریال صورتحساب">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شماره منحصر به فرد
                                    مالیاتی صورتحساب
                                    مرجع
                                </div>
                                <input type="text" class="p-2 rounded" name="Irtaxid" placeholder="شماره منحصر به فرد
مالیاتی صورتحساب
مرجع">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شماره پروانه گمركی
                                    فروشنده
                                </div>
                                <input type="text" class="p-2 rounded" name="Scln" placeholder="شماره پروانه گمركی
فروشنده">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">روش تسویه</div>

                                <select name="Setm">
                                    @foreach(\App\Models\InvoiceHeader::$setmList as $inty)
                                        <option value="{{$inty['id']}}">{{$inty['name']}}</option>
                                    @endforeach
                                </select>

                                {{--                                <input type="text" class="p-2 rounded" name="Setm" placeholder="روش تسویه">--}}
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شماره اقتصادی
                                    فروشنده
                                </div>
                                <input type="text" class="p-2 rounded" name="Tins">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1"> مبلغ پرداختی نقدی</div>
                                <input type="text" class="p-2 rounded" name="Cap">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شماره/شناسه
                                    ملی/شناسه مشاركت
                                    مدنی/كد فراگیر خریدار
                                </div>
                                <input type="text" class="p-2 rounded" name="Bid">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مبلغ پرداختی نسیه</div>
                                <input type="text" class="p-2 rounded" name="Insp">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مجموع سهم مالیات بر ارزش افزوده از پرداخت</div>
                                <input type="text" class="p-2 rounded" name="Tvop">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">كد پستی خریدار</div>
                                <input type="text" class="p-2 rounded" name="Bpc">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مالیات موضوع ماده 17</div>
                                <input type="text" class="p-2 rounded" name="Tax17">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">الگوی صورتحساب</div>
                                <input type="text" class="p-2 rounded" name="Inp">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">كد گمرک محل اظهار</div>
                                <input type="text" class="p-2 rounded" name="Scc">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">موضوع صورتحساب</div>
                                <input type="text" class="p-2 rounded" name="Ins">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شماره اشتراک/ شناسه
                                    بهره بردار قبض
                                </div>
                                <input type="text" class="p-2 rounded" name="Billid">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مجموع مبلغ قبل از
                                    كسر تخفیف
                                </div>
                                <input type="text" class="p-2 rounded" name="Tprdis">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مجموع تخفیفات</div>
                                <input type="text" class="p-2 rounded" name="Tdis">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مجموع مبلغ پس از
                                    كسر تخفیف
                                </div>
                                <input type="text" class="p-2 rounded" name="Tadis">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مجموع مالیات بر ارزش
                                    افزوده
                                </div>
                                <input type="text" class="p-2 rounded" name="Tvam">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مجموع سایر مالیات،
                                    عوارض و وجوه قانونی
                                </div>
                                <input type="text" class="p-2 rounded" name="Todam">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مجموع صورتحساب</div>
                                <input type="text" class="p-2 rounded" name="Tbill">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">نوع شخص خریدار</div>
                                <select name="Tob">
                                    @foreach(\App\Models\InvoiceHeader::$tobList as $inty)
                                        <option value="{{$inty['id']}}">{{$inty['name']}}</option>
                                    @endforeach
                                </select>

                                {{--                                <input type="text" class="p-2 rounded" name="Tob">--}}
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شماره اقتصادی خریدار</div>
                                <input type="text" class="p-2 rounded" name="Tinb">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">كد شعبه فروشنده</div>
                                <input type="text" class="p-2 rounded" name="Sbc">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">كد شعبه خریدار</div>
                                <input type="text" class="p-2 rounded" name="Bbc">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شماره گذرنامه خریدار</div>
                                <input type="text" class="p-2 rounded" name="Bpn">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شناسه یکتای ثبت
                                    قرارداد فروشنده
                                </div>
                                <input type="text" class="p-2 rounded" name="Crn">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">عدم پرداخت مالیات بر
                                    ارزش افزوده خریدار
                                </div>

                                <select name="dpvb">
                                    @foreach(\App\Models\InvoiceHeader::$dpvbList as $inty)
                                        <option value="{{$inty['id']}}">{{$inty['name']}}</option>
                                    @endforeach
                                </select>
                                {{--                                <input type="text" class="p-2 rounded" name="dpvb">--}}
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
