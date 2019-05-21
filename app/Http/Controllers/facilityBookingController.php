<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\facilityBooking;
use App\blookedperiod;

class facilityBookingController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *display all booking in the facilitybooking table - 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
