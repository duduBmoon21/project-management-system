@extends('layouts.app')

@section('content')
    <h3 class="page-title">Departments</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.teams.fields.name')</th>
                            <td>{{ $team->name }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#players" aria-controls="players" role="tab" data-toggle="tab">Players</a></li>
<li role="presentation" class=""><a href="#games" aria-controls="games" role="tab" data-toggle="tab">Games</a></li>
<li role="presentation" class=""><a href="#games" aria-controls="games" role="tab" data-toggle="tab">Games</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="players">
<table class="table table-bordered table-striped {{ count($players) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.players.fields.team')</th>
                        <th>@lang('quickadmin.players.fields.name')</th>
                        <th>@lang('quickadmin.players.fields.surname')</th>
                        <th>@lang('quickadmin.players.fields.birth-date')</th>
                        <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @if (count($players) > 0)
            @foreach ($players as $player)
                <tr data-entry-id="{{ $player->id }}">
                    <td>{{ $player->team->name or '' }}</td>
                                <td>{{ $player->name }}</td>
                                <td>{{ $player->surname }}</td>
                                <td>{{ $player->birth_date }}</td>
                                <td>
                                    @can('Employee_view')
                                    <a href="{{ route('admin.Employees.show',[$player->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('Employee_edit')
                                    <a href="{{ route('admin.Employees.edit',[$player->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('Employee_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.Employees.destroy', $player->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>


            <p>&nbsp;</p>

            <a href="{{ route('admin.Departments.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop