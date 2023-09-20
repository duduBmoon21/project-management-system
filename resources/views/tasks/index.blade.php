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
                @if($task->is_compelete == 0)
                <td class='project_progress'>
                <div class='progress progress-sm'>
                 <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' style='width: 0%' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'>
                </div></div><small>
                 0%
              </small></td>
                               
                @elseif($task->is_compelete == 1)
                                <td class='project_progress'><div class='progress progress-sm'> 
                                <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' style='width: 25%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>
                                </div></div><small>
                               25% Complete
                             </small></td>
                             @elseif($task->is_compelete == 2)
                                <td class='project_progress'><div class='progress progress-sm'> 
                                <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' style='width: 50%' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100'>
                                </div></div><small>
                               50% Complete
                             </small></td>
                             
                               
                            @elseif($task->is_compelete == 3)
                                <td class='project_progress'>
                                    <div class='progress progress-sm'> 
                 <div class='progress-bar bg-green' role='progressbar' style='width: 100%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'>
                </div></div><small>
                100% Complete
              </small></td> 
                @endif	  

					<td>
                        <a href="{{ route('task.show', $task->id) }}" class="btn btn-info m-1">Create SubActivity</a>
                        <a href="{{ route('actevaluates', $task->id) }}" class="btn btn-info m-1">Update Progress</a>
                        @if($task->is_compelete == 3)
                        <a href="{{ route('activevaluateshow', $task->id) }}" class="btn btn-dark">Show Your Report</a>
					@endif
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
