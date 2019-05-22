<?php

namespace App\Http\Controllers;

use App\model\BlockedPeriod;
use App\model\Facility;
use App\model\FacilityBooking;
use App\model\TrainerSession;
use App\model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

//use App\model\Facility;

class FacilitiesController extends Controller
{
    //设备添加
    function add(Request $request)
    {

        if ($request->method() == 'POST') {
            $data = Input::all();
            $this->validate($request, [
                'name' => 'required',
                'imagepath' => 'required',
                'discription' => 'required',
                'price' => 'required',
                'priceForStudent' => 'required',
                'priceForStaff' => 'required',
                'location' => 'required',
                'maximumCapacity' => 'required',
                'start_date' => 'required',
                'end_date' => 'required|after:start_date'
            ]);
            //是否同一天
            if (!$this->checkDate($data['start_date'], $data['end_date'])) {
                return redirect('/facilities/add')->withErrors(['addError' => 'failed add. Must be on the same day']);
            }
            $data['imagepath'] = $this->savaImage($request);
            if (Facility::create($data)) {
                return redirect('/facilities/add')->withErrors(['add' => 'success']);
            } else {
                return redirect('/facilities/add')->withErrors(['addError' => 'failed add']);
            }
        } else {
            return view('facility-add');
        }

    }

    //展示 /facilities 页面
    function show()
    {
        $data = Facility::all();
        return view('facilities', compact('data'));
    }

    // 展示 /facilities/detail
    function detail()
    {
        $id = Input::get('id');
        $fac = new Facility();
        $data = $fac->where('id', '=', $id)->get()[0];
        // 设备是否停止预约
        $data['status'] = $this->isStopBooking($id) ? '0' : '1';
        // dd($data);
        $data['sbdstart_date'] = '';
        $data['sbdend_date'] = '';
        $bp = new BlockedPeriod();
        $bpdata = $bp->where('facilityid', '=', $id)->get();
        if (count($bpdata)) {
            $data['sbdstart_date'] = $bpdata[0]->start_date;
            $data['sbdend_date'] = $bpdata[0]->end_date;
        }

        return view('facility-detail', compact('data'));
    }

    // 设备信息修改
    function update(Request $request)
    {

        $id = Input::get('id');
        // 如果post请求 修改操作
        if ($request->method() == 'POST') {
            $data = Input::all();
            $fac = new Facility();
            if ($request->hasFile('imagepath')) {
                $itm = $fac->where('id', '=', $id)->get()[0];
                $imgpath = $itm->imagepath;
                unlink($imgpath);
                $data['imagepath'] = $this->savaImage($request);
            }
            unset($data['_token']);
            unset($data['id']);
            if ($fac->where('id', '=', $id)->update($data)) {
                return redirect("/facilities/update?id=$id")->withErrors(['update' => 'success']);
            } else {
                return redirect("/facilities/update?id=$id")->withErrors(['updateError' => 'failed update']);
            }
        } else {
            // 展示修改页面
            $fac = new Facility();
            $data = $fac->where('id', '=', $id)->get()[0];
            return view('facility-add', compact('data'));
        }
    }

    // 设备预定修改
    function updatebookingFacili(Request $request)
    {
        $postdata = Input::all();
        $facid = $this->getfacid($postdata['id']);
        //dd($facid);

        if ($postdata['end_date'] <= $postdata['start_date']) {
            return 'The end date must be a date after start date';
        }
        $isSameDay = $this->isSameDay($postdata);
        if (!$isSameDay) { //必须同一天
            return ' error Must be the same day';
        }
        if ($this->isStopBooking($facid)) { //是否停止预定
            return 'error unavailable for booking';
        }
        //是否在规定范围
        if ($this->isNotIntime($facid, $postdata)) {
            // 课程是否已被预订
            if (!$this->checkSession($facid, $postdata)) {
                return 'error This period has been booked by the course';
            }
            //人数是否满额
            if (!$this->isOverbooked($facid, $postdata, 'update')) {
                $idoremail = $postdata['unregisteredemail'];
                //用户是否已预定过
                if (!$this->checkUserBooking($idoremail, $facid, $postdata['start_date'], $postdata['end_date'], 'update')) {
                    return 'error You have booked the current time period';
                }
                if (FacilityBooking::find($postdata['id'])->update(['start_date' => $postdata['start_date'], 'end_date' => $postdata['end_date']])) {
                    return '1';
                } else {
                    return 'failed update';
                }
            } else {
                return 'error overbooked';
            }
        } else {
            return 'error Not in the specified time period';

        }
    }

    private function getfacid($id)
    {

        return FacilityBooking::find($id)->facilityId;
    }

