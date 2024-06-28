<x-app-layout>
  <x-slot name="header">
    {{ __('Projects') }}
  </x-slot>

  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
/* Style pour le select */
select[name="manager_id"] {
    width: 70%;
    padding: 5px 11px;
    margin: 4px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
    font-size: 12px;
    
}

/* Style pour le bouton */
button#saveButton {
    background-color: #4CAF50; /* Vert */
    border: none;
    color: white;
    padding: 3px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 11px;
    margin: 4px 0;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-left: 1px;
}

button#saveButton:hover {
    background-color: #45a049; /* Vert foncé */
}

/* Style pour le paragraphe */
p#projectId {
    font-size: 7px;
    font-weight: bold;
    color: #555;
}


</style>


  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div
        class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 flex pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <div class="flex items-center">
            <a href="{{ route('projects') }}" class="btn btn-primary mr-2">
              <i class="fas fa-sync-alt"></i>
            </a>
            <h6 class="mb-0">Projects</h6>
             
              
             
          </div>
          


          @if(auth()->user()->is_admin())
        <!-- <div class="w-90 ml-auto">
        <form action="{{route('projects')}}" method="GET" class="flex">
          <input
          class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow mr-2"
          type="text" placeholder="Search projects with code " value="@if(isset($_GET['search'])){{$_GET['search']}}@endif"
          name="search">
          <button><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
            <path
            d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
          </svg></button>
        </form>
        </div> -->
      @endif
          @if(auth()->user()->is_customer())
        <a class="ml-auto inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25"
        href="{{route('project-create')}}"> <i class="fas fa-plus" aria-hidden="true"> </i>&nbsp;&nbsp;Add New
        Project</a>
      @endif
        </div>
        <div class="flex-auto px-2 pt-0 pb-2">
          <div class="p-0 overflow-x-auto">
            <table id="datatable" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
              <thead class="align-bottom">
                <tr>
                  <th 
                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="width: 5%;" >
                    Id</th>
                  <th
                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                    Code</th>
                  <th
                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                    Title</th>
                  @if(!auth()->user()->is_customer())
            <th
            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
            Customer</th>
          @endif
                  @if(!auth()->user()->is_manager())
                  <th
                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                    Manager</th>
                  @endif  
                  <th
                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                    <select id="orderFilter" class="form-select">
                      <option value="">Tout Statuts</option>
                      <option value="Ordered">Ordered</option>
                      <option value="In Progress">In Progress</option>
                    </select>
                  </th>
                    @if(auth()->user()->is_manager())
                    <th
                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                    Statut </th>
                    @endif
                   
                    <th
                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                    Date création projet</th>
                    @if(!auth()->user()->is_customer())
                     <th
                      class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                      Date dernier message client
                     </th>
                    @endif
                

                  <th
                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                    Total</th>
                  <th
                    class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                  </th>
                </tr>
              </thead>
              <tbody>
                @php
          $free_project_count = 0;
          
        @endphp
                @foreach($projects as $project)
                <tr>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <div >
                    @if(auth()->user()->is_manager() && $project->is_read_manager == false)
            <div class="unread mr-2"></div>
          @endif
                    @if(auth()->user()->is_customer() && $project->is_read_customer == false)
            <div class="unread mr-2"></div>
          @endif
                    <p class="mb-0 text-xs font-semibold leading-tight" >#{{$project->id}}</p>
                  </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <div class="flex px-2 py-1">
                   @if(!empty($project->uid))
                    <p class="mb-0 text-xs font-semibold leading-tight">{{$project->uid}}</p>
                   @else
                     <p>...</p>

                   @endif 

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
            @if(empty($project->customer_id))
        <p class="mb-0 text-xs font-semibold leading-tight">No Data</p>
      @endif
            </td>
          @endif
          @if(!auth()->user()->is_manager() && !auth()->user()->is_customer())
            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                @if(!empty($project->manager_id))
                <div class="inline-container">
                    <select name="manager_id" id="manager_id" onchange="showSaveButton(this)">
                        @foreach($managers as $proj)

                            <option value="{{$proj->id}}" @if($proj->id == $project->manager_id) selected @endif>
                                {{$proj->user->name}}
                            </option>
                            
                        @endforeach
                    </select>
  
                    <button id="saveButton" style="display: none;"  data-project-id="{{$project->id}}" onclick="saveManager(this)">Save</button>
                    <p class="mb-0 text-xs font-semibold leading-tight" id="projectId" style="display: none;">{{$project->id}}</p>
                </div>   

                @elseif(empty($project->manager_id))
                    <select name="manager_id" id="manager_id" onchange="showSaveButton(this)">
                      <option value="" disabled selected>Choisir un designer</option>
                        @foreach($managers as $proj)
                           
                            

                            <option value="{{$proj->id}}" >
                                {{$proj->user->name}}
                            </option>

                        @endforeach
                    </select>
                    <button id="saveButton" style="display: none;" data-project-id="{{$project->id}}" onclick="saveManager(this)">Save</button>
                    <p class="mb-0 text-xs font-semibold leading-tight" id="projectId" style="display: none;">{{$project->id}}</p>

                
                
                @endif
            </td>

          @elseif(!auth()->user()->is_manager())

            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent" style="font-size: 15px; font-weight: bold;">{{ optional(optional($project->manager)->user)->name ?? '...' }}</td>
          

          @endif 






                  @if(auth()->user()->is_manager())
              <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
        @if(empty($project->manager_id) )

        <!-- à revoir si on a besoin  && $free_project_count == 0 && auth()->user()->manager->canTake() -->
            @php
          $free_project_count++;
           @endphp
            <a class="mt-2 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500"
            href="{{route('projects-take', $project)}}">Take this project</a>
        @endif
              @if($project->manager_id == auth()->user()->manager->id)
          <p class="mb-0 text-xs font-semibold leading-tight">My project</p>
        @endif
              </td>
          @endif
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
      @if($project->is_ordered)
            <p class="mb-0 text-xs font-semibold leading-tight">
            <span
            class="px-2 text-xs rounded text-white bg-gradient-to-tl from-green-600 to-lime-400">Ordered</span>
            </p>
        @else
            <p class="mb-0 text-xs font-semibold leading-tight">
             <span class="px-2 text-xs rounded text-white bg-gradient-to-tl from-blue-600 to-slate-300">In
               progress</span>
            </p>
      @endif
         
                  </td>

                  
                          
                  @php                  
                        $projectmessages = $projectmessages[$project->customer_id] ?? collect(); // Assurez-vous que $projectmessages est défini pour éviter les erreurs
                  @endphp

                    @php
                        $projectMessage = $allprojectmessages->where('project_id', $project->id)->first();
                    @endphp

                  
                 
