@extends("security_and_access.admin.template.master")
@section('main-content')

@if ($step ==1)
<div>
    <form action="{{ route('module-link-create') }}" method="get">
        @csrf
        <div class="col-md-12 border border-1">
            <div class="row">
                <h4 class="text-center pt-2 mt-2 pb-2 mb-3">Link for</h4>
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="form-radio">
                            <label for="module">Module: </label>
                            <input id="module" name="link_type" type="radio" value="1">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="form-radio">
                            <label for="main">Main Menu: </label>
                            <input id="main" name="link_type" type="radio" value="2">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="form-radio">
                            <label for="sub">Sub Menu: </label>
                            <input id="sub" name="link_type" type="radio" value="3">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="form-radio">
                            <label for="other">Other: </label>
                            <input id="other" name="link_type" type="radio" value="4">
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-3">
                    <label class="bg-primary text-center" for="next"></label>
                    <div class="form-group">
                        <input class="btn btn-sm btn-primary" id="next" type="submit" value="Next">
                        <input name="step" type="hidden" value="2">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endif


@if ($step == 2)
<div>
    <form action="{{ route('module-link-create') }}" method="get">
        @csrf
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="module_id">Parent Module: <span
                                class="text-danger">*</span></label>
                        <select id="module_id" name="module_id" class="form-control" @required(true)>
                            <option value="">--Select module--</option>
                            @foreach ($modules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input id="submit" type="submit" class="form-control bg-primary text-white" value="Next">
                        <input name="step" type="hidden" value="3">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </form>
</div>
@endif


@if ($step == 3)
<div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('module-link-store') }}" method="post">
        @method('post')
        @csrf
        <div class="col-md-12 border border-1">
            <div class="row">
                @if (empty($folder) && empty($existingController))
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="folder">Folder: <span class="text-danger">*</span></label>
                        <input id="folder" type="text" name="folder" class="form-control" placeholder="Ex: Payroll" @required(true) />
                    </div>
                </div>
                @endif
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="request_type">Type: <span class="text-danger">*</span></label>
                        <select id="request_type" name="request_type" class="form-control" @required(true)>
                            <option value="get" selected>GET</option>
                            <option value="post">POST</option>
                            <option value="put">PUT</option>
                            <option value="patch">PATCH</option>
                            <option value="delete">DELETE</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="url">Url: <span class="text-danger">*</span></label>
                        <input id="url" type="text" name="url" class="form-control" @required(true)
                            placeholder="Ex: payroll/report/salary/edit/{id}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="method">Method: <span class="text-danger">*</span></label>
                        <input id="method" type="text" name="method" class="form-control" @required(true)
                            placeholder="Ex: salaryEdit">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="permission">Permission: <span class="text-danger">*</span></label>
                        <select id="permission" name="permission" class="form-control" @required(true)>
                            <option value="">--Select Permission--</option>
                            @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->permission_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="status">Status:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="controller" class="form-label">Controller</label>
                                <input type="checkbox" checked name="controller" id="controller">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="model" class="form-label">Model</label>
                                <input type="checkbox" name="model" id="model">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="migration" class="form-label">Migration</label>
                                <input type="checkbox" name="migration" id="migration">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="seeder" class="form-label">Sedder</label>
                                <input type="checkbox" name="seeder" id="seeder">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="view" class="form-label">View</label>
                                <input type="checkbox" name="view" id="view">
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <input id="submit" type="submit" class="form-control bg-primary mt-5 text-white" value="Submit">
                        <input type="hidden" name="module_id" value="{{ $module_id }}">
                        <input type="hidden" name="link_type" value="1">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endif


