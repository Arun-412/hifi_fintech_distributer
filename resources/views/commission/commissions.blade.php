@extends('layouts.master')
@section('content')
<div class="text-center alert alert-success" style="display:none;"></div>
<div class="alert alert-danger" style="display:none;"></div>
@if(session('dataN'))
    <div class="text-center alert alert-success">New Retailer Created Successfully</div>
@endif
@if(session('failed'))
    <div class="alert alert-danger"> {{ session('failed') }}</div>
@endif
<br>
<a href="dashboard"><button type="button">Back</button></a><br> <br>
<form action="{{route('register_commission')}}" method="post">
@csrf
    <input type="text" value="{{ old('commission_plan_name') }}" name="commission_plan_name"  id="commission_plan_name" placeholder="Enter Commission Plan Name">
    @error('commission_plan_name')
    <span class="text-danger">{{$message}}</span>
    @enderror
    <input type="submit" value="Create Commission Plan">
</form><br>
<center><h3>Commission Plans</h3></center><br>
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
        @if(session('dataN'))
        @foreach (session('dataN') as $index => $v)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{$v->window_code}}</td>
                <td>{{$v->window_name}}</td>
                @if($v->window_status == 'HFY')
                <td>Activated</td>
                @else
                <td>Pending</td>
                @endif
                <td>
                    <button type="button">Deactivate</button>
                    <form action="services">
                        <input type="hidden" name="plan_code" value="{{$v->window_code}}">
                        <button type="button">View</button>
                    </form>
                    <button type="button">Delete</button>
                </td>
            </tr>
        @endforeach
        @else
        @foreach ($data as $index => $v)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{$v->window_code}}</td>
                <td>{{$v->window_name}}</td>
                @if($v->window_status == 'HFY')
                <td>Activated</td>
                @else
                <td>Pending</td>
                @endif
                <td>
                    <button type="button">Deactivate</button>
                    <form action="services">
                        <input type="hidden" name="plan_code" value="{{$v->window_code}}">
                        <button type="button">View</button>
                    </form>
                    <button type="button">Delete</button>
                </td>
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>

@endsection