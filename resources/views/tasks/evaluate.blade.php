<?php

  use App\Activity;
  use App\User;

?>



@extends('layouts.app')
@section('content')
<h3 class="page-title">View activitys</h3>

    <div class="row">
        <div class="my-3">
            <ul class="list-group">
                <li class="list-group-item">Title: {{ $activity->name }}</li>
                <li class="list-group-item">start_date: {{ $activity->start_date }}</li>
                <li class="list-group-item">end_date:{{ $activity->end_date }}</li>
                <li class="list-group-item">Assigned To: 

                    <?php
                  $user=User::where('id',$activity->user_id)->first();
                      if($activity->user_id=!null){
    
                    
                          echo "<td> $user->name </td>" ;
                      }
                    
                    ?></li>
			
				<li class="list-group-item">description:{{ $activity->description }} </li>


                   
            </ul>
        </div>

       
       

    <div class="row mt-3">
        <table class="table table-bordered table-striped {{ count($pro) > 0 ? 'datatable' : '' }}">
            <thead>
                <tr>
                    <th scope="col">#</th>
              

                    <th scope="col">Progress</th>
                
                    <th scope="col">Status</th>
                  
                
            </thead>
            <tbody>
                @foreach ($pro as $task)
                <tr>
                    <th scope="row">{!! $counter++ !!}</th>
                 <td>{!! $task->progress !!}</td>
                    <td>
                        
                        {!! $task->is_compelete!!}</td>
                        @if(auth()->user()->role_id==3)   
                        <div class="mt-3">
                    <a href="{!! url('/editact-progress/'.$task->id ) !!}" class="btn btn-info m-1">Update </a>
                        </div>
@endif


    @if(auth()->user()->role_id==2)
    @if(($task->is_compelete==3))
    <div class="mt-3">
        <a href="{{ route('activevaluatecreate', $activity->id) }}" class="btn btn-info m-1">Evaluate</a>
       
        </div>
    @endif
      @endif
   

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

 @endsection   

