@extends("security_and_access.admin.template.master")
@section('main-content')
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
<h4 class="text-center mt-2">Assign Middleware</h4>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6" style="border: 2px solid darkgray; padding: 5px;">
            <div class="row">
                <form action="{{ route('securityandaccess.add.route') }}" method="post">
                    @csrf
                    <div class="col-md-12 text-center fs-6 fw-bold">
                        <div class="form-group">
                            <label class="form-label" for="route">Routes: <span style="color: red">*</span></label>
                            <select id="route" name="route_id" class="form-control" @required(true)>
                                <option value="">--Select route--</option>
                                @foreach ($routes as $route)
                                <option value="{{ $route->id }}">{{ $route->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2 mt-1"><input type="submit" class="w-100 btn btn-primary" value="Add" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="col-md-6" style="border: 2px solid darkgray; padding: 5px;">
            <div class="row">
                <form action="{{ route('securityandaccess.add.route') }}" method="post">
                    @csrf
                    <div class="col-md-12 text-center fs-6 fw-bold">
                        <div class="form-group">
                            <label class="form-label" for="middleware">Middleware: <span
                                    style="color: red">*</span></label>
                            <select id="middleware" name="middleware_id" class="form-control" @required(true)>
                                <option value="">--Select middleware--</option>
                                @foreach ($middlewares as $middleware)
                                <option value="{{ $middleware->id }}">{{ $middleware->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-10"></div>
                            <input type="hidden" name="add_middleware" value="Yes">
                            <div class="col-md-2 mt-1"><input type="submit" class="w-100 btn btn-primary" value="Add" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <h5 class="mt-3 text-center">Route</h5>
            @foreach ($middlewareAssign ?? [] as $ma)
            <div class="col-md-12 mb-4">
                <!-- Adjusted to col-md-12 for full width within the column and added mb-4 for spacing -->
                <ol class="list-group">
                    <li class="list-group-item">
                        <div class="ms-2 me-auto">
                            <div class="col-md-12">
                                <div class="row align-items-center">
                                    <div class="fw-bold col-md-11">
                                        <p class="mb-0">{{ $ma->name }}</p>
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <!-- okkkkkkkkkkkk -->
                                        <form action="{{ route('securityandaccess.remove.route') }}" method="post"
                                            style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="link_id" value="{{ $ma->id }}">
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @php
                            $middName = explode(",", $ma->middlewares);
                            @endphp
                            <label class="ps-5 mt-0 form-label">Middleware:</label>
                            @foreach ($middName as $k => $mn)
                            @if($mn)
                            <div class="d-flex align-items-center ps-5">
                                <p class="mb-0">{{ $k + 1 }}. {{ $mn }}</p>
                                <form action="{{ route('securityandaccess.remove.middleware') }}" method="post"
                                    style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="ex_middleware" value="{{ $mn }}">
                                    <input type="hidden" name="route_id" value="{{ $ma->id }}">
                                    <button class="fs-8 btn btn-sm btn-danger ms-2">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                            @endif
                            @endforeach

                            <form action="{{ route('securityandaccess.add.middleware') }}" method="post" class="mt-3">
                                @csrf
                                <div class="d-flex ms-5 align-items-center">
                                    <select name="middleware_data" class="form-control w-75" required>
                                        <option value="">--Select middleware--</option>
                                        @foreach ($middlewares as $middleware)
                                        <option value="{{ $middleware->name }}/{{ $middleware->id }}">{{ $middleware->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="route_id" value="{{ $ma->id }}">
                                    <button class="btn btn-sm btn-primary ms-3">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </li>
                </ol>
            </div>
            @endforeach
        </div>

        <div class="col-md-6">
            <h5 class="mt-3 text-center">Middleware</h5>
            @foreach ($routeAssign ?? [] as $ra)
            <div class="col-md-12 mb-4">
                <!-- Adjusted to col-md-12 for full width within the column and added mb-4 for spacing -->
                <ol class="list-group">
                    <li class="list-group-item">
                        <div class="ms-2 me-auto">
                            <div class="col-md-12">
                                <div class="row align-items-center">
                                    <div class="fw-bold col-md-11">
                                        <p class="mb-0">{{ $ra->name }}</p>
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <!-- okkkkkkkkkkkkkk -->
                                        <form action="{{ route('securityandaccess.remove.route') }}" method="post"
                                            style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="midd_id" value="{{ $ra->id }}">
                                            <input type="hidden" name="remove_middleware" value="Yes">
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @php
                            $routeId = explode(",", $ra->route_id);
                            @endphp
                            <label class="ps-5 mt-0 form-label">Route:</label>
                            @foreach ($routeId as $k => $ri)
                            @if($ri)
                            @php
                            $routeName = \App\Models\SecurityAndAccess\ModuleLink::select('name')->where('id',
                            $ri)->get()[0]->name;
                            @endphp
                            <div class="d-flex align-items-center ps-5">
                                <p class="mb-0">{{ $k + 1 }}. {{ $routeName }}</p>
                                <form action="{{ route('securityandaccess.remove.middleware') }}" method="post"
                                    style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="ex_route" value="{{ $ri }}">
                                    <input type="hidden" name="middleware_id" value="{{ $ra->id }}">
                                    <input type="hidden" name="remove_middleware" value="y">
                                    <button class="fs-8 btn btn-sm btn-danger ms-2">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                            @endif
                            @endforeach

                            <form action="{{ route('securityandaccess.add.middleware') }}" method="post" class="mt-3">
                                @csrf
                                <div class="d-flex ms-5 align-items-center">
                                    <select name="route_id" class="form-control w-75" required>
                                        <option value="">--Select route--</option>
                                        @foreach ($routes as $route)
                                        <option value="{{ $route->id }}">{{ $route->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="middleware_id" value="{{ $ra->id }}">
                                    <input type="hidden" name="add_middleware" value="y">
                                    <button class="btn btn-sm btn-primary ms-3">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </li>
                </ol>
            </div>
            @endforeach
        </div>
    </div>
</div>


<div class="form-group">
    <div class="col-md-12 mt-4">
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-1 ms-0 ps-0 me-0 pe-0">
                <form action="{{ route('securityandaccess.assign') }}" method="post" style="display: inline;">
                    @csrf
                    @method('delete')
                    <input type="submit" class="form-control btn btn-info" value="Assign">
                </form>
            </div>
            <div class="col-md-1 ms-0 ps-0">
                <form action="{{ route('securityandaccess.assign') }}" method="post" style="display: inline;">
                    @csrf
                    @method('delete')
                    <input type="submit" class="form-control btn btn-secondary" value="Clear">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection