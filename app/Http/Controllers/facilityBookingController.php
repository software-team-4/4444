<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\facilityBooking;
use App\blookedperiod;
=======
use App\blookedperiod;
use App\model\Facility;
use App\model\FacilityBooking;
use App\model\TrainerSession;
use Calendar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

>>>>>>> 406bd4f25be4da12fd43bf1576fe089cea0e5757

class facilityBookingController extends Controller
{

    /**
     * Display a listing of the resource.
     *display all booking in the facilitybooking table -
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        // Arwa
       // $id=2;
         $bookings =  facilitybooking::all(); // table name in the calendarviewmodel
        // $blockeds= bloockedperiod::all();
    
        $booking = [];
        foreach($bookings as $row){
            $enddate=$row->end_date."24:00:00";
            $booking[] = \Calendar::event( 
            $row->title,
            false, // to get time not just date so can be shown in calender for specific hours
            new \DateTime($row->start_date),
            new \DateTime($row->end_date),
            $row->id,
            [
                'color'=>$row->color,
            ]
            );
        }
       $calendar = \Calendar::addEvents($booking);
        return view ('calendarView', compact('bookings','calendar'));  
    }

   // Arwa 
   public function viewCalendar($id)
   {
       $facid=$id;
       if ($facid<2||$facid>5)// return all bookings
       {
        $bookings =  facilitybooking::all();
        $blookeds =DB::table('bloockedperiods')->get();
       }
       else{
        $bookings =  facilitybooking::where('facilityId','=',$facid)->get();
        $blookeds =DB::table('bloockedperiods')->where(['facilityID'=>$facid])->get();
       }
       $booking = [];
       //retrive from blokedperiods table color=black 
       $title = "blokedPeriod";
       foreach ($blookeds as $row) {
        $enddate=$row->end_date."24:00:00";
        $booking[] = \Calendar::event( 
        $title,
        false, // to get time not just date so can be shown in calender for specific hours
        new \DateTime($row->start_date),
        new \DateTime($row->end_date),
        $row->id,
        [
            'color'=>'black',
        ]
        );
       }
         
       //retrive from facilitybooking table
       // change the color of booking depends on the facility id 
       $color='black';
       if ($facid ==2){
        $color='blue';
       }
       else if ($facid ==3){
        $color='yellow';
       }
       else if ($facid ==4){
        $color='red';
       }
       else if ($facid ==5){
        $color='green';
       }

        foreach($bookings as $row){
            $enddate=$row->end_date."24:00:00";
            $booking[] = \Calendar::event( 
            $row->title,
            false, // to get time not just date so can be shown in calender for specific hours
            new \DateTime($row->start_date),
            new \DateTime($row->end_date),
            $row->id,
            [
                'color'=>$color,
            ]
            );
        }
    $calendar = \Calendar::addEvents($booking);
        return view ('bookingsCalendar', compact('bookings','calendar')); 
   }
=======
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
            $enddate = $row->end_date . "24:00:00";
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
>>>>>>> 406bd4f25be4da12fd43bf1576fe089cea0e5757

      //  dd($this->getSessionCalendarEvent());
        $booking = array_merge($this->getSessionCalendarEvent(), $booking);
        $facdata = Facility::select(['id', 'name'])->get();
        $calendar = Calendar::addEvents($booking);
        return view('booking-calendar', compact('bookings', 'calendar', 'facdata'));
    }


    private function getSessionCalendarEvent()
    {

        $sessdata = TrainerSession::get();
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

    // Arwa
    public function viewCalendar($id)
    {
        $facid = $id;
        if ($facid < 2 || $facid > 5)// return all bookings
        {
            $bookings = facilitybooking::all();
            $blookeds = DB::table('blockedperiod')->get();
        } else {
            $bookings = facilitybooking::where('facilityId', '=', $facid)->get();
            $blookeds = DB::table('blockedperiod')->where(['facilityID' => $facid])->get();
        }
        $booking = [];
        //retrive from blokedperiods table color=black
        $title = "blokedPeriod";
        foreach ($blookeds as $row) {
            $enddate = $row->end_date . "24:00:00";
            $booking[] = Calendar::event(
                $title,
                false, // to get time not just date so can be shown in calender for specific hours
                new \DateTime($row->start_date),
                new \DateTime($row->end_date),
                $row->id,
                [
                    'color' => 'black',
                ]
            );
        }

        //retrive from facilitybooking table
        // change the color of booking depends on the facility id
        $color = 'black';
        if ($facid == 2) {
            $color = 'blue';
        } else if ($facid == 3) {
            $color = 'yellow';
        } else if ($facid == 4) {
            $color = 'red';
        } else if ($facid == 5) {
            $color = 'green';
        }

        foreach ($bookings as $row) {
            $enddate = $row->end_date . "24:00:00";
            $booking[] = Calendar::event(
                $row->title,
                false, // to get time not just date so can be shown in calender for specific hours
                new \DateTime($row->start_date),
                new \DateTime($row->end_date),
                $row->id,
                [
                    'color' => $color,
                ]
            );
        }
        $calendar = Calendar::addEvents($booking);
        return view('bookingsCalendar', compact('bookings', 'calendar'));
    }
}
