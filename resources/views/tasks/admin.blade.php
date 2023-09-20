@extends('layouts.app')

@section('content')
<div class="container">
   
    <legend>Activities</legend>
    @if(count($activitys))
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Activity</th>
             
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Progress</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($activitys as $task)
            
           <tr>
            
                <th scope="row">{!! $counter++ !!}</th>
                <td><a >
                        {!! $task->name !!}</a>
                </td>
             
                <td>{!! $task->start_date !!}</td>
                <td>{!! $task->end_date !!}</td>
               
					<td>
						

<a href="{!! action('ActivityController@update' , $task->id ) !!}" class="btn btn-info m-1">Edit</a>

						
					</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>You don't have any Activity yet .</p>
    @endif

    
</div>
@endsection
