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

        JoinModel::insert([
            "name"=>
        ])
    }
}
