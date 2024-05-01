@extends(getSiteBladePath('layouts.master'))

@section('title', $title ?? 'سوابق مالی')

@section('content')

    <div class="text-purple-darkest leading-loose">
        <div class="container py-12">
            <div class="text-center md:text-right text-2xl md:text-3xl font-bold text-purple-darkest mb-2 w-full">سوابق مالی</div>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col">
              <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                  <div class="shadow overflow-hidden border-b border-grey-lightest sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-purple text-white">
                        <tr>
                          <th scope="col" class="px-6 py-4 text-right font-medium uppercase tracking-wider">
                            شناسه سفارش
                          </th>
                          <th scope="col" class="px-6 py-4 text-right font-medium uppercase tracking-wider">
                            عنوان
                          </th>
                          <th scope="col" class="px-6 py-4 text-right font-medium uppercase tracking-wider">
                            نوع پرداخت
                          </th>
                          <th scope="col" class="px-6 py-4 text-right font-medium uppercase tracking-wider">
                            مبلغ کل (ریال)
                          </th>
                          <th scope="col" class="px-6 py-4 text-right font-medium uppercase tracking-wider">
                            کد پیگیری
                          </th>
                          <th scope="col" class="px-6 py-4 text-right font-medium uppercase tracking-wider">
                            تاریخ
                          </th> 
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($purchases as $purchase)
                        <tr>
                          <td class="px-6 py-4 whitespace-nowrap">
                            {{ $purchase->id }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            {{ $purchase->title }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            {{ $purchase->type_title }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            {{ number_format($purchase->price) }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            {{ $purchase->tracking_code }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap dir-ltr text-right">
                            {{ $purchase->created_at_fa }}
                          </td>
                        </tr>
                        {{-- <tr>
                          <td colspan="6" class="px-6 py-4 whitespace-nowrap dir-ltr text-right">
                            <div class="flex flex-wrap -mx-2 justify-end">
                                <div class="px-2 w-full md:w-1/3">
                                  <div class="bg-grey-lighter rounded p-2 text-sm text-grey-darker">
                                    {{ $purchase->package->title }} 
                                    / <span class="font-medium">قیمت</span>: {{ number_format($purchase->package->price) }} ریال
                                  </div>
                                </div>
                            </div>
                          </td>
                        </tr> --}}
                        @endforeach

                        <!-- More people... -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        
        </div>
    </div>
    
@endsection
