@php
use App\Http\Controllers\SecurityAndAccess\ModuleController;
$currentPath = request()->path();
$moduleAndMenus = new ModuleController;
$data = $moduleAndMenus->path($currentPath);

$module = $data['module'];
$moduleRoute = $data['moduleRoute'];
$mainMenus = $data['mainMenus'];
$mmRoute = $data['mmRoute'];
$sMenus = $data['sMenus'];
$smRoute = $data['smRoute'];
@endphp
<!-- {{-- Sitebar Start--}} -->
<div class="col-md-2" style="height: 800px; background-color: #dde39f">
    <div class="text-white" style="height: 100%">
        <i class="fa-solid fa-house"></i><a href="/">Dashboard</a>
        <br />
        <!-- {{-- Main module name and route --}} -->
        @if ($moduleRoute->request_type == 'get')
        @php $request_type = 'get' @endphp
        @else
        @php $request_type = 'post' @endphp
        @endif
        <form action="{{ url("$moduleRoute->prefix" . "$moduleRoute->url") }}" method="{{ $request_type }}">
            @method("$moduleRoute->request_type")
            @csrf
            <?= $module->icon ?? '<i class="fa-solid fa-image"></i>' ?><input style="margin-left: -10px"
                class="mb-0 pb-0 mt-0 pt-0 btn btn-link" type="submit" value="{{ $module->name }}">
        </form>
        @foreach ($mainMenus as $mainMenu)
        <!-- {{-- Main menu name and route --}} -->
        @foreach ($mmRoute as $mmr)
        @if ($mainMenu->id == $mmr->main_menu_id)
        @if ($mmr->request_type == 'get')
        @php $request_type = 'get' @endphp
        @else
        @php $request_type = 'post' @endphp
        @endif
        <form action="{{ url("$mmr->prefix" . "$mmr->url") }}" method="{{ $request_type }}">
            @method("$mmr->request_type")
            @csrf
            @endif
            @endforeach
            <i style="margin-left: 25px">
                <?= $mainMenu->icon ?? '<i class="fa-solid fa-image"></i>' ?><input style="margin-left: -10px"
                    class="mb-0 pb-0 mt-0 pt-0 btn btn-link" type="submit" value="{{ $mainMenu->name }}">
            </i>
        </form>
        @foreach ($sMenus as $sm)
        @if ($mainMenu->id == $sm->parent_menu_id)
        <!-- {{-- Sub menu name and route --}} -->
        @foreach ($smRoute as $smr)
        @if ($sm->id == $smr->sub_menu_id)
        @if ($smr->request_type == 'get')
        @php $request_type = 'get' @endphp
        @else
        @php $request_type = 'post' @endphp
        @endif
        <form action="{{ url("$smr->prefix" . "$smr->url") }}" method="{{ $request_type }}">
            @method("$smr->request_type")
            @csrf
            @endif
            @endforeach
            <i style="margin-left: 50px">
                <?= $sm->icon ?? '<i class="fa-solid fa-image"></i>' ?><input style="margin-left: -10px"
                    class="mb-0 pb-0 mt-0 pt-0 btn btn-link" type="submit" value="{{ $sm->name }}">
            </i>
        </form>
        @endif
        @endforeach
        @endforeach
    </div>
</div>
<!-- {{-- Sitebar End--}} -->

<!-- {{-- Main Content Start   --}} -->
<div class="col-md-10">