<?php

namespace App\Http\Controllers;

use App\model\Facility;
use App\model\TrainerSession;
use App\model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SessionController extends Controller
{
    function index()
    {
        $sessdata = TrainerSession::all();
        return view('courses', compact('sessdata'));
    }

    function show()
    {
        list($facdata, $userdata) = $this->getFacUserData();
        return view('course-add', compact('facdata', 'userdata'));
    }

    function update(Request $request)
    {
        $sessid = Input::get('id');
        if ($request->method() == 'POST') {

            $data = Input::all();
            $sessdata = new TrainerSession();
            if ($request->hasFile('imagepath')) {
                $itm = $sessdata->where('id', '=', $sessid)->get()[0];
                $imgpath = $itm->imagepath;
                unlink($imgpath);
                $data['imagepath'] = $this->savaImage($request);
            }
            unset($data['_token']);
            unset($data['id']);
            if ($sessdata->where('id', '=', $sessid)->update($data)) {
                return redirect("/courses/update?id=$sessid")->withErrors(['update' => 'success']);
            } else {
                return redirect("/courses/update?id=$sessid")->withErrors(['updateError' => 'failed update']);
            }

        } else {
            $sessdata = TrainerSession::find($sessid);
            list($facdata, $userdata) = $this->getFacUserData();
            //dd($sessdata->toArray());
            return view('course-add', compact('sessdata', 'facdata', 'userdata'));
            //   dd($sessdata);
        }
    }

    private function getFacUserData()
    {
        $fac = new Facility();
        $facdata = $fac->select(['id', 'name'])->get();
        $user = new User();
        $userdata = $user->select(['id', 'name'])->where('type', '=', '2')->get();
        return [$facdata, $userdata];
    }

    function showDetail()
    {
        $sessid = Input::get('id');
        //  $sessdata = DB::table('facilitybookings')->where('id', '=', $sessid)->get()[0];
        $sessdata = null;
        foreach (TrainerSession::get() as $item => $value) {
            if ($value->id == $sessid) {
                // dd($value->user->toArray());
                $sessdata = $value;
                break;
            }
        }
        return view('course-detail', compact('sessdata'));
    }

    function add(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required|unique:trainersession',
            'discription' => 'required',
            'price' => 'required',
            'priceForStudent' => 'required',
            'priceForStaff' => 'required',
            'trainerid' => 'required',
            'facilityid' => 'required',
            'date' => 'required',
            'imagepath' => 'required',
            'time' => 'required'
        ]);
        $data = $request->all();
        $this->myvalidate($data);
        $data['imagepath'] = $this->savaImage($request);
        //dd($data);
        if (TrainerSession::create($data)) {
            return redirect('/courses/add')->withErrors(['add' => 'success']);
        } else {
            return redirect('/courses/add')->withErrors(['addError' => 'failed add']);
        }
    }

    function dele()
    {
        $sessid = Input::get('id');
        $sess = TrainerSession::find($sessid);
        echo $sess->delete();
    }

    private function myvalidate($postdata)
    {
        $dates = explode(',', $postdata['date']);
        $times = explode('|', $postdata['time']);
        if (count($dates) || count($times)) {
            return redirect('/courses/add')->withErrors(['addError' => 'Please fill in the date and time']);
        }
    }

    private function savaImage($request)
    {
        $imgname = null;
        if ($request->hasFile('imagepath')) {
            $file = $request->file('imagepath');
            $imgname = '' . time() . $file->getClientOriginalName();
            $file->move('./img/', $imgname);
        }
        return $imgname ? './img/' . $imgname : '';
    }
}