    //预定设备
    function bookingFacili(Request $request)
    {
        $postdata = Input::all();
        $facid = $postdata['facilityid'];
        //   dd($postdata);
        $url = '/facilities/booking?id=' . $facid;
        $this->validate($request, [
            'start_date' => 'required',
            'bookinguserid' => 'required',
            'facilityid' => 'required',
            'uname' => 'required',
            'price' => 'required',
            'unregisteredemail' => 'required',
            'end_date' => 'required|after:start_date'
        ]);
        $isSameDay = $this->isSameDay($postdata);
        if (!$isSameDay) {//必须同一天
            return redirect($url)->withErrors(['addError' => 'Must be the same day']);
        }

        if ($this->isStopBooking($facid)) {//是否停止预定
            return redirect($url)->withErrors(['addError' => ' unavailable for booking']);
        }

        if ($this->isNotIntime($facid, $postdata)) {  //是否在规定时间范围
            if (!$this->isOverbooked($facid, $postdata)) { //人数是否满额
                if (!$this->checkSession($facid, $postdata)) { // 设备 是否被课程预订
                    return redirect($url)->withErrors(['addError' => 'This period has been booked by the course']);
                }
                $idoremail = $postdata['unregisteredemail'];
                if (!empty($postdata['userid'])) {
                    $idoremail = $postdata['userid'];
                }
                //用户是否已预定过
                if (!$this->checkUserBooking($idoremail, $facid, $postdata['start_date'], $postdata['end_date'])) {
                    return redirect($url)->withErrors(['addError' => 'You have booked the current time period']);
                }
                $inputdata = Input::all();
                unset($inputdata['price']);
                unset($inputdata['uname']);
                $inputdata['title'] = $inputdata['title'] ? $inputdata['title'] : '';
                //判断是否添加预订成功
                if (FacilityBooking::create($inputdata)) {
                    $emailerrmsg = $this->sendEmail($postdata);
                    if (!count($emailerrmsg)) {
                        return redirect($url)->withErrors(['succeed' => 'Email has been sent']);
                    } else {
                        return redirect($url)->withErrors($emailerrmsg);
                    }

                } else {
                    return redirect($url)->withErrors(['addError' => 'failed add ']);
                }
            } else {
                return redirect($url)->withErrors(['addError' => 'error overbooked ']);
            }
        } else {
            return redirect($url)->withErrors(['addError' => 'Not in the specified time period']);

        }
    }


    function dele()
    {
        $facid = Input::get('id');
        $fac = Facility::find($facid);
        echo $fac->delete();
    }

    function getName()
    {
        $email = Input::get('email');
        $userdata = User::where('email', '=', $email)->select(['name', 'id'])->get();
        if (count($userdata)) {
            return $userdata[0]->toJson();
        }
        return '';
    }

    private function sendEmail($data)
    {
        $facdata = Facility::where('id', '=', $data['facilityid'])->select('name')->get()[0];
        $to = $data['unregisteredemail'];
        $msg = "{$data['uname']} facility:$facdata->name datetime:{$data['start_date']}——{$data['end_date']} price:{$data['price']}";
        Mail::raw($msg, function ($message) use ($to) {
            $message->to($to)->subject('SoftwareTeam4');
        });
        return Mail::failures();
    }

    private function checkSession($facid, $postdata)
    {
        $nowdatetime = date('Y-m-d h:i:s');
        $sessions = TrainerSession::where('facilityId', '=', $facid)->get();
        // dd($facbook->toArray());
        foreach ($sessions as $value) {
            //  dd($value->date);
            $dates = explode(',', $value->date);
            $times = $value->time;
            // $start_date = $dates[0];
            $end_date = $dates[1];
            if ($end_date < $nowdatetime) continue;
            $sessionDateTimes = $this->getSessionDateTime($value->date, $times);
            //print_r($sessionDateTimes);
            foreach ($sessionDateTimes as $value) {
                $sess_dates = explode('|', $value);
                $sess_start_date = $sess_dates[0];

                $user_start_date = $postdata['start_date'];
                $user_end_date = $postdata['end_date'];

                $sess_end_date = $sess_dates[1];
                if (!(($user_start_date > $sess_end_date) || ($user_end_date < $sess_start_date))) {
                    //var_dump($sess_end_date,)
                    return false;
                }
            }
            //  dd($sessionDateTimes);
        }
        return true;
    }


    private function isNotIntime($facid, $postdata)
    {
        $startdate = date('H:i:s', strtotime($postdata['start_date']));
        $enddate = date('H:i:s', strtotime($postdata['end_date']));
        return count(DB::table('facility')->where(['id' => $facid, ['start_date', '<=', $startdate], ['end_date', '>=', $enddate]])->get());

    }

