<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Activity;
use App\User;
use App\Subtask;
use DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Services\PayUService\FatalThrowableErrorException;
// use Exception;
use Illuminate\Http\Request;

use App\Http\Requests\ActivivtyUpdateFormRequest;
use App\Http\Requests\ActivityFormRequest;
define('PASSIVE' , 'Passive');
define('RUNNING' , 'Running');
define('FINISHED', 'Finished');

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //     $user=Auth::user();
    //     $activitys=Activity::where('user_id',$user->id)->get();
        $counter=1;
    $user=Auth::user();
    $activitys=Activity::where('activities.user_id','=',$user->id)
    ->join('progresses','progresses.acId','=','activities.id')
    ->get(['progresses.is_compelete','activities.name', 'activities.start_date', 'activities.id', 'activities.end_date']);

            return view('tasks.index',compact('user','activitys','counter'));
    }



    public function indexx()
    {
        $user=Auth::user();
        $plan=Plan::join('progresses','progresses.plnId','=','plans.id')
        ->get(['progresses.is_compelete','plans.name', 'plans.start_date', 'plans.id', 'plans.end_date']);
        return view('plans.index',compact('plan',$plan));
      
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $plan= Plan::whereId($id)->firstOrFail();
        $activitys=Activity::where('plan_id',$plan->id)->get();


        return view('tasks.create' , compact('plan','activitys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id ,ActivityFormRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',  ]
            ,[
                'name.required' => 'Name is must.',
                'name.min' => 'Name must have 5 char.',
            ]);
        
      
              $plan=Plan::find($id);
              $activitys=new Activity();
               $activitys->name=$request->input('name');
               $activitys->start_date=$request->input('start_date');
               $activitys->end_date=$request->input('end_date');
                $activitys->plan_id=$plan->id;
               $activitys->description=$request->input('description');
               $activitys->save();
                return redirect(action('PlansController@show', $id ))->with('status' , 'Task created successfully!');
          
if($validator->fails()){
    return back()->withErrors($validator->errors())->withInput();
// return back()->with($request->input('name').'created successfully!');
}  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
      
        // try {
        //     $activitys = Activity::find($id);
        //     $subact=$activitys->subactivity()->get();
        //     $counter = 1 ;
        
        // } catch (\FatalThrowableErrorException $exception) {
        //     // return view('plans.admin')->withError($exception->getMessage())->withInput();
        //     return redirect('tasks.index');
        // }
        // $activitys = Activity::find($id);
        // $activityss->acId=$activitys->id;
        // $prog=$activitys ->progress()->get();
        //     $subact=$activitys->subactivity()->get();
        //     $counter = 1 ;

            $activitys = Activity::find($id);
            $prog=$activitys ->progress()->get();
            $subact=$activitys->subactivity()->get();
            $counter = 1 ;

        return view('tasks.show', compact('activitys','subact','prog','counter'));
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
    // public function update(Request $request, $id)
    // {

    // }
    public function update($id)
    {
        $activity= Activity::find($id);
        return view('tasks.update' , compact('activity'));
    }

    public function save(ActivivtyUpdateFormRequest $request , $id)
    {
        $activity = Activity::whereId($id)->firstOrFail();
        $activity->name = $request->get('name') ;
        if( $request->get('start_date') != null ){
            $activity->start_date = $request->get('start_date');
        }
        if( $request->get('end_date') != null ){
            $activity->end_date = $request->get('end_date');
        }
        $activity->description = $request->get('description');
       

        $activity->save();
        return redirect(action('ActivityController@update' , $id ))->with('status' , 'Activity updated successfully!');
    }



    public function addsupervisor($id )
    {
           $activitys = Activity::whereId($id)->firstOrFail();
           $plan = Plan::where('id',$activitys->plan_id)->first();
           $user=User::all();
           $users = DB::select('select * from users where role_id=3');

          
        //    return view('plans.create',['users'=>$user]);
        //    return redirect(route('addsupervisor' , $activitys->id , compact('plan','activitys')));
           return view('tasks.addsupervisor',compact('plan','activitys','users'));
    } 

    public function savesupervisor(Request $request,$id )
    {
      $activitys=Activity::find($id);
      $username=$request->input('leader');
      $plan = Plan::where('id',$activitys->plan_id)->first();
    //   $user=User::where('role_id',$username)->first();
    
      $user = User::where('id' , $username)->first();
      
    
        // dd($plan);


        try {
            if($user){
            $activitys->name=$request->input('name');
            $activitys->start_date=$request->input('start_date');
            $activitys->end_date=$request->input('end_date');
            $activitys->plan_id=$request->input('plan');
            $activitys->description=$request->input('desc');
            $user_id = $user->id ;
            $activitys->user_id=$user->id;
         
            $activitys->save();
            return redirect(route('post.show' ,['users'=>$user] ))->with('status' , 'leader added successfully');


        }else{
            return redirect(route('addsupervisor' , $activitys->id ))->with('danger' , 'super LEAER not Exist');
        }
          
          } catch (\FatalThrowableErrorException $e) {
          
              return $e->getMessage();
          }  
        //  $activitys->name=$request->input('name');
        //  $activitys->start_date=$request->input('start_date');
        //  $activitys->end_date=$request->input('end_date');
        //  $activitys->plan_id=$request->input('plan');
        //  $activitys->description=$request->input('desc');
        //  $user_id = $user->id ;
        //  $activitys->user_id=$user->id;
      
        //  $activitys->save();
     
    }

    public function Running(Request $request,$id )
    {
        $activity=Activity::find($id);
        $plan= plan::where('id',$activity->plan_id)->first();

        if($plan->Status!='waiting'){
           $activity->Status=$request->input('status');
           $activity->save();
           return back()->with('status' , 'Sub  Activity ' .$activity->name.' now Running');

        }else{
             return back()->with('status' , ' Plan ' .$plan->name.' now Waiting');


        }


    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::delete('delete from activities where id = ?',[$id]);
        
        return redirect()->back()->with('alert','Data successfully deleted');

     }
}
