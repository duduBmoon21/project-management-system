<?php

namespace App\Http\Controllers;

use App\Plan;
use App\User;
use App\Progress;
use Illuminate\Http\Request;
use DB;
use App\Activity;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Evaluation;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use App\Http\Requests\ProgressUpdateFormRequest;
use App\Http\Requests\PlanFormRequest;
use App\Http\Requests\PlanUpdateFormRequest;

define('PASSIVE' , 'Passive');
define('RUNNING' , 'Running');
define('FINISHED', 'Finished');
use App\Services\PayUService\FatalThrowableErrorException;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        $plan=Plan::where('plans.head_id','=',$user->id)
        ->join('progresses','progresses.plnId','=','plans.id')
        ->get(['progresses.is_compelete','plans.name', 'plans.start_date', 'plans.id', 'plans.end_date']);


            return view('plans.index',compact('plan',$plan));
    }

    public function indexx()
    {
        $user=Auth::user();
        $plan=Plan::join('progresses','progresses.plnId','=','plans.id')
        ->get(['progresses.is_compelete','plans.name', 'plans.start_date', 'plans.id', 'plans.end_date']);
        return view('plans.index',compact('plan',$plan));
      
    }


    public function admin()
    {
        $plan=Plan::all();
    return view('plans.admin',compact('plan'));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $users =  User::where('role_id', '2')->get();
        // $user = DB::table('users')->where('role_id', 2)->first();

        // $users = DB::select('select * from users where role_id=2');

       return view('plans.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanFormRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'head_id' => 'required',
            'description' => 'required'
        ],[
                'name.required' => 'Name is must.',
                'name.min' => 'Name must have 5 char.',
            ]);
    
    

$plan=new Plan();
$startdate = $request->input('start_date');
$plan->name=$request->input('name');
$name=$request->input('name');
$request->session()->flash('name',$name);
$plan->start_date=$request->input('start_date');
$plan->end_date=$request->input('end_date');
$plan->description=$request->input('description');
//    $plan->head_id=Auth::user()->id;
$username = $request->input('head_id');
$user = User::where('id' , $username)->first();
$head_id = $user->id;
$plan->head_id=$head_id;
$plan->save();


// $plan=Plan::findOrFail($startdate);
// $prog=new Progress();
// $prog->plnId=$plan->id;
// $prog->save();

if($validator->fails()){
    return back()->withErrors($validator->errors())->withInput();
// return back()->with($request->input('name').'created successfully!');
}
return back()->with($request->input('name').'created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
         try {
           
            $plan = Plan::find($id);
            $activity = Activity::find($id);
            $activitys =$plan->activity()->get();
        //    $eval=$activity->ratings()->get();
           $counter = 1;
        
        } catch (FatalThrowableErrorException $e) {
            return back()->withError($e->getMessage())->withInput();
            // return view('plans.admin');
            // return $e->getMessage();
        }
       
       
        return view('plans.show', compact('plan','activitys','activity','counter'));
        // plans.admin
  

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = Plan::find($id);

        return view('plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update($id)
    {
        $plan= Plan::find($id);
       
        return view('plans.update' , compact('plan'));
    }
    // public function progupdate($id)
    // {
    //     $plan= Plan::find($id);
    //     $prog=Progress::where('plnId',$plan->id)->get();
       
    //     return view('plans.addprog' , compact('plan','prog'));
    // }


    public function save(PlanUpdateFormRequest $request , $id)
    {
        $plan = Plan::whereId($id)->firstOrFail();
        $plan->name = $request->get('name') ;
        if( $request->get('start_date') != null ){
            $plan->start_date = $request->get('start_date');
        }
        if( $request->get('end_date') != null ){
            $plan->end_date = $request->get('end_date');
        }
        $plan->description = $request->get('description');
        if ( $request->get('status') != null ){
            $plan->status = FINISHED ;
        } else {
            $today = date('Y/m/d');
            $plan->status = $plan->end_date < $today ? RUNNING : PASSIVE ;
        }

        $plan->save();
        return redirect(action('PlansController@update' , $id ))->with('status' , 'plan updated successfully!');
    }
    public function Running(Request $request,$id )
    {
        
        $plans= Plan::where('id',$id)->first();

        if($plans->Status!='waiting'){
           $plans->Status=$request->input('status');
           $plans->save();
           return back()->with('status' , 'Plan ' .$plans->name.' now Running');

        }else{
             return back()->with('status' , ' Plan ' .$plans->name.' now Waiting');


        }


    }





    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::delete('delete from plans where id = ?',[$id]);
        
        return redirect()->back()->with('alert','Data successfully deleted');

     }





    
     

    }

