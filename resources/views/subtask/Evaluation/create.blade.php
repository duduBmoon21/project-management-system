@extends('layouts.app')

@section('content')
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form method="post" action="{{ route('subvevaluatestore',$subactivity->id) }}">
				<input type="hidden"
        name="_token"
        value="{{ csrf_token() }}">
				@foreach ($errors->all() as $error)
				<p class="alert alert-danger">{{ $error }}</p>
				@endforeach
				
				<div class="row">
					<div class="col-md-6 border-right">

						<div class="row " id="ratings-field">
							<div class="col-md-12">
							<label for="" class="control-label">Performance Ratings</label>
							</div>
							<hr>
							<div class="col-md-6">
								<div class="form-group">
									<label for="" class="control-label">Efficiency</label>
									<select name="efficiency" class="form-control"  required>
										@for($i = 5; $i >= 0;$i--)
										<option @php echo isset($efficiency) && $efficiency == $i ? "selected" : '' @endphp >  @php echo $i @endphp</option>
										@endfor
									
									</select>
								</div>
								<div class="form-group">
									<label for="" class="control-label">Timeliness</label>
									<select name="timeliness"  class="form-control"  required>
										@for($i = 5; $i >= 0;$i--)
										<option @php echo isset($timeliness) && $timeliness == $i ? "selected" : '' @endphp >@php echo $i @endphp</option>
										 @endfor 
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="" class="control-label">Quality</label>
									<select name="quality" id="quality"  class="form-control"  required>
										@for($i = 5; $i >= 0;$i--)
										<option @php echo isset($quality) && $quality == $i ? "selected" : '' @endphp >@php echo $i @endphp</option>
										 @endfor 
									</select>
								</div>
								<div class="form-group">
									<label for="" class="control-label">Accuracy</label>
									<select name="accuracy" id="accuracy"  class="form-control"  required>
										@for($i = 5; $i >= 0;$i--)
										<option @php echo isset($accuracy) && $accuracy == $i ? "selected" : '' @endphp >@php echo $i @endphp </option>
										 @endfor 
									</select>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="" class="control-label">Remarks</label>
								<textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control">@php echo isset($remarks) ? $remarks : '' @endphp </textarea>
							</div>
						</div>
						
					</div>
					
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-info ">Save</button>
                    <div class="mt-3">
                        <a href="{{ route('subvevaluates',$subactivity->id) }}" class="btn btn-default">Back</a>
                    </div>
					{{-- <button class="btn btn-secondary" type="button" >Cancel</button> --}}
				</div>
			</form>
		</div>
	</div>
</div>
<div id="clone_progress" class="d-none">
	<div class="post">
              <div class="user-block">
                <img class="img-circle img-bordered-sm avatar" src="" alt="user image">
                <span class="username">
                  <a href="#" class="nf"></a>
                </span>
                <span class="description">
                	<span class="fa fa-calendar-day"></span>
                	<span><b class="date"></b></span>
            	</span>
              </div>
              <div class="pdesc">
              
              </div>

              <p>
              </p>
        </div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
	#post-field{
		max-height: 70vh;
		overflow: auto;
	}
</style>
@endsection
