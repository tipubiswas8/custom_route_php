@extends("admin.template.master")
@section('main-content')
<h4 class="text-center mt-2">Module</h4>
<a class="text-white col-md-3 btn btn-success mb-3" href="{{ route('module-create') }}">Create</a>
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
        <th>Serial</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <tbody>
        @foreach ($modules as $index => $module)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $module->name }}</td>
            @if ($module->type == 1)
            <td>Module</td>  
            @endif
            <td>{{ $module->serial }}</td>
            @if ($module->active_status == 1)
            <td>
                <form class="d-inline" action="{{ route('module-status', $module->id) }}" method="post">
                    @method('put')
                    @csrf
                <button class="btn btn-sm btn-success">Active</button>
                <input type="hidden" name="status" value="0" />
                </form>
            </td>
            @else
            <td>
                <form class="d-inline" action="{{ route('module-status', $module->id) }}" method="post">
                    @method('put')
                    @csrf
                 <button class="btn btn-sm btn-danger">Inactive</button>
                 <input type="hidden" name="status" value="1" />
                </form>
            </td>
            @endif
            <td>
              <div class="d-inline">
                <form class="d-inline" action="{{ route('module-edit', $module->id) }}">
                    <button class="btn btn-sm btn-warning" type="submit" >Edit</button>
                </form>
                <form class="d-inline" action="{{ route('module-delete', $module->id) }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
              </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $modules->links() }}
@endsection
