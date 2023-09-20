<?php

  use App\Activity;
  use App\User;

?>



@extends('layouts.app')
@section('content')
<div class="row m-3">
	<div class="mb-3">	<a href="{{ route('post.create') }}" class="btn btn-info">Create new work</a>
	
	</div>
	<table class="table table-bordered table-hover">
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
			@forelse ($plan as $post)
				<tr>
					<th scope="row">{{ $loop->index + 1 }}</th>
					
					<td>{{ $post->name}}</td>
					<td>{{ $post->start_date }} </td>
					<td>{{ $post->end_date }}</td>
				
					<td>
			
					
						<a href="{{ route('planevaluates', $post->id) }}" class="btn btn-info m-1">Evaluate</a>
						{{-- <a href="{{ route('evaluateshow', $post->id) }}" class="btn btn-info m-1">ShowPerfor</a> --}}
						<a href="{{ route('prog_update', $post->id) }}" class="btn btn-info m-1">Start</a>
						<a href="{!! action('PlansController@update' , $post->id ) !!}" class="btn btn-info m-1">Edit</a>
						<a href="{{ route('deleteplan', $post->id) }}" class="btn btn-danger m-1">Delete</a>
                        

						
						
						
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