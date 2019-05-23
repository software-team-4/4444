<?php

namespace App\Http\Controllers;

use App\blookedperiod;
use App\model\Facility;
use App\model\FacilityBooking;
use App\model\TrainerSession;
use Calendar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class facilityBookingController extends Controller
{

    /**
     * Display a listing of the resource.
     *display all booking in the facilitybooking table -
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facid = Input::get('facid');
        $where = "where 1=1 ";
        /*  if (Auth::guard('user')->user()->type != '1') {
              $where .= 'and  us.id=' . Auth::guard('user')->user()->id;
          }*/

        if ($facid != null && $facid != 'all') {
            $where .= ' and fac.id=' . $facid;
        }

        // dd($facid,$facid!=null&&$facid!='all',$where);
        $bookings = DB::select("select us.name,fc.id,fc.start_date,fc.end_date,fc.title,fc.color,fc.unregisteredemail,fac.name as facname from facilitybookings as fc  LEFT JOIN users as us ON us.id=fc.userId LEFT JOIN facility as fac on fac.id=fc.facilityId $where");

        $booking = [];
        foreach ($bookings as $row) {
            $title = "$row->id|$row->unregisteredemail|$row->facname-$row->title";
            $booking[] = Calendar::event(
                $title,
                false, // to get time not just date so can be shown in calender for specific hours
                new \DateTime($row->start_date),
                new \DateTime($row->end_date),
                $row->id,
                [
                    'color' => $row->color,
                ]
            );
        }

        //  dd($this->getSessionCalendarEvent());
        $booking = array_merge($this->getSessionCalendarEvent($facid), $booking,$this->getBlockedPeriodCalendarEvent($facid));
        $facdata = Facility::select(['id', 'name'])->get();
        $calendar = Calendar::addEvents($booking);
        return view('booking-calendar', compact('bookings', 'calendar', 'facdata'));
    }

    private function getBlockedPeriodCalendarEvent($facid){
        $where='';
        if($facid!='all'&&$facid!=null){
            $where='where facilityid='.$facid;
        }
        $blockedPeriodData=DB::select("select bp.id,fs.name,bp.start_date,bp.end_date from facility fs RIGHT  JOIN blockedperiod bp on fs.id=bp.facilityid $where");
        // dd($blockedPeriodData);
        $allSessDate = array();
        foreach ($blockedPeriodData as $value) {
            $allSessDate[] = Calendar::event(
                $value->name,
                false, // to get time not just date so can be shown in calender for specific hours
                new \DateTime($value->start_date),
                new \DateTime($value->end_date),
                $value->id,
                [
                    'color' => '#dd001b',
                ]
            );
        }
        return $allSessDate;



    }
    private function getSessionCalendarEvent($facid)
    {

        if($facid=='all'||$facid==null){
            $sessdata = TrainerSession::get();
        }else{
            $sessdata = TrainerSession::where(['facilityid'=>$facid])->get();
        }

        $allSessDate = array();
        foreach ($sessdata as $value) {
            foreach ($this->getSessionDateTime($value->date, $value->time) as $dateTime) {
                $dateTimes = explode('|', $dateTime);
                //array_push($allSessDate, ['start_date' => $dateTimes[0], 'end_date' => $dateTimes[1], 'name' => $value->name]);
                $allSessDate[] = Calendar::event(
                    $value->name,
                    false, // to get time not just date so can be shown in calender for specific hours
                    new \DateTime($dateTimes[0]),
                    new \DateTime($dateTimes[1]),
                    $value->id,
                    [
                        'color' => '#0d52f2',
                    ]
                );
            }
        }
        return $allSessDate;
    }

    function getDateTime()
    {
        $id = Input::get('id');
        $data = FacilityBooking::find($id);

        return json_encode(['start_date' => $data->start_date, 'end_date' => $data->end_date]);
    }

    function delete()
    {
        $id = Input::get('id');
        return FacilityBooking::find($id)->delete() ? '1' : '0';
    }
}
