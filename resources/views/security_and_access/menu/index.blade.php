@extends("security_and_access.admin.template.master")
@section('main-content')

<h4 class="text-center mt-2">Menu</h4>
<form action="">
    @csrf
    <div class="col-md-12 mb-3">
        <div class="row">
            <div class="col-md-3">
                <a class="w-100 btn btn-success" href="{{ route('menu-create') }}">Create</a>
            </div>
            <div class="col-md-5">
            </div>
            <div class="col-md-3 me-0 pe-0">
                <input type="search" name="query" class="form-control" required placeholder="Type here">
            </div>
            <div class="col-md-1 ms-0 ps-0">
                <input type="submit" class="form-control btn btn-primary" value="Search">
            </div>
        </div>
    </div>
</form>

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

<table class="table table-striped" style="width:100%">
    <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>Type</th>
        <th>Module Name</th>
        <th>Parent Main Menu</th>
        <th>Serial</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <tbody>
        @if(isset($allData))
        @foreach ($allData as $key => $menu)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $menu->name }}</td>
            @if ($menu->type == 2)
            <td>Main Menu</td>
            @else
            <td>Sub Menu</td>
            @endif
            <td>{{ $menu->module_name }}</td>
            <td>{{ $menu->parent_menu_name }}</td>
            <td>{{ $menu->serial }}</td>
            @if ($menu->active_status == 1)
            <td>
                <button class="btn btn-sm btn-success">Active</button>
            </td>
            @else
            <td>
                <button class="btn btn-sm btn-danger">Inactive</button>
            </td>
            @endif
            <td>
                <button class="btn btn-sm btn-warning">Edit</button>
                <button class="btn btn-sm btn-danger">Delete</button>
            </td>
        </tr>
        @endforeach
        @else
        <p>No menu found</p>
        @endif
    </tbody>
</table>
{{ $menus->links() }}
@endsection