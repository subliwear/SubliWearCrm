<x-app-layout>
    <x-slot name="header">
        <a class="opacity-50 text-slate-700" href="{{route('managers')}}">Designers</a> / {{ __('Add Designer') }}
    </x-slot>
    <x-slot name="title">
        {{ __('Add Designer') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 flex pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
              <h6>Add Designer</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
              <div class="p-6 overflow-x-auto">
                <form action="{{route('managers-create')}}" method="post">
                    @csrf()
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Name</label>
                    <div class="mb-4">
                        <input type="text" name="name" value="{{old('name')}}" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Designer's name" aria-label="Name">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
                    <div class="mb-4">
                        <input type="email" name="email" value="{{old('email')}}" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Designer's Email" aria-label="Email" aria-describedby="email-addon">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <div class="mb-4">
                        <p>Password will be generated and sent to the designer's email.</p>
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
