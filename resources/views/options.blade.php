<x-app-layout>
    <x-slot name="header">
        {{ __('Options') }}
    </x-slot>
    <x-slot name="title">
        {{ __('Options') }}
    </x-slot>

    <div class="py-12">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pell/1.0.6/pell.min.js" integrity="sha512-3Qpnj2vZA7Bp07g78LJjUNfWytae4ISUzQuKVpprpMPby4Bum+l6q8XKOa5Zq/EPns9AvZXouGGOSNwSGzXpgA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pell/1.0.6/pell.min.css" integrity="sha512-sYCDFuPk7+GU2DVzEVgjs1AQFYD6dgllLSfthn+AoVKFsPGVD4aii5hFDXSfzW1KRZDgi0RudM4ULaGlfVf52w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 flex pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
              <h6>Change options</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
              <div class="p-6 overflow-x-auto">
                <form action="{{route('options.save')}}" method="post" enctype="multipart/form-data">
                    @csrf()
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Title</label>
                    <div class="mb-4">
                        <input type="text" name="title" value="{{$option->title}}" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Title" aria-label="Title">
                    </div>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Logo</label>
                    <div class="mb-4">
                        <input type="file" name="logo" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Logo" aria-label="Logo">
                    </div>
                    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Documentation Text</label>
                    <div class="mb-4">
                        <div id="editor"></div>
                        <textarea type="hidden" name="help" id="editor-content" required class="hidden focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Documentation Text" aria-label="Logo">{!!$option->help!!}</textarea>
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Invoice From Text</label>
                    <div class="mb-4">
                        <textarea name="invoice_from" id="invoice_from" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Invoice From Text" aria-label="Logo">{{$option->invoice_from}}</textarea>
                    </div>
                    <hr>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Left Column Title 1</label>
                    <div class="mb-4">
                        <input type="text" name="left_column_title1" value="{{$option->left_column_title1}}" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Dashboard Left Column Top Title" aria-label="Title">
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Left Column Title 2</label>
                    <div class="mb-4">
                        <input type="text" name="left_column_title2" value="{{$option->left_column_title2}}" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Dashboard Left Column Bottom Title" aria-label="Title">
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Dashboard Left Column Text</label>
                    <div class="mb-4">
                        <textarea name="left_column_text" id="left_column_text" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Dashboard Left Column Text" aria-label="Logo">{{$option->left_column_text}}</textarea>
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Dashboard Left Column Image</label>
                    <div class="mb-4">
                        <input type="file" name="left_column_image" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Logo" aria-label="Logo">
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Right Column Title</label>
                    <div class="mb-4">
                        <input type="text" name="right_column_title" value="{{$option->right_column_title}}" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Dashboard Right Column Title" aria-label="Title">
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Dashboard Right Column Text</label>
                    <div class="mb-4">
                        <textarea name="right_column_text" id="right_column_text" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Dashboard Right Column Text" aria-label="Logo">{{$option->right_column_text}}</textarea>
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Dashboard Right Column Image</label>
                    <div class="mb-4">
                        <input type="file" name="right_column_image" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Logo" aria-label="Logo">
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Période Critique</label>
                    <div class="mb-4">
                        <input type="number" name="deadline" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Préciser une période" aria-label="Logo" list="suggestions">
                        <datalist id="suggestions">
                            <option value="3">3 jours</option>
                            <option value="5">5 jours</option>
                            <option value="7">une semaine</option>
                        </datalist>
                    </div>


                    <script>
                        window.addEventListener('load', ()=>{
                            const editor = pell.init({
                                // <HTMLElement>, required
                                element: document.getElementById('editor'),

                                // <Function>, required
                                // Use the output html, triggered by element's `oninput` event
                                onChange: html => document.getElementById('editor-content').value = html,

                                // <string>, optional, default = 'div'
                                // Instructs the editor which element to inject via the return key
                                defaultParagraphSeparator: 'div',

                                // <boolean>, optional, default = false
                                // Outputs <span style="font-weight: bold;"></span> instead of <b></b>
                                styleWithCSS: false,

                                // <Array[string | Object]>, string if overwriting, object if customizing/creating
                                // action.name<string> (only required if overwriting)
                                // action.icon<string> (optional if overwriting, required if custom action)
                                // action.title<string> (optional)
                                // action.result<Function> (required)
                                // Specify the actions you specifically want (in order)
                                actions: [
                                    'bold',
                                    'italic',
                                    'underline',
                                    'strikethrough',
                                    'heading1',
                                    'heading2',
                                    'paragraph',
                                    'quote',
                                    'olist',
                                    'ulist',
                                    'line',
                                    'link',
                                    'image'
                                    
                                ],

                                // classes<Array[string]> (optional)
                                // Choose your custom class names
                                classes: {
                                    actionbar: 'pell-actionbar',
                                    button: 'pell-button',
                                    content: 'pell-content',
                                    selected: 'pell-button-selected'
                                }
                                })
                                editor.content.innerHTML = document.getElementById('editor-content').value

                        })
                    </script>
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