@if ($step == 4)
<div>
    <form action="{{ route('module-link-create') }}" method="get">
        @csrf
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="module_id">Parent Module: <span
                                class="text-danger">*</span></label>
                        <select id="module_id" name="module_id" class="form-control" @required(true)>
                            <option value="">--Select module--</option>
                            @foreach ($modules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input id="submit" type="submit" class="form-control bg-primary text-white" value="Next">
                        <input name="step" type="hidden" value="5">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </form>
</div>
@endif

@if ($step == 5)
<div>
    <form action="{{ route('module-link-store') }}" method="post">
        @method('post')
        @csrf
        <div class="col-md-12 border border-1">
            <div class="row">
                @if (empty($folder) && empty($existingController))
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="folder">Folder: <span class="text-danger">*</span></label>
                        <input id="folder" type="text" name="folder" class="form-control" placeholder="Ex: Payroll" @required(true) />
                    </div>
                </div>
                @endif
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="main_menu">Main menu: <span class="text-danger">*</span></label>
                        <select id="main_menu" name="main_menu" class="form-control" @required(true)>
                            <option value="">--Select main menu--</option>
                            @foreach ($mainMenu as $mm)
                            <option value="{{ $mm->id }}">{{ $mm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="request_type">Type: <span class="text-danger">*</span></label>
                        <select id="request_type" name="request_type" class="form-control" @required(true)>
                            <option value="get" selected>GET</option>
                            <option value="post">POST</option>
                            <option value="put">PUT</option>
                            <option value="patch">PATCH</option>
                            <option value="delete">DELETE</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="url">Url: <span class="text-danger">*</span></label>
                        <input id="url" type="text" name="url" class="form-control" @required(true)>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="method">Method: <span class="text-danger">*</span></label>
                        <input id="method" type="text" name="method" class="form-control" @required(true)>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="permission">Permission: <span class="text-danger">*</span></label>
                        <select id="permission" name="permission" class="form-control" @required(true)>
                            <option value="">--Select Permission--</option>
                            @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->permission_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="status">Status:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="controller" class="form-label">Controller</label>
                                <input type="checkbox" checked name="controller" id="controller">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="model" class="form-label">Model</label>
                                <input type="checkbox" name="model" id="model">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="migration" class="form-label">Migration</label>
                                <input type="checkbox" name="migration" id="migration">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="seeder" class="form-label">Sedder</label>
                                <input type="checkbox" name="seeder" id="seeder">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="view" class="form-label">View</label>
                                <input type="checkbox" name="view" id="view">
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input id="submit" type="submit" class="form-control bg-primary mt-5 text-white" value="Submit">
                        <input type="hidden" name="module_id" value="{{ $module_id }}">
                        <input type="hidden" name="link_type" value="2">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endif

@if ($step == 6)
<div>
    <form action="{{ route('module-link-create') }}" method="get">
        @csrf
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="module_id">Parent Module: <span
                                class="text-danger">*</span></label>
                        <select id="module_id" name="module_id" class="form-control" @required(true)>
                            <option value="">--Select module--</option>
                            @foreach ($modules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input id="submit" type="submit" class="form-control bg-primary text-white" value="Next">
                        <input name="step" type="hidden" value="7">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </form>
</div>
@endif


@if ($step == 7)
<div>
    <form action="{{ route('module-link-create') }}" method="get">
        @csrf
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="main_menu">Main menu: <span class="text-danger">*</span></label>
                        <select id="main_menu" name="main_menu" class="form-control" @required(true)>
                            <option value="">--Select main menu--</option>
                            @foreach ($mainMenu as $mm)
                            <option value="{{ $mm->id }}">{{ $mm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input id="submit" type="submit" class="form-control bg-primary text-white" value="Next">
                        <input name="module_id" type="hidden" value="{{ $module_id }}">
                        <input name="step" type="hidden" value="8">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </form>
</div>
@endif


@if ($step == 8)
<div>
    <form action="{{ route('module-link-store') }}" method="post">
        @method('post')
        @csrf
        <div class="col-md-12 border border-1">
            <div class="row">
                @if (empty($folder) && empty($existingController))
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="folder">Folder: <span class="text-danger">*</span></label>
                        <input id="folder" type="text" name="folder" class="form-control" placeholder="Ex: Payroll" @required(true) />
                    </div>
                </div>
                @endif
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="sub_menu">Sub menu: <span class="text-danger">*</span></label>
                        <select id="sub_menu" name="sub_menu" class="form-control" @required(true)>
                            <option value="">--Select sub menu--</option>
                            @foreach ($subMenu as $sm)
                            <option value="{{ $sm->id }}">{{ $sm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="request_type">Type: <span class="text-danger">*</span></label>
                        <select id="request_type" name="request_type" class="form-control" @required(true)>
                            <option value="get" selected>GET</option>
                            <option value="post">POST</option>
                            <option value="put">PUT</option>
                            <option value="patch">PATCH</option>
                            <option value="delete">DELETE</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="url">Url: <span class="text-danger">*</span></label>
                        <input id="url" type="text" name="url" class="form-control" @required(true)>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="method">Method: <span class="text-danger">*</span></label>
                        <input id="method" type="text" name="method" class="form-control" @required(true)>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="permission">Permission: <span class="text-danger">*</span></label>
                        <select id="permission" name="permission" class="form-control" @required(true)>
                            <option value="">--Select Permission--</option>
                            @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->permission_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="status">Status:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="controller" class="form-label">Controller</label>
                                <input type="checkbox" checked name="controller" id="controller">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="model" class="form-label">Model</label>
                                <input type="checkbox" name="model" id="model">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="migration" class="form-label">Migration</label>
                                <input type="checkbox" name="migration" id="migration">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="seeder" class="form-label">Sedder</label>
                                <input type="checkbox" name="seeder" id="seeder">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="view" class="form-label">View</label>
                                <input type="checkbox" name="view" id="view">
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input id="submit" type="submit" class="form-control bg-primary mt-5 text-white" value="Submit">
                        <input type="hidden" name="module_id" value="{{ $module_id }}">
                        <input type="hidden" name="main_menu" value="{{ $main_menu }}">
                        <input type="hidden" name="link_type" value="3">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endif



@if ($step == 9)
<div>
    <form action="{{ route('module-link-create') }}" method="get">
        @csrf
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="module_id">Parent Module: </label>
                        <select id="module_id" name="module_id" class="form-control">
                            <option value="">--Select module--</option>
                            @foreach ($modules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input id="submit" type="submit" class="form-control bg-primary text-white" value="Next">
                        <input name="step" type="hidden" value="9">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </form>
</div>
@endif


@if ($step == 10)
<div>
    <form action="{{ route('module-link-store') }}" method="post">
        @method('post')
        @csrf
        <div class="col-md-12 border border-1">
            <div class="row">
                @if (empty($module_id))
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="folder">Folder: <span class="text-danger">*</span></label>
                        <input id="folder" type="text" name="folder" class="form-control" placeholder="Ex: Payroll" @required(true) />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="controller">Controller: <span
                                class="text-danger">*</span></label>
                        <input id="controller" type="text" name="controller" class="form-control" @required(true)
                            placeholder="Ex: Salary Controller" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="url">Url: <span class="text-danger">*</span></label>
                        <input id="url" type="text" name="url" class="form-control" @required(true)
                            placeholder="Ex: payroll/report/salary/edit/{id}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="model">Model: </label>
                        <input id="model" type="text" name="model" class="form-control"
                            placeholder="Ex: Salary" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="method">Method: <span class="text-danger">*</span></label>
                        <input id="method" type="text" name="method" class="form-control" @required(true)
                            placeholder="Ex: salaryEdit">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="migration">Migration: </label>
                        <input id="migration" type="text" name="migration" class="form-control"
                            placeholder="Ex: salarys table" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="request_type">Type: <span class="text-danger">*</span></label>
                        <select id="request_type" name="request_type" class="form-control" @required(true)>
                            <option value="get" selected>GET</option>
                            <option value="post">POST</option>
                            <option value="put">PUT</option>
                            <option value="patch">PATCH</option>
                            <option value="delete">DELETE</option>
                            <option value="get_and_post">GET & POST</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="seeder">Seedre: </label>
                        <input id="seeder" type="text" name="seeder" class="form-control"
                            placeholder="Ex: Salary Seedre" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="permission">Permission: <span class="text-danger">*</span></label>
                        <select id="permission" name="permission" class="form-control" @required(true)>
                            <option value="">--Select Permission--</option>
                            @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->permission_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="view">View: </label>
                        <input id="view" type="text" name="view" class="form-control" placeholder="Ex: salary" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="status">Status:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input id="submit" type="submit" class="form-control bg-primary mt-5 text-white" value="Submit">
                        <input type="hidden" name="module_id_for_other" value="x">
                        <input type="hidden" name="module_id" value="{{ $module_id }}">
                    </div>
                </div>
                @else
                @if (empty($folder) && empty($existingController))
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="folder">Folder: <span class="text-danger">*</span></label>
                        <input id="folder" type="text" name="folder" class="form-control" placeholder="Ex: Payroll" @required(true) />
                    </div>
                </div>
                @endif
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="name">Name: </label>
                        <input id="name" type="text" name="name" class="form-control"
                            placeholder="Name for controller, model, migration, seeder and view" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="url">Url: <span class="text-danger">*</span></label>
                        <input id="url" type="text" name="url" class="form-control" @required(true)
                            placeholder="Ex: payroll/report/salary/edit/{id}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="method">Method: <span class="text-danger">*</span></label>
                        <input id="method" type="text" name="method" class="form-control" @required(true)
                            placeholder="Ex: salaryEdit">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="request_type">Type: <span class="text-danger">*</span></label>
                        <select id="request_type" name="request_type" class="form-control" @required(true)>
                            <option value="get" selected>GET</option>
                            <option value="post">POST</option>
                            <option value="put">PUT</option>
                            <option value="patch">PATCH</option>
                            <option value="delete">DELETE</option>
                            <option value="get_and_post">GET & POST</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="permission">Permission: <span class="text-danger">*</span></label>
                        <select id="permission" name="permission" class="form-control" @required(true)>
                            <option value="">--Select Permission--</option>
                            @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->permission_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="status">Status:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="controller" class="form-label">Controller</label>
                                <input type="checkbox" checked name="controller" id="controller">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="model" class="form-label">Model</label>
                                <input type="checkbox" name="model" id="model">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="migration" class="form-label">Migration</label>
                                <input type="checkbox" name="migration" id="migration">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="seeder" class="form-label">Sedder</label>
                                <input type="checkbox" name="seeder" id="seeder">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="view" class="form-label">View</label>
                                <input type="checkbox" name="view" id="view">
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input id="submit" type="submit" class="form-control bg-primary mt-5 text-white" value="Submit">
                        <input type="hidden" name="module_id_for_other" value="x">
                        <input type="hidden" name="module_id" value="{{ $module_id }}">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </form>
</div>
@endif
@endsection