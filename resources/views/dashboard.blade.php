<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="w-full px-6 py-6 mx-auto">
      @php
        $option = App\Models\Option::get();
      @endphp
      <div class="flex flex-wrap mt-6 -mx-3">
        <div class="w-full px-3 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
          <div class="relative flex flex-col min-w-0  break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border" style="width: 85%;">
            <div class="flex-auto p-4" >
              <div class="flex flex-wrap -mx-3">
                <div class="max-w-full px-3 lg:w-1/2 lg:flex-none">
                  <div class="flex flex-col h-full">

                   <!-- <h3>{{$option}}</h3> -->
                    <p class="pt-2 mb-1 font-semibold">{{$option->left_column_title1}}</p>
                    <h5 class="font-bold">{{$option->left_column_title2}}</h5>
                    <p class="mb-12">{{$option->left_column_text}}</p>
                    @if(auth()->user()->is_customer())
                      <a class="mt-auto mb-0 font-semibold leading-normal text-sm group text-slate-500" href="{{route('project-create')}}">
                        Create a new project
                        <i class="fas fa-arrow-right ease-bounce text-sm group-hover:translate-x-1.25 ml-1 leading-normal transition-all duration-200" aria-hidden="true"></i>
                      </a>
                    @endif
                  </div>
                </div>
                <div class="max-w-full px-3 mt-12 ml-auto text-center lg:mt-0 lg:w-5/12 lg:flex-none">
                  <div class="h-full from-purple-700 to-pink-500 rounded-xl">
                    {{-- <img src="{{$option->left_column_title1}}" class="absolute top-0 hidden w-1/2 h-full lg:block" alt="waves"> --}}
                    <div class="relative flex items-center justify-center h-full rounded-lg overflow-hidden" style="background-image: url({{$option->left_column_image}});background-size: cover;background-repeat: no-repeat;border-radius: 15px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none" >
          <div class="border-black/12.5 shadow-soft-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border p-4" style="margin-left : -20%" >
            <div class="relative h-full overflow-hidden bg-cover rounded-xl" style="background-image: url('{{$option->right_column_image}}')">
              <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80"></span>
              <div class="relative z-10 flex flex-col flex-auto h-full p-4">
                <h5 class="pt-2 mb-6 font-bold text-white">{{$option->right_column_title}}</h5>
                <p class="text-white">{{$option->right_column_text}}</p>
                {{-- <a class="mt-auto mb-0 font-semibold leading-normal text-white group text-sm" href="javascript:;">
                Read More
                <i class="fas fa-arrow-right ease-bounce text-sm group-hover:translate-x-1.25 ml-1 leading-normal transition-all duration-200" aria-hidden="true"></i>
                </a> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="flex flex-wrap my-6 -mx-3">
        <div class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0 w-1/2 md:flex-none lg:flex-none" >
          <div class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
              <div class="flex flex-wrap mt-0 -mx-3">
                <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                  <h6>Projects</h6>
                </div>
              </div>
            </div>
            <div class="flex-auto p-6 px-0 pb-2">
              <div class="overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                  <thead class="align-bottom">
                    <tr>
                      <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Id</th>  
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
                            <p class="mb-0 text-xs font-semibold leading-tight">{{$project->title}}</p>
                        </div>
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
                            @if(empty($project->manager_id))
                                <p class="mb-0 text-xs font-semibold leading-tight">...</p>
                            @endif
                        </td>
                      @endif
                      @if(auth()->user()->is_manager())
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @if(empty($project->manager_id) )
                             <!-- à  enregister si ona a besoin && $free_project_count==0 && auth()->user()->manager->canTake() -->
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
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <a href="{{route('projects-view', $project)}}" class="mt-2 px-8 py-1 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500"> Open </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full max-w-full px-3 w-1/2 md:flex-none lg:flex-none">
          <div class="border-black/12.5 shadow-soft-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
              <h6>Orders</h6>
            </div>
            <div class="flex-auto p-4">
              <div class="overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                  <thead class="align-bottom">
                    <tr>
                      <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Id</th>  
                      <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Name</th>
                      @if(!auth()->user()->is_customer())
                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Customer</th>
                      @endif
                      <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Manager</th>
                      <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                      <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Total</th>
                      <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                    <tr>
                       <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            #{{$order->id}}
                       </td>
                       <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                          {{$order->project->title}}
                        </div>
                      </td>
                      @if(!auth()->user()->is_customer())
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @if(!empty($order->customer_id))
                                <p class="mb-0 text-xs font-semibold leading-tight">{{$order->project->customer->user->name}}</p>
                            @endif
                        </td>
                      @endif
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @if(!empty($order->project->manager_id))
                                <p class="mb-0 text-xs font-semibold leading-tight">{{$order->project->manager->user->name}}</p>
                            @endif
                        </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="mb-0 text-xs font-semibold leading-tight">
                          <span class="text-xs bg-gradient-to-tl rounded px-2 {{$order->status->background_color}} {{$order->status->text_color}}">
                              {{$order->status->title}}
                          </span>
                        </p>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="mb-0 text-xs font-semibold leading-tight">{{number_format($order->project->total(), 2)}}€</p>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <a href="{{route('orders-view', $order)}}" class="mt-2 px-8 py-1 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500"> Open </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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
      /* Flexbox pour la mise en page de base */
     .container {     
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
     }

     .section {
         flex: 1;
         min-width: 300px; /* Largeur minimale pour les sections */
         padding: 10px;
         border: 1px solid #ccc;
     }

     /* Media queries pour les petits écrans */
     @media (max-width: 768px) {
       .section {
        flex: 1 1 100%; /* Prendre toute la largeur de l'écran sur les petits appareils */
      }
     }

    </style>
</x-app-layout>
