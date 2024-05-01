<div class="h-full relative my-8 w-full">
  <div class="container h-full flex flex-col items-center justify-center relative z-20">

      @if(hasVpn())
      <div class="bg-red text-2xl rounded-lg p-4 md:p-8 text-white w-full mb-2 text-center font-bold">
        برای عدم بروز مشکل در مراحل پرداخت، لطفا vpn خود را خاموش کنید.
      </div>
      @endif
      <div class="w-full flex flex-row flex-wrap rounded-lg md:flex-row-reverse flex-col-reverse">

        <div class="w-full md:w-2/3 p-4 md:p-8 rounded-b-lg md:rounded-b-none md:rounded-l-lg" style="background-color: rgb(255 255 255 / 96.5%); min-height: 650px;">

          @yield('content')
          
        </div>

        <div class="w-full md:w-1/3 rounded-t-lg md:rounded-t-none md:rounded-r-lg flex flex-wrap items-center justify-center p-6" style="background:url(/image/site/side-bg.svg); min-height: 150px; background-size: cover;" style="background-color: #0354ad;">
          <div>
            {{-- <div class="text-white text-3xl font-black text-center mb-6">
              خوش آمدید
            </div> --}}
            <div class="text-center text-grey-lightest leading-normal font-thin">
              <img src="/image/site/logo.png" alt="logo" class="w-32 md:w-64">
            </div>
            {{-- <a href="#" class="rounded-full border-2 border-grey-lightest p-4 py-3 no-underline w-48 text-center block text-xl text-grey-lightest mx-auto mt-16 hover:bg-white hover:text-teal hover:border-teal">ورود</a> --}}
          </div>
        </div>

        <div class="mt-2 p-6 rounded-lg text-center w-full">
          <a class="no-underline text-grey-darkest" href="tel:02162999006">تماس با ما: 62999006-021</a>
        </div>

      </div>
  </div>
</div>