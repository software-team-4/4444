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
            if(!$this->isCover($data,'update')){
                return redirect("/courses/update?id=$sessid")->withErrors(['updateError' => 'This time is occupied']);
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
        // 时间段是否被占用  false
        if (!$this->isCover($data)) {
            return redirect('/courses/add')->withErrors(['addError' => 'This time is occupied']);
        }
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

    //查询TrainerSession数据库中的date time 与post中的date time 进行比较 时间有重合返回false
    private function isCover($postdata, $updateoradd = 'add')
    {
        if ($updateoradd == 'update') {
            $sessions = TrainerSession::where(['facilityId' => $postdata['facilityid'], ['id' ,'!=', $postdata['id']]])->get();
        } else {
            $sessions = TrainerSession::where('facilityId', '=', $postdata['facilityid'])->get();
        }
        //  $sessions = TrainerSession::where('facilityId', '=', $postdata['facilityid'])->get();
        foreach ($sessions as $value) {
            $times = $value->time;
            $timeCompare = $this->getCompare($value->date, $times, $postdata['date'], $postdata['time']);
            if (!$timeCompare) {
                return false;
            }
        }
        return true;
    }

    //两个时间段 没有重合 返回true
    private function getCompare($date1, $time1, $date2, $time2)
    {
        list($start_date1, $end_date1) = explode(',', $date1);
        list($start_date2, $end_date2) = explode(',', $date2);
        //var_dump($date1, $time1, $date2, $time2) ; echo "<br/>";
        if (!$this->timeIsCover($start_date2, $end_date2, $start_date1, $end_date1)) {
            return true;
        }
        foreach (explode('|', $time1) as $value1) {
            $value1s = explode(',', $value1);
            $w1 = $value1s[0];
            foreach (explode('|', $time2) as $value2) {
                $value2s = explode(',', $value2);
                $w2 = $value2s[0];
                if ($w1 == $w2) {
                    if ($this->timeIsCover($value1s[1], $value1s[2], $value2s[1], $value2s[2])) {
                        return false;
                    }
                }
            }
        }
        return true;

    }

    //重合返回true
    private function timeIsCover($start_date1, $end_date1, $start_date2, $end_date2)
    {
        if (($start_date1 > $end_date2) || ($end_date1 < $start_date2)) {
            return false;
        }
        return true;
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
