<?php

namespace App\Http\Controllers;
use App\Plan;
use App\Activity;
use App\User;
use App\Subactivity;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\SubActivityFormRequest;
use App\Http\Requests\SubactivityUpdateFormRequest;




class SubactivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user=Auth::user();
        // $subactivity= Subactivity::where('empl_id',$user->id)->get();
        // $counter=1; ::where('subactivities.empl_id','=',$user->id)->

        $counter=1;
        $user=Auth::user();
        $subactivity=Subactivity::where('subactivities.empl_id','=',$user->id)->join('progresses','progresses.subId','=','subactivities.id')
        ->get(['progresses.is_compelete','subactivities.name', 'subactivities.start_date', 'subactivities.id', 'subactivities.end_date']);


        return view('subtask.index',compact('user','subactivity','counter'));



        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id){

   
    
    $activity=Activity::find($id);
    $users = DB::select('select * from users where role_id=10');
    return view('subtask.create',compact('activity','users'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id ,SubActivityFormRequest $request)

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
        



        $activity=Activity::find($id);
        $plan=Plan::where('id',$activity->plan_id)->first();
    
        $subactivity=new Subactivity();
        $subactivity->name=$request->input('name');
        $subactivity->start_date=$request->input('start_date');
        $subactivity->end_date=$request->input('end_date');
        $subactivity->description=$request->input('description');
        $subactivity->activ_id=$activity->id;
        $username = $request->input('username');
        $user = User::where('id' , $username)->first();
     
        $empl_id = $user->id ;
        $subactivity->empl_id = $user->id ;
        $subactivity->save();
        return redirect(action('ActivityController@show' , [ 'plan_id' => $plan->id , 'activ_id' => $activity->id ]))->with('status' , 'Sub activity'.'  ' .$request->input('name') . '  ' .'created successfully!');

        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput();
    
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
     

        $subactivity=Subactivity::find($id);
        $user_has_id = $subactivity->id ;
        $logged_user = Auth::user()->id ;
        $is_subactivity_belongs_to_this_employee = false ;
        if( $user_has_id == $logged_user ){
            $is_subactivity_belongs_to_this_employee = true ;
        }
  return view('subtask.show',compact('subactivity','is_subactivity_belongs_to_this_employee'));

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
    public function update($id)
    {
        $Subactivity= Subactivity::find($id);
        return view('subtask.update' , compact('Subactivity'));
    }

    public function save(SubactivityUpdateFormRequest $request , $id)
    {
        $Subactivity = Subactivity::whereId($id)->firstOrFail();
        $Subactivity->name = $request->get('name') ;
        if( $request->get('start_date') != null ){
            $Subactivity->start_date = $request->get('start_date');
        }
        if( $request->get('end_date') != null ){
            $Subactivity->end_date = $request->get('end_date');
        }
        $Subactivity->description = $request->get('description');
      

        $Subactivity->save();
        return redirect(action('SubactivitiesController@update' , $id ))->with('status' , 'Sub Activity updated successfully!');
    }


    public function Running(Request $request,$id )
    {
        $Subactivity=Subactivity::find($id);
        $Activity= Activity::where('id',$Subactivity->activ_id)->first();

        if($Activity->Status!='waiting'){
           $Subactivity->Status=$request->input('status');
           $Subactivity->save();
           return back()->with('status' , 'Sub  Activity ' .$Subactivity->name.' now Running');

        }else{
             return back()->with('status' , ' Activity ' .$Activity->name.' now Waiting');


        }


    }



    public function finish(Request $request,$id)
    {
        $Subactivity = Subactivity::whereId($id)->firstOrFail();
        if ( $request->get('status') != null ){
            $Subactivity->Status = 'Finished' ;
            $Subactivity->save();
            return redirect( route('subactivity_show' , $id) )->with('status' , 'Awesome , Thank you for your great job!');
        } else {
            $Subactivity->Status = 'Running' ;
            $Subactivity->save();
            return redirect( route('subactivity_show' , $id) )->with('status' , 'This Subactivity has not finished yet!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::delete('delete from subactivities where id = ?',[$id]);
        
        return redirect()->back()->with('alert','Data successfully deleted');

     }
}
