<x-app-layout>
    <x-slot name="header">
        <a class="opacity-50 text-slate-700" href="{{route('order-statuses')}}">Order Statuses</a> / {{ __('Add Order Status') }}
    </x-slot>
    <x-slot name="title">
        {{ __('Add Order Status') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 flex pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
              <h6>Add Order Status</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
              <div class="p-6 overflow-x-auto">
                <form action="{{route('order-statuses-create')}}" method="post">
                    @csrf()
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Title</label>
                    <div class="mb-4">
                        <input type="text" name="title" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Status title" aria-label="Name">
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700 ">Text color</label>
                    <div class="mb-4 flex flex-wrap">
                        @foreach(['text-slate-500',
                        'text-slate-400',
                        'text-slate-700',
                        'text-gray-800',
                        'text-red-500',
                        'text-red-600',
                        'text-lime-500',
                        'text-cyan-500',
                        'text-fuchsia-500',
                        'text-white',
                        'text-black',
                        'text-gray-700',
                        'text-neutral-900',
                        'text-inherit',
                        'text-blue-800',
                        'text-sky-600',
                        'text-sky-900',
                        'text-slate-800'] as $k=>$txtclr)
                            <label class="p-4 block cursor-pointer bg-gray-200 m-4 text-center rounded-2xl">
                                <input type="radio" name="text_color" value="{{$txtclr}}" @if($k==0) checked @endif>
                                <span class="{{$txtclr}}">Ab</span>
                            </label>
                        @endforeach 
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700 ">Background color</label>
                    <div class="mb-4 flex flex-wrap">
                        @foreach(['from-purple-700 to-pink-500',
                        'from-slate-600 to-slate-300',
                        'from-gray-900 to-slate-800',
                        'from-blue-600 to-cyan-400',
                        'from-red-500 to-yellow-400',
                        'from-red-600 to-rose-400',
                        'from-green-600 to-lime-400',
                        'from-gray-400 to-gray-100'] as $k=>$bgclr)
                            <label class="p-4 block cursor-pointer bg-gray-200 m-4 text-center rounded-2xl bg-gradient-to-tl {{$bgclr}}">
                                <input type="radio" name="background_color" value="{{$bgclr}}" @if($k==0) checked @endif>
                            </label>
                        @endforeach 
                    </div>
                    <div class="text-center">
                        <button type="submit" class="inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Create</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>
