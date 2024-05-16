<x-app-layout>
    <x-slot name="header">
        {{ __('Support') }}
    </x-slot>

    <div class="w-full px-6 py-6 mx-auto">
      
      <div class="flex flex-wrap my-6 -mx-3">
        <div class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0 w-full md:flex-none lg:flex-none">
          <div class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
              <div class="flex flex-wrap mt-0 -mx-3">
                <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                  <h6>Support</h6>
                </div>
              </div>
            </div>
            <div class="flex-auto p-6 px-0 pb-2">
              <div class="overflow-x-auto">
                <div class="px-6 mb-4">
                    <form action="{{route('support-submit')}}" method="post">
                        @csrf
                        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Subject</label>
                        <div class="mb-4">
                            <input type="text" name="subject" value="{{old('subject')}}" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Patronage title" aria-label="Name">
                        </div>
                        <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Message</label>
                        <div class="mb-4">
                            <textarea type="text" name="message" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Patronage title" aria-label="Name">{{old('message')}}</textarea>
                        </div>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        <div class="text-center">
                            <button type="submit" class="inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Submit</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
