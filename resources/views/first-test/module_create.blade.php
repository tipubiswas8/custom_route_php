@extends("admin.template.master")
@section('main-content')
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

    <form action="{{ route('module-store') }}" method="post">
        @method('post')
        @csrf
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label" for="name">Module Name: <span class="text-danger">*</span></label>
                        <input id="name" type="text" name="name" class="form-control" @required(true)>
                    </div>
                </div>
                <div class="col-md-7"></div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label" for="serial">Serial: <span class="text-danger">*</span></label>
                        <input id="serial" type="text" name="serial" class="form-control" @required(true)>
                    </div>
                </div>
                <div class="col-md-7"></div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label" for="icon">Icon:</label>
                        <input id="icon" type="text" name="icon" class="form-control">
                    </div>
                </div>
                <div class="col-md-7"></div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label" for="status">Status:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-7"></div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input id="submit" type="submit" class="form-control bg-primary mt-5 text-white" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
