@extends('layout')
@section('content')

<body class="bg-1">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-12">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row2"> 
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h3 class="welcome">Welcome !</h3>
                                    </div>
                                    <center>
                                        <hr style="color:#d70000; opacity:100%; width:120px;">
                                    </center>
                            
                                    <br>
                                    <form class="user" method="POST" action="{{route('register.input')}}">
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
                                            <label for="exampleInputName">Name</label>
                                            <input type="text" class="form-control form-control-user" name="name" id="exampleInputName" placeholder="Enter Your Name ...">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername">Username</label>
                                            <input type="text" class="form-control form-control-user" name="username" id="exampleInputUsername" placeholder="Enter Your Username ...">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail">Email</label>
                                            <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="Enter Your Email ...">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword">Password</label>
                                            <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                    
                                
                                        <br>
                                        <button type="submit" class="btn btn-user btn-block" style="background-color: #DD5353 !important; color:black; ">Register</button>
                                        <br>
                                        <div class="text-center">
                                            <p>Already Have Account ?</p>
                                        </div>
                                        <div class="text-center">
                                            <a href="/">Login</a>
                                        </div>
                                        
                                        
                                    </form>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6 image-login d-flex justify-content-center align-items-center">
                                <img src="{{asset('assets/image/login.jpg')}}"
                            </div>
                        </div>
                    </div>
                        
                    
                </div>

            </div>

        </div>

    </div>
</body>