    private function isStopBooking($facid)
    {
        $bp = new BlockedPeriod();
        $bpdata = $bp->where('facilityid', '=', $facid)->get();
        if (!count($bpdata)) {
            return false;
        } else {
            $startdate = $bpdata[0]->start_date;
            $enddate = $bpdata[0]->end_date;
            $userStartDate = Input::get('start_date');
            $userEndDate = Input::get('end_date');

            if (($userStartDate > $enddate) || ($userEndDate < $startdate)) {
                return false;
            }
            // dd($startdate,$enddate,$nowdate,($nowdate >= $startdate && $nowdate <= $enddate));
            return true;
        }
    }

    private function checkUserBooking($useIDoremail, $facid, $user_start_date, $user_end_date, $updateoradd = 'add')
    {
        $updateWhere = '';
        if ($updateoradd == 'update') {
            $updateWhere = "and id != " . Input::get('id');
        }

        // echo $facstart_date;
        $time = date('Y-m-d', strtotime($user_start_date));
        //DB::table('facilities_booking')->where(['useID'=>$useID,'facilityID'=>$facid,"DATE_FORMAT(start_date,'%Y-%m-%d')"=>$time,])

        $str = "select * from facilitybookings WHERE ((userid='$useIDoremail' OR unregisteredemail='$useIDoremail') and facilityid='$facid' and DATE_FORMAT(start_date,'%Y-%m-%d')='$time' $updateWhere)";
        //  echo $str;
        $facbook = DB::select($str);
        //  dd($str,$facbook);
        foreach ($facbook as $value) {
            if (!(($user_end_date < $value->start_date) || ($user_start_date > $value->end_date))) {
                return false;
            }
        }
        return true;
    }

    private function isSameDay($postdata)
    {
        $startdate = date('Y-m-d', strtotime($postdata['start_date']));
        $enddate = date('Y-m-d', strtotime($postdata['end_date']));
        return $startdate == $enddate ? $enddate : false;
    }

    private function isOverbooked($facid, $postdata, $updateoradd = 'add')
    {
        $updateWhere = '';
        if ($updateoradd == 'update') {
            $updateWhere = "and id != {$postdata['id']}";
        }

        $start_date = $postdata['start_date'];
        $end_date = $postdata['end_date'];
        $date = date('Y-m-d', strtotime($start_date));
        $fbdata = DB::select("select * from facilitybookings where(DATE_FORMAT(start_date,'%Y-%m-%d')='$date' and facilityid=$facid $updateWhere) ");
        // $fbdataNum = count($fbdata);

        $SuperPositionNum = 0;
        foreach ($fbdata as $value) {
            if ((($start_date >= $value->start_date) && ($start_date <= $value->end_date)) || (($end_date >= $value->start_date) && ($end_date <= $value->end_date)) || (($start_date <= $value->start_date) && ($end_date >= $value->end_date))) {
                $SuperPositionNum++;
            }
        }
        $maxNum = Facility::find($facid)->maximumCapacity;
        //dd($SuperPositionNum, $maxNum);
        return ($SuperPositionNum >= $maxNum);
    }

    function showBooking()
    {
        $id = Input::get('id');
        $userdata = User::all();
        $fac = new Facility();
        $facdata = $fac->where('id', '=', $id)->get()[0];
        $loguser = null;
        foreach ($userdata as $value) {
            if (Auth::guard('user')->user()->id == $value->id) {
                $loguser = $value;
                break;
            }
        }
        $logprice = $this->getFacPrice($loguser, $facdata);
        //  dd($loguser->type,$facdata->toArray());
        return view('facility-booking', compact('facdata', 'userdata', 'logprice'));
    }

    function getPrice()
    {
        $email = Input::get('email');
        $facid = Input::get('facid');
        $user = new User();
        $userdata = $user->where('email', '=', $email)->get();
        if (count($userdata)) {
            $fac = new Facility();
            $facdata = $fac->where('id', '=', $facid)->get()[0];
            return $this->getFacPrice($userdata[0], $facdata);
        }
        return '';
    }

    private function getFacPrice($userdata, $facdata)
    {
        switch ($userdata->type) {
            case '3':
                return $facdata->priceForStudent;
                break;
            case '4':
            case '2':
                return $facdata->priceForStaff;
                break;
            default:
                return $facdata->price;
                break;
        }
    }

    private function checkDate($start_date, $end_date)
    {
        return date('Y-m-d', strtotime($start_date)) == date('Y-m-d', strtotime($end_date));
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
