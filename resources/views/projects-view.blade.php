<x-app-layout>
    <x-slot name="header">
        <a class="opacity-50 text-slate-700" href="{{route('projects')}}">Projects</a> / {{$project->title}}
    </x-slot>
    <x-slot name="title">
        {{$project->title}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto px-0 pt-0 pb-2">
              <div class="p-6 overflow-x-auto">
                <div id="app">
                    <project-chat project_uid="{{$project->uid}}" project_id="{{$project->id}}" :is_admin="{{intval(auth()->user()->is_admin())}}" :is_ordered="{{$project->is_ordered}}" project_title="{{$project->title}}" :is_customer="{{intval(auth()->user()->is_customer())}}" :customer="{{$project->customer->user}}" @if($project->manager_id) :manager="{{$project->manager->user}}" @else :manager="false" @endif />
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>
