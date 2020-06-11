<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use App\BusSchedule;
use App\Bus;
use App\Operator;
use DB;


class BusScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_schedule = BusSchedule::all();
        $all_operator['data'] = Operator::orderby("operator_name","asc")
                                           ->select('id','operator_name')
                                           ->get();
        // $all_bus = Bus::all();
        return view('admin.time_schedule.add-time',compact('all_schedule','all_operator'));

        
    }





    // Fetch records
    public function getBus(Request $r){

        // Fetch Users by Departmentid
        // $bus_list['data'] = Bus::orderby("bus_code","asc")
        //             ->select('id','bus_code')
        //             ->where('operator_id',$busid)
        //             ->get();
  
        // echo json_encode($bus_list);
        // exit;

        // if($r->has(key::'operator_id'){
        //     return \DB::table('buses')->where('operator_id', $r->input(key::'operator_id'));
        echo $r;

       
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
        $this->validate($request,[
            'operator_id' => 'required',
            'bus_id' => 'required',
            'time_schedule' => 'required',
            'created_at' => Carbon::now()
        ]);

        
        Bus::insert([
            'operator_id' => $request-> operator_id,
            'bus_id' => $request-> bus_id,
            'time_schedule' => $request-> time_schedule,
            

        ]);

        Toastr::success('Successfully Added !' ,'Time');
        return back();
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
