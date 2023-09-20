@extends('layouts.app')

@section('content')
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a  class="btn btn-info" href="{!! action('PerformanceController@create') !!}"><i class="fa fa-plus"></i> Add New Evaluation</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Task</th>
						<th>Employee id</th>
						<th>Evaluator</th>
						<th width="15%">Performance Average</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($performances as $performance)
					<tr>
						
						
						<th>
							{{$performance['id']}}
								
						{{-- {!! $performance->id !!} --}}
						</th>
						<td>
							{{$performance['task_id']}}
						</td>
						<td>
							{{$performance['empl_id']}}
						</td>
						<td>
							{{$performance['examiner_id']}}
						</td>
						<td>
							{{$performance['remarks']}}
						</td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_evaluation" href="#" data-id="">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="#">Edit</a>
		                     
							
							
		                     
		                    </div>
							<button type="button" data-id="">
								<i class='fa fa-trash' style='color: red'></i>
							  </button>
							
						</td>

					</tr>
					@endforeach
				
				</tbody>
			</table>
		</div>
	</div>
</div>


@endsection