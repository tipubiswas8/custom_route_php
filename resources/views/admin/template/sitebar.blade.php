
@php
   $moduleRoute = []; 
@endphp

@if ($moduleRoute)
@php
   $moduleRoute = $moduleRoute; 
   @endphp
   @else
   @php
     $moduleRoute = (object) ['request_type' => 'get'] ;
   @endphp
@endif
{{-- Sitebar Start--}}
<div class="col-md-2" style="height: 800px; background-color: #dde39f">
    <div class="text-white" style="height: 100%">
        <a href="/">Dashboard</a>
        <br />
        {{-- Main module name and route --}}
        @if ($moduleRoute->request_type == 'get')
            @php $request_type = 'get' @endphp
        @else
            @php $request_type = 'post' @endphp
        @endif
        <form action="{{ url($moduleRoute->url ?? '#') }}" method="{{ $request_type }}"> 
            @method("$moduleRoute->request_type")
            @csrf
           <input class="mb-0 pb-0 mt-0 pt-0 btn btn-link" type="submit" value="{{ $module->name ?? '' }}">
        </form>
            @foreach ($mainMenus ?? [] as $mainMenu)
            {{-- Main menu name and route --}}
                @foreach ($mmRoute as $mmr)
                    @if ($mainMenu->id == $mmr->main_menu_id) 
                    @if ($mmr->request_type == 'get')
                    @php $request_type = 'get' @endphp
                @else
                    @php $request_type = 'post' @endphp
                @endif
                    <form  action="{{ url($mmr->url ?? '#') }}" method="{{ $request_type }}"> 
                        @method("$mmr->request_type")
                        @csrf
                    @endif
                @endforeach
                    <input class="mb-0 pb-0 mt-0 pt-0 btn btn-link ms-4" type="submit" value="{{ $mainMenu->name }}">
                    </form>
                
                @foreach ($sMenus as $sm)
                    @if ($mainMenu->id == $sm->parent_menu_id)
                    {{-- Sub menu name and route --}}
                        @foreach ($smRoute as $smr)
                            @if ($sm->id == $smr->sub_menu_id)
                            @if ($smr->request_type == 'get')
                            @php $request_type = 'get' @endphp
                        @else
                            @php $request_type = 'post' @endphp
                        @endif  
                                <form  action="{{ route($smr->name) }}" method="{{ $request_type }}"> 
                                    @method("$smr->request_type")
                                    @csrf
                            @endif
                        @endforeach
                                    <input  class="mb-0 pb-0 mt-0 pt-0 btn btn-link ms-5" type="submit" value="{{ $sm->name }}">
                                </form>
                    @endif
                @endforeach
            @endforeach
    </div>
</div>
{{-- Sitebar End--}}

{{-- Main Content Start   --}}
<div class="col-md-10">