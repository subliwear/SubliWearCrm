<x-app-layout>
    <x-slot name="header">
        <a class="opacity-50 text-slate-700" href="{{route('products')}}">Products</a> / {{ __('Edit Patronage') }}
    </x-slot>
    <x-slot name="title">
        {{ __('Edit Patronage') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 flex pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <a href="{{ route('products') }}" class="text-sm text-slate-700">
                        <svg class="w-6 h-6 mr-2 inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        
                    </a>
              <h6>Edit Patronage</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2" id="app">
              <div class="p-6 overflow-x-auto">
                <form action="{{route('products-patronage-save', $patronage)}}" method="post" enctype="multipart/form-data">
                    @csrf()
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Title</label>
                    <div class="mb-4">
                        <input type="text" name="title" value="{{$patronage->title}}" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Patronage title" aria-label="Name">
                    </div>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Price</label>
                    <div class="mb-4">
                        <input type="number" step="0.01" value="{{$patronage->price}}"  name="price" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Patronage price" aria-label="Name">
                    </div>
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Description</label>
                    <div class="mb-4">
                        <textarea type="text" name="description" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Patronage description" aria-label="Name">{{$patronage->description}}</textarea>
                    </div>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Categories</label>
                    <div class="mb-4 flex">
                        <patronage-categories-selector :categories="{{$categories}}" :selected="{{json_encode($patronage->categories)}}"/>
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">"Drag and drop" images</label>
                    <div class="mb-4">
                    <upload-category-edit :input="{{(empty($patronage->images)||$patronage->images=='null')?'[]':$patronage->images}}"></upload-category-edit>
                    </div>
                    <patronage-customer-selector :customer_ids="{{json_encode($patronage->customer_ids)}}"></patronage-customer-selector>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Image (Thumbnail of the patronage)</label>
                    <div class="mb-4">
                        <div class="flex px-2 py-1">
                            <div>
                              <img src="{{$patronage->preview}}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-xl" alt="{{$patronage->title}}">
                            </div>
                            <input type="file" name="preview" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Image" aria-label="Name">
                        </div>
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Downloadable file (PDF)</label>
                    <div class="mb-4">
                        <div class="flex px-2 py-1">
                            <div>
                              <a target="_blank" href="{{$patronage->download}}">Downloadable file</a>
                            </div>
                            <input type="file" name="download" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Downloadable file" aria-label="Name">
                        </div>
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
