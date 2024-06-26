@extends("security_and_access.admin.template.master")
@section('main-content')
<h4 class="text-center mt-2">Module</h4>
<div class="col-md-12 mb-3">
    <form action="{{ route('middleware-search') }}">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <a class="w-100 text-white btn btn-success" href="{{ route('middleware-create') }}">Create</a>
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
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <tbody>
        @if(isset($middlewares))
        @foreach ($middlewares as $index => $middleware)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $middleware->name }}</td>
            <td>{{ $middleware->description }}</td>
            @if ($middleware->active_status == true)
            <td>
                <form class="d-inline" action="{{ route('module-status', $middleware->id) }}" method="post">
                    @method('put')
                    @csrf
                    <button class="btn btn-sm btn-success">Active</button>
                    <input type="hidden" name="status" value="false" />
                </form>
            </td>
            @else
            <td>
                <form class="d-inline" action="{{ route('module-status', $middleware->id) }}" method="post">
                    @method('put')
                    @csrf
                    <button class="btn btn-sm btn-danger">Inactive</button>
                    <input type="hidden" name="status" value="true" />
                </form>
            </td>
            @endif
            <td>
                <div class="d-inline">
                    <form class="d-inline" action="{{ route('module-edit', $middleware->id) }}">
                        <button class="btn btn-sm btn-warning" type="submit">Edit</button>
                    </form>
                    <form class="d-inline" action="{{ route('module-delete', $middleware->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <p>No middleware found</p>
        @endif
    </tbody>
</table>

@endsection