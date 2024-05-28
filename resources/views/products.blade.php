<x-app-layout>
    <x-slot name="header">
        {{ __('Products') }}
    </x-slot>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="flex w-full" style="gap: 30px">
                <div class="relative w-50 flex-grow flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 flex pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        
                    <h6>Categories</h6>
                    <a class="ml-auto inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25" href="{{route('products-category-add')}}"> <i class="fas fa-plus" aria-hidden="true"> </i>&nbsp;&nbsp;Add New Category</a>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Category</th>
                            {{-- <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th> --}}
                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                <div class="flex flex-col justify-center">
                                    {{$category->title}}
                                </div>
                                </div>
                            </td>
                            {{-- <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                <div class="flex flex-col justify-center">
                                    <a href="{{route('products-by-category', $category)}}">View {{$category->products->count()}} products</a>
                                </div>
                                </div>
                            </td> --}}
                            
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <a href="{{route('products-category-edit', $category)}}" class="text-xs font-semibold leading-tight text-slate-400"> Edit </a>
                                <form class="inline ml-2" action="{{route('products-category-delete', $category)}}" method="post"  onsubmit="return confirm('Do you really want to delete this record?');">
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
                <div class="relative  w-50  flex-grow flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 flex pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Patronages</h6>
                    <a class="ml-auto inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25" href="{{route('products-patronage-add')}}"> <i class="fas fa-plus" aria-hidden="true"> </i>&nbsp;&nbsp;Add New Patronage</a>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Patronage</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Categories</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Price</th>
                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patronages as $patronage)
                            <tr>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                    <div class="flex px-2 py-1">
                                        <div>
                                        <img src="{{ ($patronage->preview) }}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-xl" alt="{{$patronage->title}}">
                                        </div>
                                        <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 text-sm leading-normal">{{$patronage->title}}</h6>
                                        {{-- <p class="mb-0 text-xs leading-tight text-slate-400">{{$product->category->title}}</p> --}}
                                        </div>
                                    </div>
                                </div> 
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                <div class="flex flex-col justify-center">
                                    @if($patronage->categories!=='null' && !empty($patronage->categories) && count(json_decode($patronage->categories, true))>0)
                                        {{App\Models\Category::whereIn('id', json_decode($patronage->categories, true))->pluck('title')->join(', ')}}
                                    @endif
                                </div>
                                </div>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        &euro; {{$patronage->price}}
                                    </div>
                                </div>
                            </td>
                            
                            <td class="p-2 align-middle text-right bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <a href="{{route('products-patronage-edit', $patronage)}}" class="text-xs font-semibold leading-tight text-slate-400"> Edit </a>
                                <form class="inline ml-2" action="{{route('products-patronage-delete', $patronage)}}" method="post"  onsubmit="return confirm('Do you really want to delete this record?');">
                                @method('delete')
                                @csrf()
                                <button class="text-xs font-semibold leading-tight text-red-500"> Delete </button>
                                </form>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <div class="p-6">
                            {{$patronages->links('vendor.pagination.tailwind')}}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
           
        </div>
    </div>
  </x-app-layout>
  