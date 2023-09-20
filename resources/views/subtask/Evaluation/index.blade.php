
@extends('layouts.app')

@section('content')

		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Subactivity</th>
				
						{{-- @if(auth()->user()->role_id==1)
						<th>Evaluator</th>
						 @endif --}}

                         <th>efficiency</th>
                         <th>timeliness</th>
                         <th>quality</th>
                         <th>accuracy</th>
                    
						<th width="15%">Performance Average</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
				
					$conn= new mysqli('localhost','root','','SPMS')or die("Could not connect to mysql".mysqli_error($con));
					// $result = $conn->query("SELECT * as ename,((((efficiency + timeliness + quality + accuracy)/4)/5) * 100) as pa FROM evaluations r inner join users e on e.id = r.user_id inner join plan t on t.id = r.plan_id");
					// while($row= $qry->fetch_assoc()):

                    $result = $conn->query("SELECT `subst_id`,`efficiency`, `timeliness`, `quality`, `accuracy` FROM `evaluations` WHERE subst_id  ");
                    while($row = $result->fetch_assoc()) {

						
						$er=$row['subst_id'];
						$ad=$conn->query("SELECT `name` FROM `subactivities` WHERE id=$er");
						while($add=$ad->fetch_assoc()){
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ($add['name']) ?></b></td>
					
						<td><b><?php echo ($row['efficiency']) ?></b></td>
                        <td><b><?php echo ($row['timeliness']) ?></b></td>
                        <td><b><?php echo ($row['quality']) ?></b></td>
                        <td><b><?php echo ($row['accuracy']) ?></b></td>
						<td><b><?php echo ((((($row['accuracy'])+($row['quality'])+($row['timeliness'])+($row['efficiency']))/4)/5) * 100).'%' ?></b></td>
						<td class="text-center">
							@if(auth()->user()->role_id==3)
							<a  class="btn btn-danger m-1">Delete</a>
							{{-- <a href="{{ route('actdestroy', $post->id) }}" class="btn btn-danger m-1">Delete</a> --}}
						    @endif
						</td>
					</tr>	
				<?php }} ?>
				</tbody>
			</table>
		</div>
	
@endsection