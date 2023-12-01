<?php

namespace App\Http\Controllers;
use App\Models\window;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CommissionController extends Controller
{
    public function commissions() {
        try{
            $retailer = window::where(['window_opened_by'=>Auth::user()->door_code])->orderBy('id', 'DESC')->get();
            return view('commission.commissions')->with('data',$retailer);
        }
        catch(\Throwable $e){
            return back()->with("failed",$e->getmessage());
        }
    }

    public function New_Commissions(Request $request){
        try{
            $validate = Validator::make($request->all(), [
                'commission_plan_name' => 'required|string|min:3|max:40',
            ],);
            if($validate->fails()){
                return back()->withInput()->withErrors($validate);
            }else{
                $window_access = window::create([
                    'window_code' => "HFD".Str::random(2)."CPD".Str::random(2),
                    'window_name' => $request->commission_plan_name,
                    'window_status' => "HFY",
                    'window_mode' => "HF11",
                    'window_opened_by' => Auth::user()->door_code,
                ]);
                if($window_access){
                    $window = window::where(['window_opened_by'=>Auth::user()->door_code])->orderBy('id', 'DESC')->get();
                    return redirect('commissions')->with('dataN',$window);
                }else{
                    return back()->with("failed",'Unable to create commission plan');
                }
            }
        }
        catch(\Throwable $e){
            return back()->with("failed",$e->getmessage());
        }
    }
}
