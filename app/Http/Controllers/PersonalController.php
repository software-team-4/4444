<?php

namespace App\Http\Controllers;

use App\model\Facility;
use App\model\TrainerSession;
use Illuminate\Support\Facades\Auth;


class PersonalController extends Controller
{
    //
    function show()
    {
        //dd(Auth::guard('user')->user()->type);
        $facdata = null;
        if (Auth::guard('user')->user()->type == '1') {
            $facdata = Facility::all();
            $sessdata = TrainerSession::all();
        }elseif (Auth::guard('user')->user()->type == '2'){
            $sessdata = TrainerSession::all();
        }
        return view('personal', compact('facdata','sessdata'));
    }


}
