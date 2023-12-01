@extends('layouts.master')
@section('content')
@if(session('dataN'))
    <div class="text-center alert alert-success">New Retailer Created Successfully</div>
@endif
@if(session('failed'))
    <div class="alert alert-danger"> {{ session('failed') }}</div>
@endif
<a href="dashboard"><button type="button">Back</button></a>
<form action="register_retailer" method="post">
@csrf
    <input type="text" value="{{ old('shop_name') }}" name="shop_name"  id="shop_name" placeholder="Enter Shop Name">
    @error('shop_name')
    <span class="text-danger">{{$message}}</span>
    @enderror
    <input type="tel" value="{{ old('mobile_number') }}" name="mobile_number"  id="mobile_number" placeholder="Enter mobile number">
    @error('mobile_number')
    <span class="text-danger">{{$message}}</span>
    @enderror
    <input type="email" value="{{ old('email') }}" name="email" id="email" placeholder="enter email">
    @error('email')
    <span class="text-danger">{{$message}}</span>
    @enderror
    <input type="submit" value="Create User">
</form>

<table id="retailers_list" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>S.No</th>
                <th>User Code</th>
                <th>Shop Name</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>KYC Status</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
        @if(session('dataN'))
        @foreach (session('dataN') as $index => $v)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{$v->door_code}}</td>
                <td>{{$v->shop_name}}</td>
                <td>{{$v->mobile_number}}</td>
                <td>{{$v->email}}</td>
                @if($v->kyc_status == 'HFY')
                <td>Completed</td>
                @elseif($v->kyc_status == 'HFI')
                <td>Incomplete</td>
                @else
                <td>Pending</td>
                @endif
                <!-- <td><button type="button">Deactivate</button><button type="button">Edit</button><button type="button">Delete</button></td> -->
            </tr>
        @endforeach
        @else
        @foreach ($data as $index => $v)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{$v->door_code}}</td>
                <td>{{$v->shop_name}}</td>
                <td>{{$v->mobile_number}}</td>
                <td>{{$v->email}}</td>
                @if($v->kyc_status == 'HFY')
                <td>Completed</td>
                @elseif($v->kyc_status == 'HFI')
                <td>Incomplete</td>
                @else
                <td>Pending</td>
                @endif
                <!-- <td><button type="button">Deactivate</button><button type="button">Edit</button><button type="button">Delete</button></td> -->
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>

@endsection