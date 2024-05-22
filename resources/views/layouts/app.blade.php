<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{App\Models\Option::get()->title}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=open-sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <!-- Scripts -->
        @vite([/*'resources/css/app.css', */'resources/js/app.js'])
        <link rel="stylesheet" href="{{url('/assets/css/soft-ui-dashboard-tailwind.min.css')}}">
        <link rel="stylesheet" href="{{url('/assets/css/tooltips.css')}}">
        <link rel="stylesheet" href="{{url('/assets/css/perfect-scrollbar.css')}}">
        <link rel="stylesheet" href="{{url('/assets/css/nucleo-icons.css')}}">
    </head>
    <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">

        {{-- @if(isset($aside)) --}}
            <aside class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
            <div class="h-10"  style="margin-top: -30px;" >
              <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden" sidenav-close></i>
               <a class="flex px-5 py-4 m-0 text-sm whitespace-nowrap text-slate-700" href="{{ route('dashboard') }}" >
                  <x-application-logo class="block" width="100" />
               </a>
            </div>

            <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" style="margin-top: -30px;" />

        
                <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
                    <ul class="flex flex-col pl-0 mb-0">
                        {{-- {{$aside}} --}}
                        @if(auth()->user()->is_admin())
                        <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg @if(Route::current()->getName()=='dashboard') bg-white font-semibold shadow-soft-xl  @endif px-4  text-slate-700 transition-colors" href="{{route('dashboard')}}">
                              <div class="@if(Route::current()->getName()=='dashboard')bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                                <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                  <title>shop</title>
                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                      <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(0.000000, 148.000000)">
                                          <path
                                            class="opacity-60 @if(Route::current()->getName()=='dashboard') fill-white @else  fill-slate-800 @endif"
                                            d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"
                                          ></path>
                                          <path
                                            class="@if(Route::current()->getName()=='dashboard') fill-white @else  fill-slate-800 @endif"
                                            d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"
                                          ></path>
                                        </g>
                                      </g>
                                    </g>
                                  </g>
                                </svg>
                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                            </a>
                          </li>
                          <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  text-slate-700 transition-colors @if(strpos(Route::current()->getName(), 'managers')>-1) bg-white font-semibold shadow-soft-xl  @endif" href="{{route('managers')}}">
                              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg @if(strpos(Route::current()->getName(), 'managers')>-1)bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif bg-center stroke-0 text-center xl:p-2.5">
                                <i class="fa fa-user-secret @if(strpos(Route::current()->getName(), 'managers')>-1) text-white @else  text-slate-800 @endif"></i>
                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Designers</span>
                            </a>
                          </li>
                          <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  text-slate-700 transition-colors @if(strpos(Route::current()->getName(), 'customers')>-1) bg-white font-semibold shadow-soft-xl  @endif" href="{{route('customers')}}">
                              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg @if(strpos(Route::current()->getName(), 'customers')>-1)bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif bg-center stroke-0 text-center xl:p-2.5">
                                <i class="fa fa-user @if(strpos(Route::current()->getName(), 'customers')>-1) text-white @else  text-slate-800 @endif"></i>
                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Customers</span>
                            </a>
                          </li>
                          <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  text-slate-700 transition-colors @if(strpos(Route::current()->getName(), 'projects')>-1) bg-white font-semibold shadow-soft-xl  @endif" href="{{route('projects')}}">
                              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg @if(strpos(Route::current()->getName(), 'projects')>-1)bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif bg-center stroke-0 text-center xl:p-2.5">

                                <svg width="12px" height="20px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>spaceship</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                      <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                          <g transform="translate(4.000000, 301.000000)">
                                            <path class="@if(strpos(Route::current()->getName(), 'projects')>-1) fill-white @else  fill-slate-800 @endif " d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z"></path>
                                            <path class="@if(strpos(Route::current()->getName(), 'projects')>-1) fill-white @else  fill-slate-800 @endif  opacity-60" d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z"></path>
                                            <path class="@if(strpos(Route::current()->getName(), 'projects')>-1) fill-white @else  fill-slate-800 @endif  opacity-60" d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z"></path>
                                            <path class="@if(strpos(Route::current()->getName(), 'projects')>-1) fill-white @else  fill-slate-800 @endif  opacity-60" d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z"></path>
                                          </g>
                                        </g>
                                      </g>
                                    </g>
                                  </svg>

                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Projects</span>
                            </a>
                          </li>
                          <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  text-slate-700 transition-colors @if(strpos(Route::current()->getName(), 'orders')>-1) bg-white font-semibold shadow-soft-xl  @endif" href="{{route('orders')}}">
                              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg @if(strpos(Route::current()->getName(), 'orders')>-1)bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif bg-center stroke-0 text-center xl:p-2.5">
                                <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>credit-card</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                      <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                          <g transform="translate(453.000000, 454.000000)">
                                            <path class="@if(strpos(Route::current()->getName(), 'orders')>-1) fill-white @else  fill-slate-800 @endif opacity-60" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"></path>
                                            <path class="@if(strpos(Route::current()->getName(), 'orders')>-1) fill-white @else  fill-slate-800 @endif" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                          </g>
                                        </g>
                                      </g>
                                    </g>
                                  </svg>
                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Orders</span>
                            </a>
                          </li>
                          <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  text-slate-700 transition-colors @if(strpos(Route::current()->getName(), 'order-statuses')>-1) bg-white font-semibold shadow-soft-xl  @endif" href="{{route('order-statuses')}}">
                              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg @if(strpos(Route::current()->getName(), 'order-statuses')>-1)bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif bg-center stroke-0 text-center xl:p-2.5">
                                <i class="fa fa-bars @if(strpos(Route::current()->getName(), 'order-statuses')>-1) text-white @else  text-slate-800 @endif"></i>
                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Order statuses</span>
                            </a>
                          </li>
                          <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  text-slate-700 transition-colors @if(strpos(Route::current()->getName(), 'products')>-1) bg-white font-semibold shadow-soft-xl  @endif" href="{{route('products')}}">
                              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg @if(strpos(Route::current()->getName(), 'products')>-1)bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif bg-center stroke-0 text-center xl:p-2.5">
                                <svg width="12px" height="12px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>document</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                      <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                          <g transform="translate(154.000000, 300.000000)">
                                            <path class=" @if(strpos(Route::current()->getName(), 'products')>-1) fill-white @else  fill-slate-800 @endif opacity-60" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"></path>
                                            <path class=" @if(strpos(Route::current()->getName(), 'products')>-1) fill-white @else  fill-slate-800 @endif" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z"></path>
                                          </g>
                                        </g>
                                      </g>
                                    </g>
                                  </svg>
                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Products</span>
                            </a>
                          </li>
                          <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  text-slate-700 transition-colors @if(Route::current()->getName()=='discounts') bg-white font-semibold shadow-soft-xl  @endif" href="{{route('discounts')}}">
                              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg @if(Route::current()->getName()=='discounts')bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif bg-center stroke-0 text-center xl:p-2.5">
                                <i class="fa fa-percent @if(Route::current()->getName()=='discounts') text-white @else  text-slate-800 @endif"></i>
                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Discounts</span>
                            </a>
                          </li>
                        @endif

                        @if(auth()->user()->is_manager())
                            <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg @if(Route::current()->getName()=='dashboard') bg-white font-semibold shadow-soft-xl  @endif px-4  text-slate-700 transition-colors" href="{{route('dashboard')}}">
                              <div class="@if(Route::current()->getName()=='dashboard')bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                                <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                  <title>shop</title>
                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                      <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(0.000000, 148.000000)">
                                          <path
                                            class="opacity-60 @if(Route::current()->getName()=='dashboard') fill-white @else  fill-slate-800 @endif"
                                            d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"
                                          ></path>
                                          <path
                                            class="@if(Route::current()->getName()=='dashboard') fill-white @else  fill-slate-800 @endif"
                                            d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"
                                          ></path>
                                        </g>
                                      </g>
                                    </g>
                                  </g>
                                </svg>
                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                            </a>
                          </li>
                          <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  text-slate-700 transition-colors @if(strpos(Route::current()->getName(), 'customers')>-1) bg-white font-semibold shadow-soft-xl  @endif" href="{{route('customers')}}">
                              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg @if(strpos(Route::current()->getName(), 'customers')>-1)bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif bg-center stroke-0 text-center xl:p-2.5">
                                <i class="fa fa-user @if(strpos(Route::current()->getName(), 'customers')>-1) text-white @else  text-slate-800 @endif"></i>
                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Customers</span>
                            </a>
                          </li>
                          <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  text-slate-700 transition-colors @if(strpos(Route::current()->getName(), 'projects')>-1) bg-white font-semibold shadow-soft-xl  @endif" href="{{route('projects')}}">
                              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg @if(strpos(Route::current()->getName(), 'projects')>-1)bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif bg-center stroke-0 text-center xl:p-2.5">

                                <svg width="12px" height="20px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>spaceship</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                      <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                          <g transform="translate(4.000000, 301.000000)">
                                            <path class="@if(strpos(Route::current()->getName(), 'projects')>-1) fill-white @else  fill-slate-800 @endif " d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z"></path>
                                            <path class="@if(strpos(Route::current()->getName(), 'projects')>-1) fill-white @else  fill-slate-800 @endif  opacity-60" d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z"></path>
                                            <path class="@if(strpos(Route::current()->getName(), 'projects')>-1) fill-white @else  fill-slate-800 @endif  opacity-60" d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z"></path>
                                            <path class="@if(strpos(Route::current()->getName(), 'projects')>-1) fill-white @else  fill-slate-800 @endif  opacity-60" d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z"></path>
                                          </g>
                                        </g>
                                      </g>
                                    </g>
                                  </svg>

                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Projects</span>
                            </a>
                          </li>
                          <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  text-slate-700 transition-colors @if(strpos(Route::current()->getName(), 'orders')>-1) bg-white font-semibold shadow-soft-xl  @endif" href="{{route('orders')}}">
                              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg @if(strpos(Route::current()->getName(), 'orders')>-1)bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif bg-center stroke-0 text-center xl:p-2.5">
                                <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>credit-card</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                      <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                          <g transform="translate(453.000000, 454.000000)">
                                            <path class="@if(strpos(Route::current()->getName(), 'orders')>-1) fill-white @else  fill-slate-800 @endif opacity-60" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"></path>
                                            <path class="@if(strpos(Route::current()->getName(), 'orders')>-1) fill-white @else  fill-slate-800 @endif" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                          </g>
                                        </g>
                                      </g>
                                    </g>
                                  </svg>
                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Orders</span>
                            </a>
                          </li>
                        @endif

                        @if(auth()->user()->is_customer())
                            <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg @if(Route::current()->getName()=='dashboard') bg-white font-semibold shadow-soft-xl  @endif px-4  text-slate-700 transition-colors" href="{{route('dashboard')}}">
                              <div class="@if(Route::current()->getName()=='dashboard')bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                                <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                  <title>shop</title>
                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                      <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(0.000000, 148.000000)">
                                          <path
                                            class="opacity-60 @if(Route::current()->getName()=='dashboard') fill-white @else  fill-slate-800 @endif"
                                            d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"
                                          ></path>
                                          <path
                                            class="@if(Route::current()->getName()=='dashboard') fill-white @else  fill-slate-800 @endif"
                                            d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"
                                          ></path>
                                        </g>
                                      </g>
                                    </g>
                                  </g>
                                </svg>
                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                            </a>
                          </li>
                          <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  text-slate-700 transition-colors @if(strpos(Route::current()->getName(), 'projects')>-1) bg-white font-semibold shadow-soft-xl  @endif" href="{{route('projects')}}">
                              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg @if(strpos(Route::current()->getName(), 'projects')>-1)bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif bg-center stroke-0 text-center xl:p-2.5">

                                <svg width="12px" height="20px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>spaceship</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                      <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                          <g transform="translate(4.000000, 301.000000)">
                                            <path class="@if(strpos(Route::current()->getName(), 'projects')>-1) fill-white @else  fill-slate-800 @endif " d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z"></path>
                                            <path class="@if(strpos(Route::current()->getName(), 'projects')>-1) fill-white @else  fill-slate-800 @endif  opacity-60" d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z"></path>
                                            <path class="@if(strpos(Route::current()->getName(), 'projects')>-1) fill-white @else  fill-slate-800 @endif  opacity-60" d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z"></path>
                                            <path class="@if(strpos(Route::current()->getName(), 'projects')>-1) fill-white @else  fill-slate-800 @endif  opacity-60" d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z"></path>
                                          </g>
                                        </g>
                                      </g>
                                    </g>
                                  </svg>

                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Projects</span>
                            </a>
                          </li>
                          <li class="mt-0.5 w-full">
                            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  text-slate-700 transition-colors @if(strpos(Route::current()->getName(), 'orders')>-1) bg-white font-semibold shadow-soft-xl  @endif" href="{{route('orders')}}">
                              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg @if(strpos(Route::current()->getName(), 'orders')>-1)bg-gradient-to-tl from-blue-600 to-cyan-400 @else  bg-white @endif bg-center stroke-0 text-center xl:p-2.5">
                                <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>credit-card</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                      <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                          <g transform="translate(453.000000, 454.000000)">
                                            <path class="@if(strpos(Route::current()->getName(), 'orders')>-1) fill-white @else  fill-slate-800 @endif opacity-60" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"></path>
                                            <path class="@if(strpos(Route::current()->getName(), 'orders')>-1) fill-white @else  fill-slate-800 @endif" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                          </g>
                                        </g>
                                      </g>
                                    </g>
                                  </svg>
                              </div>
                              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Orders</span>
                            </a>
                          </li>
                        @endif
                    </ul>
                </div>
                  <div class="mx-4">

                    <p class="invisible hidden text-gray-800 text-red-500 text-red-600 after:bg-gradient-to-tl after:from-gray-900 after:to-slate-800  after:bg-gradient-to-tl after:from-blue-600 after:to-cyan-400 after:bg-gradient-to-tl after:from-red-500 after:to-yellow-400 after:bg-gradient-to-tl after:from-green-600 after:to-lime-400 after:bg-gradient-to-tl after:from-red-600 after:to-rose-400 after:bg-gradient-to-tl after:from-slate-600 after:to-slate-300 text-lime-500 text-cyan-500 text-slate-400 text-fuchsia-500"></p>
                    <div class="after:opacity-65 after:bg-gradient-to-tl after:from-slate-600 after:to-slate-300 relative flex min-w-0 flex-col items-center break-words rounded-2xl border-0 border-solid border-blue-900 bg-white bg-clip-border shadow-none after:absolute after:top-0 after:bottom-0 after:left-0 after:z-10 after:block after:h-full after:w-full after:rounded-2xl after:content-['']" sidenav-card="">
                    <div class="mb-7.5 absolute h-full w-full rounded-2xl bg-cover bg-center" style="background-image: url('../assets/img/curved-images/white-curved.jpeg')"></div>
                    <div class="relative z-20 flex-auto w-full p-4 text-left text-white">
                    <div class="flex items-center justify-center w-8 h-8 mb-4 text-center bg-white bg-center rounded-lg icon shadow-soft-2xl">
                    <i class="top-0 z-10 text-transparent ni leading-none ni-diamond text-lg bg-gradient-to-tl from-slate-600 to-slate-300 bg-clip-text opacity-80" aria-hidden="true" sidenav-card-icon=""></i>
                    </div>
                    <div class="transition-all duration-200 ease-nav-brand">
                    <h6 class="mb-0 text-white">Need help?</h6>
                    <p class="mt-0 mb-4 font-semibold leading-tight text-xs">Please check our docs</p>
                    <a href="{{route('help')}}" class="inline-block w-full px-8 py-2 mb-0 font-bold text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102">Documentation</a>
                    </div>
                    </div>
                    </div>
                    
                    <a class="inline-block w-full px-6 py-3 my-4 font-bold text-center text-white uppercase align-middle transition-all ease-in border-0 rounded-lg select-none shadow-soft-md bg-150 bg-x-25 leading-pro text-xs bg-gradient-to-tl from-purple-700 to-pink-500 hover:shadow-soft-2xl hover:scale-102" href="{{route('support')}}">Contact support</a>
                    </div>
            </aside>
        {{-- @endif --}}

        <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
            @include('layouts.navigation')

            {{ $slot }}
        </main>

        {{-- <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
               
            </main>
        </div> --}}
        <style>
          .loader,
          .loader:after {
            border-radius: 50%;
            width: 20px;
            height: 20px;
          }
          .loader {
            margin: 0px auto;
            font-size: 10px;
            position: relative;
            text-indent: -9999em;
            border-top: 1.1em solid rgba(255, 255, 255, 0.2);
            border-right: 1.1em solid rgba(255, 255, 255, 0.2);
            border-bottom: 1.1em solid rgba(255, 255, 255, 0.2);
            border-left: 1.1em solid #ffffff;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load8 1.1s infinite linear;
            animation: load8 1.1s infinite linear;
          }
          @-webkit-keyframes load8 {
            0% {
              -webkit-transform: rotate(0deg);
              transform: rotate(0deg);
            }
            100% {
              -webkit-transform: rotate(360deg);
              transform: rotate(360deg);
            }
          }
          @keyframes load8 {
            0% {
              -webkit-transform: rotate(0deg);
              transform: rotate(0deg);
            }
            100% {
              -webkit-transform: rotate(360deg);
              transform: rotate(360deg);
            }
          }

        </style>
    </body>
</html>
