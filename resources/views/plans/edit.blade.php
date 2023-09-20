@extends('layouts.app')

@section('content')
<div class="row m-3">
	<form method="put" action="{{ route('post.update', $plan->id) }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
        @foreach ($errors->all() as $error)
        <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
		<div class="mb-3">
			<label class="form-label" for="title">Title</label>
			<input type="text" name="title" value="{{ $plan->name }}" class="form-control">
			
		</div>
		<div class="mb-3">
			<label class="form-label" for="body">Body</label>
			<textarea name="body" class="form-control">{{ $plan->start_date }}</textarea>
			
		</div>
		<input type="submit" class="btn btn-info">
		<a href="{{ route('plan.indexx') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
	</form>
</div>
@endsection


