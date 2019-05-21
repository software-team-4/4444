<?php

namespace App\Http\Controllers;

use App\model\BlockedPeriod;
use App\model\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class BlockedPeriodController extends Controller
{
    //
    function index(Request $request)
    {
        $facid = Input::get('id');

        $bp = new BlockedPeriod();
        if ($request->method() == 'POST') {
            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'required|after:start_date'
            ]);
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');

            if ($this->isUpdate($facid)) {
                if ($bp->where('facilityid', '=', $facid)->update(['start_date' => $start_date, 'end_date' => $end_date])) {
                    return redirect('/facilities/nobooking?id=' . $facid);
                } else {
                    return redirect('/facilities/nobooking?id=' . $facid)->withErrors(['updateError' => 'failed update']);
                }
            } else {
                $bp->start_date = $start_date;
                $bp->end_date = $end_date;
                $bp->facilityid = $facid;
                if ($bp->save()) {
                    return redirect('/facilities/nobooking?id=' . $facid);
                } else {
                    return redirect('/facilities/nobooking?id=' . $facid)->withErrors(['addError' => 'failed add']);
                }
            }

        } else {

            $facdata['name'] = Facility::find($facid)->name;
            $facdata['id'] = $facid;
            $facdata['start_date'] = '';

            $facdata['end_date'] = '';
            $bpdata = $bp->where('facilityid', '=', $facid)->get();
            if (count($bpdata)) {
               // dd($bpdata);
                $facdata['start_date'] = $bpdata[0]->start_date;
                $facdata['end_date'] = $bpdata[0]->end_date;
            }
          //  dd($facdata);
            return view('facility-nobooking', compact('facdata'));
        }
    }

    private function isUpdate($facid)
    {
        $bp = new BlockedPeriod();
        return $bp->where('facilityid', '=', $facid)->count();
    }

}
