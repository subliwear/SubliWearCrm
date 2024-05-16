<x-app-layout>
  <x-slot name="header">
      {{ __('Order Statuses') }}
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
          <div class="p-6 flex pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <h6>Order Statuses</h6>
            <a class="ml-auto inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25" href="{{route('order-statuses-add')}}"> <i class="fas fa-plus" aria-hidden="true"> </i>&nbsp;&nbsp;Add New Order Status</a>
          </div>
          <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
              <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                  <tr>
                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                    <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($order_statuses as $order_status)
                  <tr>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <div class="flex px-2 py-1">
                        <div class="flex flex-col justify-center">
                          <span class="bg-gradient-to-tl {{$order_status->background_color}} px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none {{$order_status->text_color}}">
                            {{$order_status->title}}
                          </span>
                        </div>
                      </div>
                    </td>
                   
                    <td class="p-2 text-right align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <a href="{{route('order-statuses-edit', $order_status)}}" class="text-xs font-semibold leading-tight text-slate-400"> Edit </a>
                      <form class="inline ml-2" action="{{route('order-statuses-delete', $order_status)}}" method="post"  onsubmit="return confirm('Do you really want to delete this record?');">
                        @method('delete')
                        @csrf()
                        <button class="text-xs font-semibold leading-tight text-red-500"> Delete </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</x-app-layout>
