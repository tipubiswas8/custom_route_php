@extends("security_and_access.home.template.master")
@section('main-content')

<style>
  .modules{
    height: 130px;
    text-align: center;
    background-color: burlywood;
    font-size: 20px;
    padding: 40px;
    margin: 22px;
  }
  </style>
  <div class="container-fluid"></div>
<div class="col-md-12">
  <div class="row">
      @foreach ($modules as $link)
          <a href="{{ url('module/path', $link->id) }}" class="col-md-2 modules">{{ $link->name }}</a>
      @endforeach
  </div>
</div>
@endsection
