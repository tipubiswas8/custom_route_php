@extends("security_and_access.admin.template.master")
@section('main-content')
<h4>mm1 for account</h4>
<form action="{{ url('acc/acc/create') }}">
    <input type="text" name="token" value="">
    <input type="submit"  value="Check">
</form>
@endsection