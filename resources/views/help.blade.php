<x-app-layout>
    <x-slot name="header">
        {{ __('FAQ') }}
    </x-slot>

    <div class="w-full px-6 py-6 mx-auto">
      
      <div class="flex flex-wrap my-6 -mx-3">
        <div class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0 w-full md:flex-none lg:flex-none">
          <div class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
              <div class="flex flex-wrap mt-0 -mx-3">
                <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                  <h6>{{App\Models\Option::get()->title}} FAQ</h6>
                </div>
              </div>
            </div>
            <div class="flex-auto p-6 px-0 pb-2">
              <div class="overflow-x-auto">
                <div class="px-6">
                  {!!App\Models\Option::get()->help!!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
