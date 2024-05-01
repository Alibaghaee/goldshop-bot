@extends('site.layout.master')

@section('content')

{{--    <div class="w-full h-full text-right  bg-slate-400">--}}

{{--        <div class="mx-auto  ">--}}

{{--            <div class="container   rounded p-5">--}}
{{--                <div class="mx-auto my-2 py-5 border rounded shadow flex flex-col bg-slate-200">--}}

{{--                    <div class="p-3  underline decoration-slate-600 ">سرآمد صورت حساب</div>--}}
{{--                    <form action="{{route('site.invoice_header.store')}}" method="post"--}}
{{--                          class="flex flex-col">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" class="p-2 rounded" name="invoice_id" value="1">--}}
{{--                        <div class="grid  grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 ">--}}
{{--                            <div class=" flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">شماره منحصر به فرد--}}
{{--                                    مالیاتی--}}
{{--                                </div>--}}
{{--                                <input type="text" class="p-2 rounded" name="TaxId" placeholder="شماره منحصر به فرد--}}
{{--مالیاتی">--}}
{{--                            </div>--}}
{{--                            <div class=" flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">تاریخ و زمان ایجاد--}}
{{--                                    صورتحساب--}}
{{--                                </div>--}}
{{--                                <input type="date" class="p-2 rounded" name="Indati2m" placeholder="تاریخ و زمان ایجاد--}}
{{--صورتحساب">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">تاریخ و زمان صدور--}}
{{--                                    صورتحساب--}}
{{--                                </div>--}}
{{--                                <input type="date" class="p-2 rounded" name="Indatim" placeholder="تاریخ و زمان صدور--}}
{{--صورتحساب">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">نوع صورتحساب</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Inty" placeholder="نوع صورتحساب">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1"> نوع پرواز</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Ft" placeholder=" نوع پرواز">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1"> سریال صورتحساب</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Inno" placeholder=" سریال صورتحساب">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">شماره منحصر به فرد--}}
{{--                                    مالیاتی صورتحساب--}}
{{--                                    مرجع--}}
{{--                                </div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Irtaxid" placeholder="شماره منحصر به فرد--}}
{{--مالیاتی صورتحساب--}}
{{--مرجع">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">شماره پروانه گمركی--}}
{{--                                    فروشنده--}}
{{--                                </div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Scln" placeholder="شماره پروانه گمركی--}}
{{--فروشنده">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">روش تسویه</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Setm" placeholder="روش تسویه">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">شماره اقتصادی--}}
{{--                                    فروشنده--}}
{{--                                </div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Tins">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1"> مبلغ پرداختی نقدی</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Cap">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">شماره/شناسه--}}
{{--                                    ملی/شناسه مشاركت--}}
{{--                                    مدنی/كد فراگیر خریدار--}}
{{--                                </div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Bid">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">مبلغ پرداختی نسیه</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Insp">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">مجموع سهم مالیات بر ارزش افزوده از پرداخت</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Tvop">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">كد پستی خریدار</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Bpc">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">مالیات موضوع ماده 17</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Tax17">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">الگوی صورتحساب</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Inp">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">كد گمرک محل اظهار</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Scc">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">موضوع صورتحساب</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Ins">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">شماره اشتراک/ شناسه--}}
{{--                                    بهره بردار قبض--}}
{{--                                </div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Billid">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">مجموع مبلغ قبل از--}}
{{--                                    كسر تخفیف--}}
{{--                                </div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Tprdis">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">مجموع تخفیفات</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Tdis">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">مجموع مبلغ پس از--}}
{{--                                    كسر تخفیف--}}
{{--                                </div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Tadis">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">مجموع مالیات بر ارزش--}}
{{--                                    افزوده--}}
{{--                                </div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Tvam">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">مجموع سایر مالیات،--}}
{{--                                    عوارض و وجوه قانونی--}}
{{--                                </div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Todam">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">مجموع صورتحساب</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Tbill">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">نوع شخص خریدار</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Tob">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">شماره اقتصادی خریدار</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Tinb">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">كد شعبه فروشنده</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Sbc">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">كد شعبه خریدار</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Bbc">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">شماره گذرنامه خریدار</div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Bpn">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">شناسه یکتای ثبت--}}
{{--                                    قرارداد فروشنده--}}
{{--                                </div>--}}
{{--                                <input type="text" class="p-2 rounded" name="Crn">--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">--}}
{{--                                <div class="text-white p-1">عدم پرداخت مالیات بر--}}
{{--                                    ارزش افزوده خریدار--}}
{{--                                </div>--}}
{{--                                <input type="text" class="p-2 rounded" name="dpvb">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <br>--}}
{{--                        <button type="submit"--}}
{{--                                class="mx-auto bg-slate-700 hover:bg-slate-800 rounded p-4 text-white w-full md:w-fit lg:w-fit  inline-block ">--}}
{{--                            ثبت--}}
{{--                        </button>--}}
{{--                    </form>--}}

{{--                </div>--}}


{{--            </div>--}}


{{--        </div>--}}

{{--    </div>--}}


<create-invoice :intylist="{{json_encode($intyList)}}" />
@endsection
