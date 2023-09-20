@extends('layouts.app')

@section('content')
<div class="row m-3">

    <div class="panel-body">
        <div class="row"> 
<form method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      


        <legend>Create Activity</legend>
        <div class="form-group">
            <label >Activity Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Activity Name" name="name">
        </div>


        <div class="form-group">
            <!-- Date input -->
            <label class="control-label" for="date">Start Date</label>
            <input class="form-control" id="start_date" name="start_date" placeholder="YYYY/MM/DD" type="date" />
        </div>

        <div class="form-group">
            <!-- Date input -->
            <label class="control-label" for="date">End Date</label>
            <input class="form-control" id="end_date" name="end_date" placeholder="YYYY/MM/DD" type="date" />
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
        </div>


        <button type="submit" class="btn btn-info">Submit</button>
    </form>

</div>

    </div>
   
@endsection
