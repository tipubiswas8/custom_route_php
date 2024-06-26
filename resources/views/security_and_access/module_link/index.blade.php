@extends("security_and_access.admin.template.master")
@section('main-content')

<h4 class="text-center mt-2">Module Link</h4>
<form action="">
    @csrf
    <div class="col-md-12 mb-3">
        <div class="row">
            <div class="col-md-3">
                <a class="w-100 text-white btn btn-success" href="{{ route('module-link-create') }}">Create</a>
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
        <div class="col-md-12">
            <div class="row">
                <th class="col-md-1">Sl</th>
                <!-- <th class="col-md-1">Category</th> -->
                <th class="col-md-2">Url</th>
                <th class="col-md-3">Controller</th>
                <th class="col-md-2">Method</th>
                <!-- <th class="col-md-2">Route Name</th> -->
                <!-- <th class="col-md-1">Request Type</th> -->
                <th class="col-md-1">Status</th>
                <th class="col-md-2">Action</th>
            </div>
        </div>
    </tr>

    <tbody>
        @if(isset($moduleLink))
        @foreach ($moduleLink as $index => $link)
        <tr>
            <div class="col-md-12">
                <div class="row">
                    <td class="col-md-1">{{ $index + 1 }}</td>
                    <!-- @if ($link->link_type == 1)
                    <td class="col-md-1">Module</td>
                    @elseif ($link->link_type == 2)
                    <td class="col-md-1">Main Menu</td>
                    @elseif ($link->link_type == 3)
                    <td class="col-md-1">Sub Menu</td>
                    @else
                    <td class="col-md-1">Other</td>
                    @endif -->
                    <td class="col-md-1">{{ Str::replaceFirst('/', '', $link->url) }}</td>
                    <td class="col-md-1">{{ $link->controller }}</td>
                    <td class="col-md-1">{{ $link->method }}</td>
                    <!-- <td class="col-md-1">{{ $link->name }}</td> -->
                    <!-- <td class="col-md-1">{{ $link->request_type }}</td> -->
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
        @else
        <p>No link found</p>
        @endif
    </tbody>
</table>
{{ $moduleLink->links() }}
@endsection