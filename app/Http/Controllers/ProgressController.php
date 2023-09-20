<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Activity;
use App\User;
use App\Progress;
use App\Subactivity;
use DB;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\ProgressUpdateFormRequest;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addactprog($id)
    {
        $act=Activity::whereId($id)->firstOrFail();
        $prog=$act->progress()->get();
        return view('tasks.addprog' , compact('act','prog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function actstore($id ,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'progress' => 'required',
            'acId' => 'required'       
        ]
);
$act=Activity::find($id);
$prog=new Progress();
$prog->progress=$request->input('progress');

$prog->is_compelete=$request->input('status');
$prog->acId=$act->id;
$prog->save();
return view('tasks.addprog' , compact('act','prog'));

    }

    public function create($id)
    {  try {
        $plan=Plan::whereId($id)->firstOrFail();
        $prog=$plan->progress()->get();
    } catch (FatalThrowableErrorException $e) {
        return back()->withError($e->getMessage())->withInput();
    }
        return view('plans.addprog' , compact('plan','prog'));
        
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id ,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'progress' => 'required',
            'plnId' => 'required'       
        ]
);
$plan=Plan::find($id);
$prog=new Progress();
$prog->progress=$request->input('progress');

$prog->is_compelete=$request->input('status');
$prog->plnId=$plan->id;
$prog->save();
return view('plans.addprog' , compact('plan','prog'));

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

     //subactiity
    public function edit($id)
    {
   $subactivity=Subactivity::all();
   $progress=Progress::find($id);
   $prof=DB::SELECT('SELECT * from progresses where id = ?',[$id]);
   return view ('subtask.edit',['progresses'=>$prof],compact('subactivity','progress','prof'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatee(Request $request,$id)
    {
        $iscomplete=$request->input('is_compelete');
        $progress=$request->input('progress');
        $prof=DB::UPDATE('UPDATE progresses set is_compelete= ? , progress = ? where id= ?' ,[$iscomplete, $progress,$id]);
        return back()->with('success','data updated');
    }

    public function editact($id)
    {
   $activity=Activity::all();
   $progress=Progress::find($id);
   $prof=DB::SELECT('SELECT * from progresses where id = ?',[$id]);
   return view ('tasks.editact',['progresses'=>$prof],compact('activity','progress','prof'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateact(Request $request,$id)
    {
        $iscomplete=$request->input('is_compelete');
        $progress=$request->input('progress');
        $prof=DB::UPDATE('UPDATE progresses set is_compelete= ? , progress = ? where id= ?' ,[$iscomplete, $progress,$id]);
        return back()->with('success','data updated');
    }



    public function editplan($id)
    {
   $activity=Plan::all();
   $progress=Progress::find($id);
   $prof=DB::SELECT('SELECT * from progresses where id = ?',[$id]);
   return view ('plans.editact',['progresses'=>$prof],compact('activity','progress','prof'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateplan(Request $request,$id)
    {
        $iscomplete=$request->input('is_compelete');
        $progress=$request->input('progress');
        $prof=DB::UPDATE('UPDATE progresses set is_compelete= ? , progress = ? where id= ?' ,[$iscomplete, $progress,$id]);
        return back()->with('success','data updated');
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

    public function addsubprog($id)
    {
        $sub=Subactivity::whereId($id)->firstOrFail();
        $prog=$sub->progress()->get();
        return view('subtask.addprog',compact('sub','prog'));
    }

    public function substore($id ,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'progress' => 'required',
            'subId' => 'required'       
        ]
);
$sub=Subactivity::find($id);
$prog=new Progress();
$prog->progress=$request->input('progress');

$prog->is_compelete=$request->input('status');
$prog->subId=$sub->id;
$prog->save();
return view('subtask.addprog' , compact('sub','prog'));

    }
    
}
