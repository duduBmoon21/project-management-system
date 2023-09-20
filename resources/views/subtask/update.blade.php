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
        @if(auth()->user()->role_id==10)
        <legend>Update Subactivity</legend>
        @else
        <legend>Edit Subactivity</legend>
        @endif
        @if(auth()->user()->role_id==3)
        <div class="form-group">
            <label for="formGroupExampleInput">Subactivity Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Plan Name" name="name"
                value="{!! $Subactivity->name !!}">
        </div>

        <div class="form-group">
            <!-- Date input -->
            <label class="control-label" for="date">Start Date</label>
            <input class="form-control" id="start_date" name="start_date" placeholder="{!! $Subactivity->start_date !!}"
                type="date" />
        </div>

        <div class="form-group">
            <!-- Date input -->
            <label class="control-label" for="date">End Date</label>
            <input class="form-control" id="end_date" name="end_date" placeholder="{!! $Subactivity->end_date !!}"
                type="date" />
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                name="description">{!! $Subactivity->description !!}</textarea>
        </div>
@endif
        <div class="form-group">
            <label>
                @if(auth()->user()->role_id==10)
           <input type="checkbox" name="status" {!! $Subactivity->status == 3 ?"checked":""!!} >
                Finish this Subactivity?
                @endif
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>



@endsection
