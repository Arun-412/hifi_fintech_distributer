@extends('layouts.master')
@section('content')
<div class="text-center alert alert-success" style="display:none;"></div>
<div class="alert alert-danger" style="display:none;"></div>
@if(session('dataN'))
    <div class="text-center alert alert-success">New Service Created Successfully</div>
@endif
@if(session('failed'))
    <div class="alert alert-danger"> {{ session('failed') }}</div>
@endif
<br>
<a href="commissions"><button type="button">Back</button></a><br> <br>
<form action="{{route('register_services')}}" method="post">
@csrf
<input type="hidden" name="commission_plan" value="{{$a['plan_code']}}">

   
    <input type="text" value="{{ old('service_plan_name') }}" name="service_plan_name"  id="service_plan_name" placeholder="Enter Service Plan Name">
    @error('service_plan_name')
    <span class="text-danger">{{$message}}</span>
    @enderror
    <input type="submit" value="Create Service Plan">
</form><br>

<center><h3>Service Plans</h3></center><br>
<table id="commission_list" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Code</th>
                <th>Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <!-- @if(session('dataN'))
        @foreach ($dataN['amities'] as $index => $v)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{$v->amiti_code}}</td>
                <td>{{$v->amiti_name}}</td>
                @if($v->amiti_status == 'HFY')
                <td>Activated</td>
                @else
                <td>Pending</td>
                @endif
                <td>
                    <button type="button">Deactivate</button>
                    <form action="services">
                        <input type="hidden" name="plan_code" value="{{$v->amiti_code}}">
                        <button type="button">View</button>
                    </form>
                    <button type="button">Delete</button>
                </td>
            </tr>
        @endforeach -->
        <!-- @elseif(session('data')) -->
        
         @foreach ($a['services'] as $index)
            <tr>
                <td>{{$index}}</td>
            <!-- <td>{{$index+1}}</td> -->
                <td>{{$v->amiti_code}}</td>
                <td>{{$v->amiti_name}}</td>
                @if($v->amiti_status == 'HFY')
                <td>Activated</td>
                @else
                <td>Pending</td>
                @endif
                <td>
                    <button type="button">Deactivate</button>
                    <form action="services">
                        <input type="hidden" name="plan_code" value="{{$v->amiti_code}}">
                        <button type="button">View</button>
                    </form>
                    <button type="button">Delete</button>
                </td>
            </tr>
        @endforeach
        <!-- @endif -->
        </tbody>
    </table>

@endsection