<td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
    @if (!auth()->user()->is_customer())
        @if ($projectMessage)
            @if ($projectMessage->created_at->diffInDays(now()) > $options->deadline)
                style="background-color: #8B0000; color: white"
            @endif
        @else
            @if ($project->created_at->diffInDays(now()) > $options->deadline)
                style="background-color: #8B0000; color: white"
            @endif
        @endif
    @endif
>
    <p class="mb-0 text-xs font-semibold leading-tight">{{ $project->created_at->format('d/m/Y') }}</p>
</td> 
                  
                  <!-- @if(!auth()->user()->is_customer())
                     <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent" >
                      @if(!$projectmessages->isEmpty() )
                        <p class="mb-0 text-xs font-semibold leading-tight">{{$projectmessages->first()->created_at}}</p>
                      @else
                        <p>....</p>
                   
                      @endif 
                     </td>
                  @endif  -->
                 <!-- @if(!auth()->user()->is_customer())
                 <td>test
                  
                 {{$allprojectmessages->first()}} where  project_id = {{$project->id}}  

                 </td>

                 @endif   -->

                 @if (!auth()->user()->is_customer())
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    

                    @if ($projectMessage)
                        <p class="mb-0 text-xs font-semibold leading-tight">{{ $projectMessage->created_at }}</p> {{-- Par exemple, affichez le contenu du message --}}
                    @else
                        <p>....</p>
                    @endif
                  </td>
                 @endif
                  
                  
                  

                



                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                   <p class="mb-0 text-xs font-semibold leading-tight total-value" id="TotalValue" >{{number_format($project->total(), 2)}}€</p>
                  </td>
                  <td class="p-2 align-middle text-right bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <a href="{{route('projects-view', $project)}}"
                    class="mt-2 px-8 py-1 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500">
                    Open </a>
                  @if(auth()->user()->is_admin())
            <form class="inline ml-2" action="{{route('projects-delete', $project)}}" method="post"
            onsubmit="return confirm('Do you really want to delete this record?');">
            @method('delete')
            @csrf()
            <button class="text-xs font-semibold leading-tight text-red-500"> Delete </button>
            </form>
          @endif
                  </td>
                </tr>
        @endforeach
              </tbody>


            @if(!auth()->user()->is_customer())
              <tfoot>
                  <tr>
                      <td>.</td>
                      <td ></td>
                      <td ></td>
                      <td ></td>
                      <td ></td>
                      <td ></td>
                      <td ></td>
                      
                      <td ></td>
                      <td  id="totalCell" ></td>
                      <td></td>
                  </tr>
              </tfoot>
            @endif 
              
            </table>
            <div class="p-6">
              {{$projects->appends(request()->input())->links('vendor.pagination.tailwind')}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <button onclick="getValue()">test</button> -->
  <style>

    .inline-container {
      display: flex;
      align-items: center;
    }
    .unread {
      width: 10px;
      height: 10px;
      border-radius: 10px;
      background-color: #ff0080;
    }

    .save-button {
    display: none;
    padding: 5px 10px;
    font-size: 12px;
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    border-radius: 3px;
    cursor: pointer;
    }

   .save-button:hover {
    background-color: #45a049;
    }

   .manager-select {
    padding: 5px 10px;
    font-size: 12px;
    border: 1px solid #ccc;
    border-radius: 3px;
    }

   .manager-select:focus {
    outline: none;
    border-color: #4CAF50; /* Green */
  }

  </style>

<script>




function showSaveButton(selectElement) {
    var saveButton = selectElement.nextElementSibling;
    saveButton.style.display = 'block';
}

function saveManager(buttonElement) {
        var selectElement = buttonElement.previousElementSibling;
        var projectId = buttonElement.dataset.projectId;
        var managerId = selectElement.value;
        // Envoyer la requête AJAX
        $.ajax({
            type: 'POST',
            url: 'projects/update-manager',
            data: {
                project_id: projectId,
                manager_id: managerId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Gérer la réponse de succès ici
                console.log(response);
                Swal.fire({
                title: 'Success!',
                text: 'le designer a été mis à jour avec succès .',
                icon: 'success',
                position: 'center',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    popup: 'small-swal-popup'
                }
              });
            },
            error: function(xhr, status, error) {
                // Gérer les erreurs ici
                console.error(xhr.responseText);
                Swal.fire({
                title: 'Error!',
                text: 'Une erreur s est produite lors de la mise à jour du chef de projet.',
                icon: 'error',
                position: 'center', // Afficher au centre de la page
                showConfirmButton: false,
                timer: 1500
             });
            }
        });
    }

    function getValue() {
            // Sélectionne tous les éléments avec la classe 'total-value'
            var elements = document.querySelectorAll(".total-value");
            var totals = [];
            
            // Parcourt chaque élément et extrait le texte
            elements.forEach(function(element) {
                var textValue = element.textContent || element.innerText;
                // Enlève le symbole de l'euro et convertit en nombre flottant
                var numericValue = parseFloat(textValue.replace('€', '').replace(',', ''));
                totals.push(numericValue);
            });

            // Calcule la somme de tous les totaux
            var totalSum = totals.reduce(function(acc, curr) {
                return acc + curr;
            }, 0);

            // Affiche la somme totale dans la console
            console.log("Total des totaux: " + totalSum.toFixed(2) + "€");

            // Affiche la somme totale dans un élément HTML
            
            var totalCell = document.getElementById("totalCell");
            if (totalCell) {
                totalCell.textContent = totalSum.toFixed(2) + "€";
            }
            console.log(totalSum);

          }
    
getValue()
</script>


</x-app-layout>