<x-app-layout>
    <x-slot name="header">
        {{ __('Projects') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 flex pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
              <h6 class="mb-0">Projects</h6>
              @if(auth()->user()->is_admin())
              <div class="w-90 ml-auto">
                <form action="{{route('projects')}}" method="GET" class="flex">
                  <input class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow mr-2" type="text" placeholder="Search projects" value="@if(isset($_GET['search'])){{$_GET['search']}}@endif" name="search">
                  <button><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
                </form>
              </div>
              @endif
              @if(auth()->user()->is_customer())
                <a class="ml-auto inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25" href="{{route('project-create')}}"> <i class="fas fa-plus" aria-hidden="true"> </i>&nbsp;&nbsp;Add New Project</a>
              @endif
            </div>
            <div class="flex-auto px-2 pt-0 pb-2">
              <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                  <thead class="align-bottom">
                    <tr>
                      <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Id</th>  
                      <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Code</th>  
                      <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Title</th>
                      @if(!auth()->user()->is_customer())
                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Customer</th>
                      @endif
                      <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Manager</th>
                      <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Is ordered</th>
                      <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Total</th>
                      <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $free_project_count = 0;
                    @endphp
                    @foreach($projects as $project)
                    <tr>
                       <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <div class="flex items-center">
                          @if(auth()->user()->is_manager() && $project->is_read_manager==false)
                            <div class="unread mr-2"></div>
                          @endif
                          @if(auth()->user()->is_customer() && $project->is_read_customer==false)
                            <div class="unread mr-2"></div>
                          @endif
                          <p class="mb-0 text-xs font-semibold leading-tight">#{{$project->id}}</p>
                        </div>
                       </td>
                       <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                            <p class="mb-0 text-xs font-semibold leading-tight">{{$project->uid}}</p>
                        </div>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="mb-0 text-xs font-semibold leading-tight">{{$project->title}}</p>
                       </td>
                      @if(!auth()->user()->is_customer())
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @if(!empty($project->customer_id))
                                <p class="mb-0 text-xs font-semibold leading-tight">{{$project->customer->user->name}}</p>
                            @endif
                        </td>
                      @endif
                      @if(!auth()->user()->is_manager())
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @if(!empty($project->manager_id))
                                <p class="mb-0 text-xs font-semibold leading-tight">{{$project->manager->user->name}}</p>
                            @endif
                        </td>
                      @endif
                      
                      @if(auth()->user()->is_manager())
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @if(empty($project->manager_id) && $free_project_count==0 && auth()->user()->manager->canTake())
                              @php
                                $free_project_count++;
                              @endphp
                                <a class="mt-2 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500" href="{{route('projects-take', $project)}}">Take this project</a>
                            @endif
                            @if($project->manager_id == auth()->user()->manager->id)
                                <p class="mb-0 text-xs font-semibold leading-tight">My project</p>
                            @endif
                        </td>
                      @endif
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        @if($project->is_ordered)  
                            <p class="mb-0 text-xs font-semibold leading-tight">
                                <span class="px-2 text-xs rounded text-white bg-gradient-to-tl from-green-600 to-lime-400">Ordered</span>
                            </p>
                        @else
                            <p class="mb-0 text-xs font-semibold leading-tight">
                                <span class="px-2 text-xs rounded text-white bg-gradient-to-tl from-blue-600 to-slate-300">In progress</span>
                            </p>
                        @endif
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="mb-0 text-xs font-semibold leading-tight">{{number_format($project->total(), 2)}}€</p>
                      </td>
                      <td class="p-2 align-middle text-right bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <a href="{{route('projects-view', $project)}}" class="mt-2 px-8 py-1 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500"> Open </a>
                        @if(auth()->user()->is_admin())
                        <form class="inline ml-2" action="{{route('projects-delete', $project)}}" method="post"  onsubmit="return confirm('Do you really want to delete this record?');">
                          @method('delete')
                          @csrf()
                          <button class="text-xs font-semibold leading-tight text-red-500"> Delete </button>
                        </form>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="p-6">
                    {{$projects->appends(request()->input())->links('vendor.pagination.tailwind')}}
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <style>
      .unread{
        width: 10px;
        height: 10px;
        border-radius: 10px;
        background-color:#ff0080;
      }
    </style>
</x-app-layout>
