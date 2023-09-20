@extends('layouts.app')

@section('content')

<div class="row m-3">
    @if(session('name'))
    <h1 style="color: rgb(12, 189, 42)">{{session('name')}} created successfully! </h1>
    {{-- <div class="flash" style="color: rgb(12, 189, 42)">
        {{session('name')}} created successfully! 
      </div> --}}
    @endif
    
	<form method="post" action="{{ route('post.store') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
        
<div class="panel-body">
<div class="row">   
        <div class="form-group">
            <label> Work Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder=" Work Name" name="name">
        </div>

        <div class="form-group">
            <!-- Date input -->
            <label class="control-label" for="date">Start Date</label>
            <input class="form-control date" id="start_date" name="start_date" type="date" />
        </div>

        <div class="form-group">
            <!-- Date input -->
            <label class="control-label" for="date">End Date</label>
            <input class="form-control date" id="end_date" name="end_date" type="date" />
        </div>

        <div class="form-group">
            <label class="control-label">Select Department</label>
            <select class="form-control" name="head_id">
                <option></option>
            @foreach($users as $user)

            <option  style ="red" value="{{ $user->id }}">{{ $user->name }}</option>

     @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
        </div>


        <div class="mt-3">
		<button type="submit" class="btn btn-info">Submit</button>
</div>
		<div class="mt-3">
            <a href="{{ route('planadmin') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>

</div>
</div>
</form>
</div>

<script>
    $(document).ready(function(){
              var start_date=$('input[id="start_date"]'); //our date input has the name "date"
              var end_date=$('input[id="end_date"]');
              var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
              var options={
                format: 'yyyy/mm/dd',
                container: container,
                todayHighlight: true,
                autoclose: true,
              };
              start_date.datepicker(options);
              end_date.datepicker(options);
            });
</script>


@endsection

