<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use View;

class RetailerController extends Controller
{
    public function Retailers(){
        try{
            $retailer = User::where(['door_opened_by'=>Auth::user()->door_code])->orderBy('id', 'DESC')->get();
            return view('Retailer.retailers')->with('data',$retailer);
        }
        catch(\Throwable $e){
            return back()->with("failed",$e->getmessage());
        }
    }

    public function New_Retailer(Request $request){
        try{
            $validate = Validator::make($request->all(), [
                'shop_name' => 'required|string|min:3|max:40',
                'mobile_number' => 'required|digits:10|numeric|unique:doors',
                'email' => 'required|email|max:40|unique:doors',
            ],);
            if($validate->fails()){
                return back()->withInput()->withErrors($validate);
            }else{
            $door_access = User::create([
                'door_code' => "HFR".Str::random(4)."D".Str::random(4),
                'shop_name' => $request->shop_name,
                'mobile_number' => $request->mobile_number,
                'mobile_otp' =>123456,
                'email' => $request->email,
                'password' => Hash::make($request->mobile_number),
                'kyc_status' => "HFN",
                'door_mode' => "HF00",
                'door_opened_by' => Auth::user()->door_code,
                'door_status' => "HFY",
                'door_key' => 0
            ]);
            if($door_access){
                $retailer = User::where(['door_opened_by'=>Auth::user()->door_code])->orderBy('id', 'DESC')->get();
                return redirect('retailers')->with('dataN',$retailer);
            }else{
                return back()->with("failed",'Unable to create retailer');
            }
            }
        }
        catch(\Throwable $e){
            return back()->with("failed",$e->getmessage());
        }
    }
}
