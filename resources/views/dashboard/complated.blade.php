@extends('layout')
@section('content')
<body>
    <br>
    @if(Session::get('successAdd'))
        <div class="alert alert-success mx-auto" style="width: 30cm; height:auto;">
            {{Session::get('successAdd')}}

        </div>
    @endif
    @if(Session::get('successUpdate'))
        <div class="alert alert-success mx-auto" style="width: 30cm; height:auto;">
            {{Session::get('successUpdate')}}
        </div>
    @endif
    @if(Session::get('successDelete'))
        <div class="alert alert-danger mx-auto" style="width: 30cm; height:auto;">
            {{Session::get('successDelete')}}
        </div>
    @endif
    <div class="d-flex">
        <div class="wrapper" style="color: #212529; max-height: 600px;">
            <div class="d-flex align-items-start justify-content-between">
                <div class="d-flex flex-column">
                    <div class="h5">Todo's Completed</div>
                    <br>
                    <p class="text-justify" style="color: aliceblue;">
                        Here's a list of activities you have done
                    </p>
                    <br>
                    <span>
                        <a href="/dashboard/maketodo" class="text-success">Create</a>  <a href="/dashboard/todolist" class="text-warning">My Todos</a>
                    </span>
                </div>
                <div class="info btn ml-md-4 ml-0">
                    <span class="fas fa-info" title="Info"></span>
                </div>
            </div>
            <div class="work border-bottom pt-3">
                <div class="d-flex align-items-center py-2 mt-1">
                    <div>
                        <span class="fas fa-comment btn" style="color: aliceblue;"></span>
                    </div>
                    <div style="color: aliceblue;">{{$todos->count();}} todos</div>
                </div>
            </div>
            <div id="comments" class="mt-1" style="overflow: scroll;">
                <div class="container" style="max-height: 250px; margin-left:-10px;">
                @foreach ($todos as $item)
                    <div class="comment d-flex align-items-start justify-content-between">
                        <div class="row" style="width: 100%;">
                            <div class="col-md-2">
                                @if ($item['status'] == 1)
                                    <span class="fas fa-circle-check text-success btn"></span>
                                    @else
                                        <form action="/complated/{{$item['id']}}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="check fas fa-circle-check" style="background: none; border:0; margin-top:5px; color: #212529;"></button>
                                        </form>
                                @endif
                                {{-- <label class="option">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label> --}}
                            </div>
                            <div class="col-md-8">
                                <a href="/edit/{{ $item['id'] }}" class="title text-justify fw-bold" style="color:#212529; text-decoration:none">
                                    {{ $item['title'] }}
                                </a>
                                <p>{{ $item['description'] }}</p>
                                <span style="color: aliceblue;">
                                    @if ($item['status'] == 1)
                                        Completed On : {{ \Carbon\Carbon::parse($item['done_time'])->format('j F, Y') }}
                                        @else
                                        Target Complate : {{\Carbon\Carbon::parse($item['date'])->format('j F, Y') }}
                                    @endif
                                </span>
                            </div>    
                            <div class="col-md-1"></div>
                            <div class="col-md-1">
                                <form action="{{ route('delete', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="sampah fas fa-trash" style="color: #212529; margin-left:24px; background:none; border:0;"></button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
        <img src="{{asset('assets/image/pagetodo.jpg')}}" class="todolist justify-content-center align-items-center" >
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body> 
</html>

@endsection