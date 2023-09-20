<?php

namespace App\Http\Controllers;


use App\Plan;
use App\Activity;
use App\User;
use App\Progress;
use App\Evaluation;
use App\Subactivity;
use DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Debug\Exception\FatalThrowableError;

use Illuminate\Http\Request;

class PerforEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexx($id)
    {
      

        $plan = Plan::find($id);
        $eval=$plan->ratings()->get();
        
        $counter = 1 ;

        return view('plans.Evaluation.index', compact('plan','eval','counter'));
      
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create($id)
    {
        $plan=Plan::whereId($id)->firstOrFail();
        $eval=$plan->ratings()->get();
        // return view('plans.addprog' , compact('plan','prog'));
        return view('plans.Evaluation.create', compact('plan','eval'));
        
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
            'efficiency'=> 'required', 
            'timeliness'=> 'required', 
            'quality'=> 'required',
            'plans_id' => 'required'  ,
             'accuracy'=> 'required'      
        ]
);
$plan=Plan::find($id);
$eval=new Evaluation();
$eval->efficiency=$request->input('efficiency');
$eval->timeliness=$request->input('timeliness');
$eval->quality=$request->input('quality');
$eval->accuracy=$request->input('accuracy');
$eval->remarks=$request->input('remarks');
$eval->plans_id=$plan->id;
$eval->save();
// return view('plans.Evaluation.index' , compact('plan','eval'));
return redirect(route('planevaluates' ,'plan','eval'))->with('status' , 'leader added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { try {
        $plan = Plan::find($id);
       
        $prog = $plan->Progress()->get(); 
        $counter = 0;
        $eval=$plan->ratings()->get();
    } catch (FatalThrowableErrorException $e) {
        return back()->withError($e->getMessage())->withInput();
    }
        return view('plans.evaluate',compact('plan','prog','eval','counter'));
    }


    public function activshow($id)
    {
        try {

        $activity = Activity::find($id);
        $pro = $activity->Progress()->get(); 
        $counter = 1 ;
        $eval=$activity->ratings()->get();
    } catch (FatalThrowableErrorException $e) {
        return back()->withError($e->getMessage())->withInput();
    }
        return view('tasks.evaluate',compact('activity','pro','eval','counter'));
    }

    public function activcreate($id)
    {
        $activity=Activity::whereId($id)->firstOrFail();
        $eval=$activity->ratings()->get();
        // return view('activitys.addprog' , compact('activity','prog'));
        return view('tasks.Evaluation.create', compact('activity','eval'));
        
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activstore($id ,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'efficiency'=> 'required', 
            'timeliness'=> 'required', 
            'quality'=> 'required',
            'acts_id' => 'required'  ,
             'accuracy'=> 'required'      
        ]
);
$activity=Activity::find($id);
$eval=new Evaluation();
$eval->efficiency=$request->input('efficiency');
$eval->timeliness=$request->input('timeliness');
$eval->quality=$request->input('quality');
$eval->accuracy=$request->input('accuracy');
$eval->remarks=$request->input('remarks');
$eval->acts_id=$activity->id;
$eval->save();
// return view('activitys.Evaluation.index' , compact('activity','eval'));
// return redirect(route('activevaluateshow' ,'activity','eval'))->with('status' , 'leader added successfully');
return view('tasks.Evaluation.index');


    }

    public function activindexx($id)
    {
        $activity = Activity::find($id);
        $eval=$activity->ratings()->get();
        // $activitys = Activity::find($id);
         $counter = 1 ;

        return view('tasks.Evaluation.index', compact('activity','eval','counter'));
      
    }

    //subact
 public function subvshow($id)
    {
        try{
        $subactivity = Subactivity::find($id);
       
        $prog = $subactivity->Progress()->get(); 
        $counter = 1 ;
       $eval=$subactivity->ratings()->get();
        } catch (FatalThrowableErrorException $e) {

            return back()->withError($e->getMessage())->withInput();
        }
        return view('subtask.evaluate',compact('subactivity','prog','eval','counter'));
    }

    public function subvcreate($id)
    {
        $subactivity=Subactivity::whereId($id)->firstOrFail();
        $eval=$subactivity->ratings()->get();
        // return view('subactivitys.addprog' , compact('subactivity','prog'));
        return view('subtask.Evaluation.create', compact('subactivity','eval'));
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subvstore($id ,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'efficiency'=> 'required', 
            'timeliness'=> 'required', 
            'quality'=> 'required',
            'subst_id' => 'required'  ,
             'accuracy'=> 'required'      
        ]
);
$subactivity=Subactivity::find($id);
$eval=new Evaluation();
$eval->efficiency=$request->input('efficiency');
$eval->timeliness=$request->input('timeliness');
$eval->quality=$request->input('quality');
$eval->accuracy=$request->input('accuracy');
$eval->remarks=$request->input('remarks');
$eval->subst_id=$subactivity->id;
$eval->save();
// return view('subactivitys.Evaluation.index' , compact('subactivity','eval'));
return redirect(route('subvevaluates' ,'subactivity','eval'))->with('status' , 'leader added successfully');



    }


    //show result
    public function subvindexx($id)
    {
        $subactivity = Subactivity::find($id);
        $eval=$subactivity->ratings()->get();
        
        $counter = 1;

        return view('subtask.Evaluation.index', compact('subactivity','eval','counter'));
      
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//    $activity=Activity::all();
   $activity=Activity::whereId($id)->firstOrFail();
   $progress=Evaluation::find($id);
   $prof=DB::SELECT('SELECT * from evaluations where id = ?',[$id]);
   return view ('tasks.Evaluation.show',['evaluations'=>$prof],compact('activity','progress','prof'));
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
      

        $efficiency=$request->input('efficiency');
        $timeliness=$request->input('timeliness');
        $quality=$request->input('quality');
        $accuracy=$request->input('accuracy');
        $remarks=$request->input('remarks');
 

        $prof=DB::UPDATE('UPDATE evaluations set efficiency = ? , timeliness = ? , quality = ? ,accuracy = ? , remarks = ? where id= ?' ,[$efficiency,$timeliness,$quality,$accuracy,$remarks,$id]);
        return back()->with('success','data updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
        DB::delete('delete from evaluations where id = ?',[$id]);
        
        return redirect()->back()->with('alert','Data successfully deleted');

     }

}
