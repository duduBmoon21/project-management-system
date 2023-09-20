@extends('layouts.app')

@section('content')

<div class="row">
    <div class="my-3">
      
                <h1 class="header">{!! $subactivity->name !!}</h1>
                <p><strong>Start Date :</strong> {!! $subactivity->start_date !!}</p>
                <p><strong>End Date :</strong> {!! $subactivity->end_date !!}</p>
                <li class="list-group-item">Assigned To: 

                    <li class="list-group-item">Assigned To: 

                        <?php
                    $user=User::where('id',$subactivity->empl_id)->first();
                          if($subactivity->empl_id=!null){
        
                        
                              echo "<td> $user->name </td>" ;
                          }
                        
                        ?></li>
                <p><strong>Description :</strong> {!! $subactivity->description !!}</p>
                <hr> 
            </div>
        </div>
 @endsection
