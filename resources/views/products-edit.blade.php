<x-app-layout>
    <x-slot name="header">
        <a class="opacity-50 text-slate-700" href="{{route('products')}}">Products</a> / {{ __('Edit Product') }}
    </x-slot>
    <x-slot name="title">
        {{ __('Edit Product') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 flex pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            
              <h6>Edit Product</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
              <div class="p-6 overflow-x-auto">
                <form action="{{route('products-save', $product)}}" method="post" enctype="multipart/form-data">
                    @csrf()
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Title</label>
                    <div class="mb-4">
                        <input type="text" value="{{$product->title}}" name="title" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Category title" aria-label="Name">
                    </div>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Description</label>
                    <div class="mb-4">
                        <textarea type="text" name="description" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Category title" aria-label="Name">{{$product->description}}</textarea>
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Category</label>
                    <div class="mb-4">
                        <select type="text" name="category_id" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Category title" aria-label="Name">
                            <option value="">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($category->id==$product->category_id) selected @endif>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Image</label>
                    <div class="mb-4">
                        <div class="flex px-2 py-1">
                            <div>
                              <img src="{{$product->preview}}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-xl" alt="{{$product->title}}">
                            </div>
                            <input type="file" name="preview" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Category title" aria-label="Name">
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
