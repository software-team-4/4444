<?php

namespace App\Http\Controllers;


use App\model\Facility;
use App\model\TrainerSession;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
    //search facility or session
    function showIndex()
    {
        $key = trim(Input::get('key'));

        $facdata = Facility::where('name', 'like', '%' . $key . '%')->get();
        $sessdata = TrainerSession::where('name', 'like', '%' . $key . '%')->get();
        return view('index', compact('facdata', 'sessdata'));
    }

}
