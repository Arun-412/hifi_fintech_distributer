@extends('layouts.master')
@section('content')
<a href="/retailers"><button type="button">Retailers</button></a>
<a href="/commissions"><button type="button">Commissions</button></a>
@if(session('failed'))
    <div class="alert alert-danger"> {{ session('failed') }}</div>
@endif
<h2>Welcome to HIFI FINTECH</h2>
<p>{{Auth::user()}}</p>

<form action="logout" method="post">
    @csrf
<button type="submit" value="Logout">Logout</button>
</form>
@endsection