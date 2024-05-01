@extends(getSiteBladePath('layouts.master'))

@section('title', $title ?? '')

@section('content')
    
    <div class="container py-4 md:py-12">
        <div class="flex flex-wrap justify-center w-full md:max-w-md mx-auto">

            <div class="text-center text-2xl md:text-3xl font-bold text-purple-darkest mb-2 w-full leading-loose">{{ $package->title }}</div>

            <div class="bg-pink border border-grey-lightest font-medium leading-loose mb-6 mx-auto p-6 rounded text-white w-full">
                {{ setting(43) }}
            </div>

            <div class="w-full flex flex-wrap justify-between">
                <div class="w-full mb-4">
                    <input type="text" v-model="discount_code" name="discount_code" class="rhc-form-control mb-4" placeholder="کد تخفیف">
                    @if ($errors->any())
                        <div class="bg-pink border border-grey-lightest font-medium leading-loose mb-6 mx-auto p-6 py-3 rounded text-white w-full">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if(!auth()->user()->hasSuccessfulPurchase($package->id) && $package->allow_installment)
                <a
                onclick="event.preventDefault();
                document.getElementById('pay-form-type-1').submit();"
                class="no-underline bg-green-light inline-block hover:bg-green rounded py-4 px-8 text-white cursor-pointer h-12 text-center mb-4">
                پرداخت پیش پرداخت ({{ number_format($package->pre_payment) }} ریال)
                </a>
                @endif

                @if(!auth()->user()->hasSuccessfulPurchase($package->id))
                    <a
                    onclick="event.preventDefault();
                    document.getElementById('pay-form-type-2').submit();"
                    class="no-underline bg-green-light inline-block hover:bg-green rounded py-4 px-8 text-white cursor-pointer h-12 text-center mb-4">
                    پرداخت یکجا ({{ number_format($package->price) }} ریال)
                    </a>
                @endif

                @if(auth()->user()->hasSuccessfulPurchase($package->id) && auth()->user()->payablePrice($package->id) > 0)
                <a
                onclick="event.preventDefault();
                document.getElementById('pay-form-type-3').submit();"
                class="no-underline bg-green-light inline-block hover:bg-green rounded py-4 px-8 text-white cursor-pointer h-12 text-center mb-4">
                پرداخت تکمیلی ({{ number_format(auth()->user()->payablePrice($package->id)) }} ریال)
                </a>
                @endif
            </div>



            <form id="pay-form-type-1" action="{{ route('pay_page.pay', [app()->getLocale(), $package->id]) }}" method="POST" style="display: none;">
                <input type="text" name="type" value="1">
                <input type="text" v-model="discount_code" name="discount_code">
                @csrf
            </form>

            <form id="pay-form-type-2" action="{{ route('pay_page.pay', [app()->getLocale(), $package->id]) }}" method="POST" style="display: none;">
                <input type="text" name="type" value="2">
                <input type="text" v-model="discount_code" name="discount_code">
                @csrf
            </form>

            <form id="pay-form-type-3" action="{{ route('pay_page.pay', [app()->getLocale(), $package->id]) }}" method="POST" style="display: none;">
                <input type="text" name="type" value="3">
                <input type="text" v-model="discount_code" name="discount_code">
                @csrf
            </form>


        </div>
    </div>
    
@endsection
