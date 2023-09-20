@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post">
        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(auth()->user()->role_id==2)
        <legend>Update Project</legend>
        @else
        <legend>Edit Project</legend>
        @endif

        @if(auth()->user()->role_id==1)
        <div class="form-group">
            <label for="formGroupExampleInput">Project Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Project Name" name="name"
                value="{!! $plan->name !!}">
        </div>

        <div class="form-group">
            <!-- Date input -->
            <label class="control-label" for="date">Start Date</label>
            <input class="form-control" id="start_date" name="start_date" placeholder="{!! $plan->start_date !!}"
                type="date" />
        </div>

        <div class="form-group">
            <!-- Date input -->
            <label class="control-label" for="date">End Date</label>
            <input class="form-control" id="end_date" name="end_date" placeholder="{!! $plan->end_date !!}"
                type="date" />
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                name="description">{!! $plan->description !!}</textarea>
        </div>
@endif



        

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>



@endsection
