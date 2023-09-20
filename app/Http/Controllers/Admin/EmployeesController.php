<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmployeesRequest;
use App\Http\Requests\Admin\UpdateEmployeesRequest;

class EmployeesController extends Controller
{
    /**
     * Display a listing of Player.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('employee_access')) {
            return abort(401);
        }

        $players = Employee::all();

        return view('admin.Employees.index', compact('players'));
    }

    /**
     * Show the form for creating new Player.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('employee_create')) {
            return abort(401);
        }
        $teams = \App\Department::get()->pluck('name', 'id')->prepend('Please select', '');

        return view('admin.Employees.create', compact('teams'));
    }

    /**
     * Store a newly created Player in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeesRequest $request)
    {
        if (! Gate::allows('employee_create')) {
            return abort(401);
        }
        $player = Employee::create($request->all());



        return redirect()->route('admin.Employees.index');
    }


    /**
     * Show the form for editing Player.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('employee_edit')) {
            return abort(401);
        }
        $teams = \App\Department::get()->pluck('name', 'id')->prepend('Please select', '');

        $player = Employee::findOrFail($id);

        return view('admin.Employees.edit', compact('player', 'teams'));
    }

    /**
     * Update Player in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeesRequest $request, $id)
    {
        if (! Gate::allows('employee_edit')) {
            return abort(401);
        }
        $player = Employee::findOrFail($id);
        $player->update($request->all());



        return redirect()->route('admin.Employees.index');
    }


    /**
     * Display Player.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('employee_view')) {
            return abort(401);
        }
        $player = Employee::findOrFail($id);

        return view('admin.Employees.show', compact('player'));
    }


    /**
     * Remove Player from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('employee_delete')) {
            return abort(401);
        }
        $player = Employee::findOrFail($id);
        $player->delete();

        return redirect()->route('admin.Employees.index');
    }

    /**
     * Delete all selected Player at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('employee_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Employee::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
