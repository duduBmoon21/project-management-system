@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            {{-- <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}"> --}}
                <li>
                    <a href="{{ url('home') }}">
                    {{-- <a href="{{ url('/') }}"> --}}
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>
       @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            {{-- @can('Department_access')
            @if(auth()->user()->role_id==1)
            <li class="{{ $request->segment(2) == 'teams' ? 'active' : '' }}">
                <a href="{{ route('admin.Departments.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">Departments</span>
                </a>
            </li>
            @endif
            @endcan --}}
            
            {{-- @can('employee_access')
            @if(auth()->user()->role_id==1)
            <li class="{{ $request->segment(2) == 'players' ? 'active' : '' }}">
                <a href="{{ route('admin.Employees.index') }}">
                    <i class="fa fa-user"></i>
                    <span class="title">Employee</span>
                </a>
            </li>
            @endif
            @endcan --}}
              @can('plan_access')
                @if(auth()->user()->role_id==2)
                 <li class="{{ $request->segment(2) == 'plans' ? 'active active-sub' : '' }}">
                        <a href="{{ route('plan.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                               Work
                            </span>
                        </a>
                    </li>
                  
                    {{-- <li class="{{ $request->segment(2) == 'Evaluation' ? 'active active-sub' : '' }}">
                            <a href="{{ route('planevaluate') }}">
                                <i class="fa fa-briefcase"></i>
                                <span class="title">
                                  Evaluation
                                </span>
                            </a>
                        </li> --}}
                        @endif
                       
                @endcan

                @can('plan_access')
                @if(auth()->user()->role_id==1)
                <li class="{{ $request->segment(2) == 'plans' ? 'active active-sub' : '' }}">
                        <a href="{{ route('planadmin') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                               Work List
                            </span>
                        </a>
                    </li>

                    {{-- <li class="{{ $request->segment(2) == 'Evaluation' ? 'active active-sub' : '' }}">
                        <a href="{{ route('evaluateshow') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                              Evaluation
                            </span>
                        </a>
                    </li> --}}
                    @endif
                @endcan

            @if(auth()->user()->role_id==3)
            <li class="{{ $request->segment(2) == 'Activities' ? 'active active-sub' : '' }}">
                    <a href="{{ route('tasks.index') }}">
                        <i class="fa fa-briefcase"></i>
                        <span class="title">
                           Activity List
                        </span>
                    </a>
                </li>
                {{-- <li class="{{ $request->segment(2) == 'Evaluation' ? 'active active-sub' : '' }}">
                    <a href="{{ route('planevaluate') }}">
                        <i class="fa fa-briefcase"></i>
                        <span class="title">
                          Evaluationmmmmmm
                        </span>
                    </a>
                </li> --}}
                @endif
                @if(auth()->user()->role_id==4)
                <li class="{{ $request->segment(2) == 'subactivities' ? 'active active-sub' : '' }}">
                        <a href="{{ route('subtask.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                              Sub Activity List
                            </span>
                        </a>
                    </li>

                    @endif
                    
                    


           <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Change password</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<button type="submit">@lang('quickadmin.logout')</button>
{!! Form::close() !!}
