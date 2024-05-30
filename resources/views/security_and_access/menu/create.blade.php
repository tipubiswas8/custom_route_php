@extends("security_and_access.admin.template.master")
@section('main-content')

    @if ($type == 1)
    <form action="{{ route('menu-create') }}" method="get">
        @csrf
        <div class="col-md-12">
            <div class="row" >
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="module">Parent Module: <span style="color: red">*</span></label>
                                <select id="module" name="id" class="form-control" @required(true)>
                                    <option value="">--Select module--</option>
                                    @foreach ($modules as $module)
                                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="menu_type">Menu Type: <span style="color: red">*</span></label>
                                <select id="menu_type" name="type" class="form-control" @required(true)>
                                    <option value="" selected>--Select menu type--</option>
                                    <option value="2">Main menu</option>
                                    <option value="3">Sub menu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
            </div>
        
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input id="submit" type="submit" class="form-control bg-primary mt-5 text-white" value="{{ $buttonStatus }}">
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </form>
    @endif

    @if ($type == 2)
    <form action="{{ route('menu-store') }}" method="post">
        @csrf
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Menu Name: <span style="color: red">*</span></label>
                            <input id="name" type="text" name="name" class="form-control" @required(true)>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="serial">Serial: <span style="color: red">*</span></label>
                            <input id="serial" type="number" name="serial" class="form-control" @required(true)>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="icon">Icon:</label>
                            <input id="icon" type="text" name="icon" class="form-control">
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
                </div>
            </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input id="submit" type="submit" class="form-control bg-primary mt-5 text-white" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </form>
    @endif

    @if ($type == 3)
    <form action="{{ route('menu-store') }}" method="post">
        @csrf
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="patent">Main Menu: <span style="color: red">*</span></label>
                            <select id="patent" name="parent_menu_id" class="form-control" @required(true)>
                                <option value="">--Select main menu--</option>
                                @foreach ($mainMenu as $mm)
                                    <option value="{{ $mm->id }}">{{ $mm->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Sub Menu Name: <span style="color: red">*</span></label>
                            <input id="name" type="text" name="name" class="form-control" @required(true)>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="serial">Serial: <span style="color: red">*</span></label>
                            <input id="serial" type="number" name="serial" class="form-control" @required(true)>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="icon">Icon:</label>
                            <input id="icon" type="text" name="icon" class="form-control">
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
                </div>
            </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input id="submit" type="submit" class="form-control bg-primary mt-5 text-white" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </form>
    @endif
    
@endsection
