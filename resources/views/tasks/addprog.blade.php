
@extends('layouts.app')
@section('content')
<div class="container-fluid">
  
	<form method="post" action="{{ route('progactstore',$act->id) }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
       
		 <input  name="act" value="{{ $act->id }}"  type="hidden" />
	
		<div class="col-lg-12">
			<div class="row">
				<div class="form-group">
					<label for="">Status</label>
					<select name="status" class="form-control" >
						@if(auth()->user()->role_id==2)

						<option value="0" <?php echo isset($is_compelete) && $is_compelete == 0 ? 'selected' : '' ?>>Pending</option>
						@else
						<option value="1" <?php echo isset($is_compelete) && $is_compelete == 1 ? 'selected' : '' ?>>Started</option>
						<option value="2" <?php echo isset($is_compelete) && $is_compelete == 2 ? 'selected' : '' ?>>Running</option>
						

						<option value="3" <?php echo isset($is_compelete) && $is_compelete == 3 ? 'selected' : '' ?>>Done</option>
						@endif
					</select>
				</div>
				<div class="form-group">
					<label for="">Progress Description</label>
					<textarea name="progress" id="progress" cols="30" rows="10" class="summernote form-control" required=""></textarea>
				</div>
				<button type="submit" class="btn btn-info">Submit</button>
		{{-- <div class="mt-3">
            <a href="{{ route('tasks.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div> --}}
			</div>
		</div>
      
	</form>




    

</div>
@endsection