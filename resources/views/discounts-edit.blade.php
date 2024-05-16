<x-app-layout>
    <x-slot name="header">
        <a class="opacity-50 text-slate-700" href="{{route('discounts')}}">Discounts</a> / {{ __('Edit Discount') }}
    </x-slot>
    <x-slot name="title">
        {{ __('Edit Discount') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 flex pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
              <h6>Edit Discount</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
              <div class="p-6 overflow-x-auto">
                <form action="{{route('discounts-save', $discount)}}" method="post">
                    @csrf()
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Title</label>
                    <div class="mb-4">
                        <input type="text" name="title" value="{{$discount->title}}" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Status title" aria-label="Name">
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700 ">Discount (%)</label>
                    <div class="mb-4 flex flex-wrap">
                        <input type="number" step="0.01" value="{{$discount->discount}}" name="discount" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Discount amount" aria-label="Name">
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700 ">Customer</label>
                    <div class="mb-4 flex flex-wrap">
                        <select name="customer_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" >
                            <option value="">Select customer (optional)</option>
                            @foreach($customers as $customer)
                                <option value="{{$customer->id}}" @if($discount->customer_id==$customer->id) selected @endif>{{$customer->user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700 ">Patronage</label>
                    <div class="mb-4 flex flex-wrap">
                        <select name="patronage_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" >
                            <option value="">Select patronage (optional)</option>
                            @foreach($patronages as $patronage)
                                <option value="{{$patronage->id}}" @if($discount->patronage_id==$patronage->id) selected @endif>{{$patronage->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4 flex flex-wrap items-center">
                        <label class="mb-2 ml-1 font-bold text-xs text-slate-700 "><input type="checkbox" name="is_overall" value=1 @if($patronage->is_overall) checked @endif > Apply to the whole catalogue</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Save</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>
