@extends('layout')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(Session::get('notAllowed'))
    <div class="alert alert-danger">
        {{Session::get('notAllowed')}}

    </div>
@endif
<body class="bg-2">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-12">

                <div class="card o-hidden border-0 shadow-lg my-5 ">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row"> 
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h3 class="welcome">Welcome Back !</h3>
                                        <p>Please Login</p>
                                    </div>
                                    <form class="user" method="POST" action="{{route('login.auth')}}">
                                        @if(Session::get('error'))
                                            <div class="alert alert-danger">
                                                {{Session::get('error')}}

                                            </div>
                                        @endif
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputUsername">Username</label>
                                            <input type="text" class="form-control form-control-user" name="username" id="exampleInputUsername" placeholder="Enter Your Username ...">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword">Password</label>
                                            <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-user btn-block" style="background-color: #DD5353 !important; color:black; ">Login</button>
                                        <br>
                                        <div class="text-center">
                                            <p>Don't Have An Account ?</p>
                                        </div>
                                        <div class="text-center">
                                            <a href="/register">Register</a>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6 image-login d-flex justify-content-center align-items-center">
                                <img src="{{asset('assets/image/login2.jpg')}}"
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</body>
@endsection

