@extends('layouts.auth')

@section('content')
<div class="wrapper">
    <div class="logo">
    <img src="{{ asset('img/downlo.png')}}" alt=""> 
    {{-- <img src="https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-bird-symbols-png-logo-0.png" alt=""> --}}
    </div>
    <div class="text-center mt-4 name">
        Adama Science and Technology University
    </div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were problems with input:
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="p-3 "
                          role="form"
                          method="POST"
                          action="{{ url('login') }}">
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">

                               <div class="form-field d-flex align-items-center">
                                {{-- <span class="far fa-user"></span> --}}
                                <input type="email" id="userName"
                                       {{-- class="form-control" --}}
                                       name="email"
                                       value="{{ old('email') }}" required placeholder="Enter your id">
                            </div>
                        

                            <div class="form-field d-flex align-items-center">
                                {{-- <span class="fas fa-key"></span> --}}
                                <input type="password"
                                       {{-- class="form-control" --}}
                                       name="password"required placeholder="Enter your password">
                            </div>
                        

                 

                        <div class="form-group">
                           
                                <label>
                                    <input type="checkbox"
                                           name="remember"> Remember me
                                </label>
                          
                        </div>

                        <div class="form-group">
                           
                                <button type="submit"
                                class="btn mt-3"
                                        style="margin-right: 15px;">
                                    Login
                                </button>
                         
                        </div>
                    </form>
</div>
              
@endsection