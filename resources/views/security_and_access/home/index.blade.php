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

  a {
    color: inherit; /* Set the color to inherit from the parent */
    text-decoration: none; /* Optionally remove underline */
}

a:hover {
    /* Optionally, you can define styles for when the link is hovered over */
    /* For example, you might want it to change color when hovered */
    color: whitesmoke;
}

  </style>
  <div class="container-fluid"></div>
<div class="col-md-12">
  <div class="row">
      @foreach ($modules as $link)
          <a href="{{ url('module/path', $link->id) }}" class="col-md-2 modules">{{ $link->name }}
          <div>
            <?= $link->icon ?? '<i class="fa-solid fa-image"></i>' ?>
          </div>  
          </a>
      @endforeach
  </div>
</div>
@endsection
