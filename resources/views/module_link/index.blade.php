@extends("admin.template.master")
@section('main-content')

<a class="text-white col-md-3 btn btn-success" href="{{ route('module-link-create') }}">Create</a>

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
        <div class="col-md-12">
            <div class="row">
        <th class="col-md-1">Sl</th>
        <th class="col-md-1">Category</th>
        <th class="col-md-1">Url</th>
        <th class="col-md-1">Controller</th>
        <th class="col-md-1">Method</th>
        <th class="col-md-2">Name</th>
        <th class="col-md-1">Request Type</th>
        <th class="col-md-1">Status</th>
        <th class="col-md-2">Action</th>
    </div>
</div>
    </tr>

    <tbody>
        @foreach ($moduleLink as $index => $link)
        <tr>
            <div class="col-md-12">
                <div class="row">
            <td class="col-md-1">{{ $index + 1 }}</td>
            @if ($link->link_type == 1)
            <td class="col-md-1">Module</td>
            @elseif ($link->link_type == 2)
            <td class="col-md-1">Main Menu</td>
            @elseif ($link->link_type == 3)
            <td class="col-md-1">Sub Menu</td>
            @else
            <td class="col-md-1">Other</td>
            @endif
            <td class="col-md-1">{{ Str::replaceFirst('/', '', $link->url) }}</td>
            <td class="col-md-1">{{ $link->controller }}</td>
            <td class="col-md-1">{{ $link->method }}</td>
            <td class="col-md-1">{{ $link->name }}</td>
            <td class="col-md-1">{{ $link->request_type }}</td>
            @if ($link->active_status == 1)
            <td class="col-md-1">
                <button class="btn btn-sm btn-success">Active</button>
            </td>
            @else
            <td class="col-md-1">
                <button class="btn btn-sm btn-danger">Inactive</button>
            </td>
            @endif
            <td class="col-md-2">
                <button class="btn btn-sm btn-warning">Edit</button>
                <button class="btn btn-sm btn-danger">Delete</button>
            </td>
        </div>
            </div>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
