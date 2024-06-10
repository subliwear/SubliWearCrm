<x-app-layout>
    <x-slot name="header">
        {{ __('Orders') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 flex pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent items-center">
              <a href="{{ route('orders') }}" class="btn btn-primary mr-2">
                <i class="fas fa-sync-alt"></i>
              </a>
              <h6 class="mb-0">Orders</h6>
              @if(auth()->user()->is_admin())
              <!-- <div class="w-90 ml-auto">
                <form action="{{route('orders')}}" method="GET" class="flex">
                  <input class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow mr-2" type="text" placeholder="Search orders with code" value="@if(isset($_GET['search'])){{$_GET['search']}}@endif" name="search">
                  <button><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
                </form>
              </div> -->
              @endif
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
              <div class="p-0 overflow-x-auto">
                <table  id="datatable" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                  <thead class="align-bottom">
                    <tr>
                      <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Id</th>  
                      <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Code</th>  
                      <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Name</th>
                      @if(!auth()->user()->is_customer())
                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Customer</th>
                      @endif
                      <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Manager</th>
                      <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                      <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Total</th>
                      <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Date création projet</th>
                      <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Date création commande</th>
                      <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                    <tr>
                       <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-xs">
                            #{{$order->id}}
                       </td>
                       <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-xs">
                        {{$order->uid}}
                      </td>
                       <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1 text-xs">
                          {{$order->project->title}}
                        </div>
                      </td>
                      @if(!auth()->user()->is_customer())
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @if(!empty($order->customer_id))
                                <p class="mb-0 text-xs font-semibold leading-tight">{{$order->project->customer->user->name}}</p>
                            @endif
                        </td>
                      @endif
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @if(!empty($order->project->manager_id))
                                <p class="mb-0 text-xs font-semibold leading-tight">{{$order->project->manager->user->name}}</p>
                            @endif
                        </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="mb-0 text-xs font-semibold leading-tight">
                            <span class="text-xs bg-gradient-to-tl rounded px-2 {{$order->status->background_color}} {{$order->status->text_color}}">
                                {{$order->status->title}}
                            </span>
                          </p>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="mb-0 text-xs font-semibold leading-tight">{{number_format($order->project->total(), 2)}}€</p>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <p class="mb-0 text-xs font-semibold leading-tight">{{ $order->project->created_at->format('d/m/Y') }}</p>
                      </td>

                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <p class="mb-0 text-xs font-semibold leading-tight">{{ $order->created_at->format('d/m/Y') }}</p>
                      </td>

                      <td class="p-2 align-middle text-right bg-transparent border-b whitespace-nowrap shadow-transparent">
                        @if(auth()->user()->is_admin())
                        <a title="Download XLS" href="{{route('orders-export-xls', $order)}}" class="mt-2 px-3 py-1 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="currentcolor"><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg> XLS</a>
                        <a title="Send invoice to email" href="{{route('orders-send-invoice', $order)}}" class="mt-2 px-3 py-1 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill=currentcolor><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg> Invoice</a>
                        @endif
                        <a title="Download invoice" href="{{route('orders-download-invoice', $order)}}" class="mt-2 px-3 py-1 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="currentcolor"><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg> Invoice</a>
                        <a href="{{route('orders-view', $order)}}" class="mt-2 px-3 py-1 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500"> Open </a>
                        @if(auth()->user()->is_admin())
                        <form class="inline ml-2" action="{{route('orders-delete', $order)}}" method="post"  onsubmit="return confirm('Do you really want to delete this record?');">
                          @method('delete')
                          @csrf()
                          <button class="text-xs font-semibold leading-tight text-red-500"> Delete </button>
                        </form>
                        @endif
                      </td>

                      
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="p-6">
                    {{$orders->appends(request()->input())->links('vendor.pagination.tailwind')}}
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>
