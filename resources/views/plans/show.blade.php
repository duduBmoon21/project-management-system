<?php

  use App\Activity;
  use App\User;

?>



@extends('layouts.app')

@section('content')
    <h3 class="page-title">View works</h3>

    <div class="row">
        <div class="my-3">
            <ul class="list-group">
                <li class="list-group-item">Title: {{ $plan->name }}</li>
                <li class="list-group-item">start_date: {{ $plan->start_date }}</li>
                <li class="list-group-item">end_date:{{ $plan->end_date }}</li>
			    
             
                <li class="list-group-item">description:{{ $plan->description }} </li>
            </ul>
        </div>
      
      @if(auth()->user()->role_id==2)
        <div class="mt-3">
            <a href="{{ route('plan.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
        @endif
        @if(auth()->user()->role_id==1)
        <div class="mt-3">
            <a href="{{ route('plan.indexx') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
        @endif
        @if(auth()->user()->role_id==2)
        <div class="panel-body table-responsive">
           
            <hr>
            @foreach ($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
            @endforeach
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
           
            <a href="{!! action('ActivityController@create' , $plan->id ) !!}" class="btn btn-info"><i
                    class="fa fa-plus"></i>
                New Activity</a>
            <div class="row mt-3">
                <table class="table table-bordered table-striped {{ count($activitys) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                     
                            <th scope="col">Leader</th>
                            <th scope="col">Action</th>
    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activitys as $task)
                        <tr>
                            <th scope="row">{!! $counter++ !!}</th>
                            <td>
                                <a
                                   > 
                                    {!! $task->name !!}
                                </a>
                            </td>
                            <td>{!! $task->start_date !!}</td>
                            <td>{!! $task->end_date !!}</td>
                           
    
    
      {{--to add super visor name--}}
    <?php
    // $er=Activity::
   
      $user=User::where('id',$task->user_id)->first();
      if($task->user_id==null){
          ?> <td>  <a href="{{ route('addsupervisor',$task->id) }}" > Add Leader</a>  </td> <?php
      }else{
          echo "<td> $user->name </td>" ;
      }
    
    ?>
    <td>

     
        <a href="{{ route('actevaluates', $task->id) }}" class="btn btn-info m-1">Evaluate</a>
       <a href="{{ route('progact_add', $task->id) }}" class="btn btn-info m-1">start</a>

       {{-- @foreach($eval as $evals)
       @if($evals->acts_id==3) --}}
        <a href="{{ route('activevaluateshow', $task->id) }}" class="btn btn-dark">ShowResult</a>
        {{-- @endif
        @endforeach --}}
     
        <a href="{!! action('ActivityController@update' , $task->id ) !!}" class="btn btn-info m-1">Edit</a>
        <a href="{{ route('deleteact', $task->id) }}" class="btn btn-danger m-1">Delete</a>
        
        
    </td>
    
    
                        </tr>
                       
                        @endforeach
                        
                    </tbody>
            
                </table>
                
            </div>
        </div>

        
@endif
    </div>
    @endsection




