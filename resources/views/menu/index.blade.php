@extends("admin.template.master")
@section('main-content')

<button class="col-md-3 bg-success">
    <a class="text-right text-white" href="{{ route('menu-create') }}">Create</a>
</button>

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
        <th>name</th>
        <th>Type</th>
        <th>Module</th>
        <th>Main Menu</th>
        <th>Serial</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <tbody>
        @foreach ($menus as $key => $menu)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $menu->name }}</td>
                @if ($menu->type == 2)
                <td>Main Menu</td>  
                @else
                <td>Sub Menu</td>  
                @endif
                <td>{{ $modules[$key] }}</td>
                <td></td>
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
    </tbody>
</table>
@endsection
