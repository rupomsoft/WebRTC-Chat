<?php

namespace App\Http\Controllers;
use App\Models\ActiveUserModel;
use App\Models\JoinModel;
use DateTime;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    function Index(){
        return view('join');
    }

    function AddJoin(Request $request){
        $name=$request->input('name');
        $mobile=$request->input('mobile');
        $peer_id=$request->input('peer_id');
        $look_up_time=time();

        $userCount= JoinModel::where("mobile",$mobile)->count();
        if($userCount>0){
           $result=JoinModel::where('mobile', $mobile)->update([
               "mobile"=>$mobile,
               "peer_id"=>$peer_id,
               "look_up_time"=>$look_up_time,
           ]);
           return $result;
       }
        else{
           $result=JoinModel::insert([
               "name"=>$name,
               "mobile"=>$mobile,
               "peer_id"=>$peer_id,
               "look_up_time"=>$look_up_time,
           ]);
           return $result;
       }

    }


    function ActiveList(Request $request){

        $mobile=$request->mobile;
        $look_up_time=time();
        JoinModel::where('mobile', $mobile)->update(["look_up_time"=>$look_up_time]);


        $time = new DateTime();
        $time->modify('-40 seconds');
        $time30sAgo=$time->format('U');


        $result=ActiveUserModel::Where("look_up_time",">",$time30sAgo)->get();
        return  $result;
    }

    function CheckMobileNumberIsActive(Request $request){
        $mobile=$request->mobile;
        $time = new DateTime();
        $time->modify('-40 seconds');
        $time30sAgo=$time->format('U');
        $result=ActiveUserModel::Where("look_up_time",">",$time30sAgo)->Where("mobile","=", $mobile)->count();
        return  $result;
    }



}
