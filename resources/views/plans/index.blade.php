<?php

  use App\Activity;
  use App\User;

?>



@extends('layouts.app')
@section('content')
<div class="row m-3">
	<div class="mb-3">
		@if(auth()->user()->role_id==1)
		<a href="{{ route('post.create') }}" class="btn btn-info">Create new work</a>
		@endif
	</div>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col">Start Date</th>
							<th scope="col">End Date</th>
							
							<th scope="col" >Progress</th> 
						    <th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($plan as $post)
				<tr>
					<th scope="row">{{ $loop->index + 1 }}</th>
					
					<td>{{ $post->name}}</td>
					<td>{{ $post->start_date }} </td>
					<td>{{ $post->end_date }}</td>
					
					@if($post->is_compelete == 0)
					<td class='project_progress'>
					<div class='progress progress-sm'>
					 <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' style='width: 0%' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'>
					</div></div><small>
					 0%
				  </small></td>
								   
					@elseif($post->is_compelete == 1)
									<td class='project_progress'><div class='progress progress-sm'> 
									<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' style='width: 25%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>
									</div></div><small>
								   20% Complete
								 </small></td>
								 @elseif($post->is_compelete == 2)
									<td class='project_progress'><div class='progress progress-sm'> 
									<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' style='width: 50%' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100'>
									</div></div><small>
								   50% Complete
								 </small></td>
								 
								   @elseif($post->is_compelete == 3)
									<td class='project_progress'>
										<div class='progress progress-sm'> 
					 <div class='progress-bar bg-green' role='progressbar' style='width: 100%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'>
					</div></div><small>
					100% Complete
				  </small></td> 
					@endif	  
  
					
					<td>
						@if(auth()->user()->role_id==1)
					
						<a href="{{ route('planevaluates', $post->id) }}" class="btn btn-info m-1">Evaluate</a>
						<a href="{{ route('evaluateshow', $post->id) }}" class="btn btn-dark m-1">ShowPerfor</a>
						<a href="{{ route('prog_update', $post->id) }}" class="btn btn-info m-1">Start</a>
						<a href="{!! action('PlansController@update' , $post->id ) !!}" class="btn btn-info m-1">Edit</a>
						<a href="{{ route('deleteplan', $post->id) }}" class="btn btn-danger m-1">Delete</a>
						@endif
						
						@if(auth()->user()->role_id==2)
                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-info m-1">Create Actiity</a>
						<a href="{{ route('planevaluates', $post->id) }}" class="btn btn-info m-1">Update Progress</a>
						@if($post->is_compelete == 3)
						<a href="{{ route('evaluateshow', $post->id) }}" class="btn btn-dark m-1">ShowPerfor</a>
						
						@endif
					
                        
                        @endif	
						
						
						
					</td>
				</tr>
			@empty
			    <tr>
					
			    	<td colspan="4" class="text-center">No works found.</td>
			    </tr>
			@endforelse
		</tbody>
	</table>
	
</div>
@endsection