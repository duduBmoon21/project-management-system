
@extends('layouts.app')
@section('content')
<div class="container-fluid">
  
	<form method="post" action="{{ route('progstore',$plan->id) }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
       
		 <input  name="plan" value="{{ $plan->id }}"  type="hidden" />
	
		<div class="col-lg-12">
			<div class="row">
				<div class="form-group">
					<label for="">Status</label>
					<select name="status" class="form-control" >
						@if(auth()->user()->role_id==1)
						<option value="0" <?php echo isset($is_compelete) && $is_compelete == 0 ? 'selected' : '' ?>>Pending</option>
						@else
						<option value="1" <?php echo isset($is_compelete) && $is_compelete == 1 ? 'selected' : '' ?>>Started</option>
                         <option value="2" <?php echo isset($is_compelete) && $is_compelete == 2 ? 'selected' : '' ?>>On-Progress</option>
						<option value="3" <?php echo isset($is_compelete) && $is_compelete == 3 ? 'selected' : '' ?>>Done</option>
						@endif
					</select>
				</div>
				<div class="form-group">
					<label for="">Progress Description</label>
					<textarea name="progress" id="progress" cols="30" rows="10" class="summernote form-control" required=""></textarea>
				</div>
				<button type="submit" class="btn btn-info">Submit</button>
				@if(auth()->user()->role_id==2)
				<div class="mt-3">
					<a href="{{ route('plan.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
				</div>
				@endif
				
				<div class="mt-3">
					<a href="{{ route('planadmin') }}" class="btn btn-info">Back to All  Work</a>
				</div>
				<div class="mt-3">
					<a href="{{ route('plan.indexx') }}" class="btn btn-primary">Back To OnProgress Work</a>
				</div>

			</div>
		</div>
      
	</form>




    

</div>
@endsection