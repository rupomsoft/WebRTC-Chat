<?php

namespace App\Http\Controllers;

use App\Models\JoinModel;
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
        $result=JoinModel::insert([
            "name"=>$name,
            "mobile"=>$mobile,
            "peer_id"=>$peer_id,
            "look_up_time"=>$look_up_time,
        ]);
        return $result;
    }
}
