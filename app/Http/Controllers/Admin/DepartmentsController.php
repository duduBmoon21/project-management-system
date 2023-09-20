<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDepartmentsRequest;
use App\Http\Requests\Admin\UpdateDepartmentsRequest;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of Team.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('Department_access')) {
            return abort(401);
        }

        $teams = Department::all();

        return view('admin.Departments.index', compact('teams'));
    }

    /**
     * Show the form for creating new Team.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('Department_create')) {
            return abort(401);
        }
        return view('admin.Departments.create');
    }

    /**
     * Store a newly created Team in storage.
     *
     * @param  \App\Http\Requests\StoreDepartmentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentsRequest $request)
    {
        if (! Gate::allows('Department_create')) {
            return abort(401);
        }
        $team = Department::create($request->all());



        return redirect()->route('admin.Departments.index');
    }


    /**
     * Show the form for editing Team.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('Department_edit')) {
            return abort(401);
        }
        $team = Department::findOrFail($id);

        return view('admin.Departments.edit', compact('team'));
    }

    /**
     * Update Team in storage.
     *
     * @param  \App\Http\Requests\UpdateDepartmentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentsRequest $request, $id)
    {
        if (! Gate::allows('Department_edit')) {
            return abort(401);
        }
        $team = Department::findOrFail($id);
        $team->update($request->all());



        return redirect()->route('admin.Departments.index');
    }


    /**
     * Display Team.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('Department_view')) {
            return abort(401);
        }
        $players = \App\Employee::where('dept_id', $id)->get();

        $team = Department::findOrFail($id);

        return view('admin.Departments.show', compact('team', 'players'));
    }


    /**
     * Remove Team from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('Department_delete')) {
            return abort(401);
        }
        $team = Department::findOrFail($id);
        $team->delete();

        return redirect()->route('admin.Departments.index');
    }

    /**
     * Delete all selected Team at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('Department_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Department::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
