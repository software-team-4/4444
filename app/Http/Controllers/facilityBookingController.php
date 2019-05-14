<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\facilityBooking;

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
        $id=2;
         $bookings = facilitybooking::where('facilityId','=',$id)->get(); // facilitybooking::all(); // table name in the calendarviewmodel
    
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
    public function ajaxa(Request $request)
        {
            
          // getFacilityCalendar($request);
            $id = $request['id'];
            $bookings = facilitybooking::where('facilityId','=',$id)->get(); 
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
          //  return redirect ('calendarView', compact('bookings','calendar'));
         // return view ('calendarView', compact('bookings','calendar'));
         //return \Response::jsan($bookings);
        // $result=" {!! $calendar->calendar()!!}{!! $calendar->script()!!}";
       // $a = " {!! $calendar->calendar()!!}{!! $calendar->script()!!}";
         return response()->json(array('success'=>true, compact('bookings','calendar')));
         //return response()->json(array('success'=>true, 'id'=>$id));
         
        
        }
    

    // refresh calender debends on the option from the list 
    public function getFacilityCalendar(Request $request)
     {
       /* $bookings = facilitybooking::where ('facilityId',id);
         if($id == 0) {// all calendare
         }
         if($id == 1) {// Squash courts 
         }*/
        return view ('/facilities');
        //$fill = \DB::table('facilitybookings')->where('facilityId', $id)->pluck('facilityId');
       // return Response::json(['success'=>true, 'info'=>$fill]);
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
