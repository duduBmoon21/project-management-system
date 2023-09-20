@extends('layouts.app')

@section('content')
{{-- <div class="col-lg-12"> --}}
    <div class="card">
        @if (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
    <form method="post" action="{{ route('savesupervisor',$activitys->id) }}">
         <input type="hidden" name="_method" value="PUT">

         <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
        <div class="form-group">
           
            <input type="hidden" class="form-control" id="formGroupExampleInput" placeholder="plan Name" name="name"
                value="{!! $activitys->name !!}">
        </div>
          <div class="form-group">
            <label class="control-label">Choose Unit Leader</label>
            {{-- <input type="number" class="form-control" id="formGroupExampleInput" placeholder="role id of Leader" name="leader"> --}}
           <select class="form-control"  name="leader">
                <option></option>
            @foreach($users as $user)

            <option  style ="red" value="{{ $user->id }}">{{ $user->name }}</option>

     @endforeach
            </select>

        </div>
        <div class="form-group">

            <input  name="plan" value="{{ $plan->id }}"  type="hidden" />
        </div>
            
        <div class="form-group">
            <!-- Date input -->
          
            <input class="form-control" id="start_date" name="start_date" value="{!! $plan->start_date !!}"
                type="hidden" />
        </div>

        <div class="form-group">
            <!-- Date input -->
           
            <input class="form-control" id="end_date" name="end_date" value="{!! $plan->end_date !!}"
                type="hidden" />
        </div>
        <div class="form-group">
       <input class="form-control" id="end_date" name="desc" value="{!! $plan->description !!}"  type="hidden" />
           
        </div>
        <button type="submit" class="btn btn-info">Update</button>
    </form>
</div>



@endsection
