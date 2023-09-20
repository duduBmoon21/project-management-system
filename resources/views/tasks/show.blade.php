<?php

  use App\Activity;
  use App\User;

?>



@extends('layouts.app')

@section('content')
    <h3 class="page-title">View Activity</h3>

    <div class="row">
        <div class="my-3">
            <ul class="list-group">
                <li class="list-group-item">Title: {{ $activitys->name }}</li>
                <li class="list-group-item">start_date: {{ $activitys->start_date }}</li>
                <li class="list-group-item">end_date:{{ $activitys->end_date }}</li>
                <li class="list-group-item">Assigned To: 

                    <?php
                  $user=User::where('id',$activitys->user_id)->first();
                      if($activitys->user_id=!null){
    
                    
                          echo "<td> $user->name </td>" ;
                      }
                    
                    ?></li>
			    <li class="list-group-item">description:{{ $activitys->description }} </li>
            </ul>
        </div>
       
     
        @if(auth()->user()->role_id==3)
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
           
            <a href="{!! action('SubactivitiesController@create' , $activitys->id ) !!}" class="btn btn-info"><i
                class="fa fa-plus"></i>
            New SubActivity</a>
            <div class="row mt-3">
             
                <table class="table table-bordered table-striped {{ count($subact) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                         
                            <th scope="col">Action</th>
    
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($subact as $task)
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
                          
                      
    
     
                            <td>
                            
                                <a href="{{ route('progsub_add', $task->id) }}" class="btn btn-info m-1">Start</a>
                                <a href="{{ route('subvevaluates', $task->id) }}" class="btn btn-info m-1">Evaluate</a>
                               <a href="{!! action('SubactivitiesController@update' , $task->id ) !!}" class="btn btn-info m-1">Edit</a>
                                <a href="{{ route('subvevaluateshow', $task->id) }}" class="btn btn-dark">ShowResult</a>
                               
                                <a href="{{ route('deletesub', $task->id) }}" class="btn btn-danger m-1">Delete</a>
                            
                            </td>
    
    
                        </tr>
                        <div class="mt-3">

                        
                        </div>
                        @endforeach

                        
                    </tbody>
            
                </table>
                
            </div>
        </div>

        
@endif
    </div>
    @endsection




