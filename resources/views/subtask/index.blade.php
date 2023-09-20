@extends('layouts.app')

@section('content')
<div class="container">
    <legend>SubActivities</legend>
    @if(count($subactivity))
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">SubActivities</th>
            
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Progress</th>
                <th scope="col">XTion</th>
               
            </tr>
        </thead>
        <tbody>
            
            @foreach ($subactivity as $task)
            
           <tr>
                <th scope="row">{!! $counter++ !!}</th>
                <td><a
                    href="{{ route('subactivity_show',$task->id) }}" >
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
						
                      <a href="{{ route('subvevaluates', $task->id) }}" class="btn btn-info m-1">update-progress</a>
                      @if($task->is_compelete == 3)
                      <a href="{{ route('subvevaluateshow', $task->id) }}" class="btn btn-dark">Your Activity Report</a>
                      @endif
					</td>
            </tr>
            @endforeach
           
        </tbody>
    </table>
    @else
    <p>You don't have any sub Activity yet .</p>
    

    @endif
</div>
@endsection
