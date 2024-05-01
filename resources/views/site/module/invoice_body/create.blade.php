@extends('site.layout.master')

@section('content')

    <div class="w-full h-full text-right  bg-slate-400">

        <div class="mx-auto  ">

            <div class="container   rounded p-5">


                <div class="mx-auto my-10  py-5 border rounded shadow flex flex-col bg-slate-200">

                    <div class="p-3  underline decoration-slate-600 ">بدنه صورت حساب</div>
                    <form action="{{route('site.invoice_body.store')}}" method="post"
                          class="flex flex-col">
                        @csrf
                        <input type="hidden" class="p-2 rounded" name="invoice_id" value="{{$invoice->id}}">
                        <div class="grid  grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 ">
                            <div class=" flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شرح كالا/خدمت</div>
                                <input type="text" class="p-2 rounded" name="Sstt" placeholder="شرح كالا/خدمت">
                            </div>
                            <div class=" flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">واحد اندازه گیری</div>
                                <input type="text" class="p-2 rounded" name="Mu" placeholder="واحد اندازه گیری">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1"> تعداد/مقدار</div>
                                <input type="text" class="p-2 rounded" name="Am" placeholder=" تعداد/مقدار">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مبلغ واحد</div>
                                <input type="text" class="p-2 rounded" name="Fee" placeholder="مبلغ واحد">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">میزان ارز</div>
                                <input type="text" class="p-2 rounded" name="Cfee" placeholder="میزان ارز">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1"> نوع ارز</div>
                                <input type="text" class="p-2 rounded" name="Cut" placeholder=" نوع ارز">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">نرخ برابری ارز با ریال</div>
                                <input type="text" class="p-2 rounded" name="Exr" placeholder="نرخ برابری ارز با ریال">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مبلغ قبل از تخفیف</div>
                                <input type="text" class="p-2 rounded" name="Prdis" placeholder="مبلغ قبل از تخفیف">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1"> مبلغ تخفیف</div>
                                <input type="text" class="p-2 rounded" name="Dis" placeholder=" مبلغ تخفیف">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مبلغ بعد از تخفیف</div>
                                <input type="text" class="p-2 rounded" name="Adis" placeholder="مبلغ بعد از تخفیف">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">نرخ مالیات بر
                                    ارزشافزوده
                                </div>
                                <input type="text" class="p-2 rounded" name="Vra" placeholder="نرخ مالیات بر
ارزشافزوده">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مبلغ مالیات بر ارزش
                                    افزوده
                                </div>
                                <input type="text" class="p-2 rounded" name="Vam" placeholder="مبلغ مالیات بر ارزش
افزوده">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">موضوع سایرمالیات و
                                    عوارض
                                </div>
                                <input type="text" class="p-2 rounded" name="Odt" placeholder="موضوع سایرمالیات و
عوارض">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">نرخ سایرمالیات و
                                    عوارض
                                </div>
                                <input type="text" class="p-2 rounded" name="Odr" placeholder="نرخ سایرمالیات و
عوارض">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">مبلغ سایرمالیات و
                                    عوارض
                                </div>
                                <input type="text" class="p-2 rounded" name="Odam" placeholder="مبلغ سایرمالیات و
عوارض">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">موضوع سایر وجوه
                                    قانونی
                                </div>
                                <input type="text" class="p-2 rounded" name="Olt" placeholder="موضوع سایر وجوه
قانونی">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">رخ سایر وجوه قانونی</div>
                                <input type="text" class="p-2 rounded" name="Olr" placeholder="رخ سایر وجوه قانونی">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1"> مبلغ سایر وجوه قانونی</div>
                                <input type="text" class="p-2 rounded" name="Olam" placeholder=" مبلغ سایر وجوه قانونی">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">اجرت ساخت</div>
                                <input type="text" class="p-2 rounded" name="Consfee" placeholder="اجرت ساخت">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">سود فروشنده</div>
                                <input type="text" class="p-2 rounded" name="Spro" placeholder="سود فروشنده">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">حق العمل</div>
                                <input type="text" class="p-2 rounded" name="Bros" placeholder="حق العمل">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">جمع كل اجرت، حق-
                                    العمل و سود
                                </div>
                                <input type="text" class="p-2 rounded" name="Tcpbs" placeholder="جمع كل اجرت، حق-
العمل و سود">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">سهم نقدی از پرداخت</div>
                                <input type="text" class="p-2 rounded" name="Cop" placeholder="سهم نقدی از پرداخت">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شناسه یکتای ثبت
                                    قرارداد حق العملکاری
                                </div>
                                <input type="text" class="p-2 rounded" name="Bsrn" placeholder="شناسه یکتای ثبت
قرارداد حق العملکاری">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">سهم ارزش افزوده از
                                    پرداخت
                                </div>
                                <input type="text" class="p-2 rounded" name="Vop" placeholder="سهم ارزش افزوده از
پرداخت">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1"> مبلغ كل كالا/خدمت</div>
                                <input type="text" class="p-2 rounded" name="Tsstam" placeholder=" مبلغ كل كالا/خدمت">
                            </div>
                            <div class="flex flex-col py-4 m-2 px-2 shadow rounded border bg-slate-400">
                                <div class="text-white p-1">شناسه كالا/خدمت</div>
                                <input type="text" class="p-2 rounded" name="Sstid" placeholder="شناسه كالا/خدمت">
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
