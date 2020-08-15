@extends('layouts.app')

@section('content')
<html>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><center>Admin Dashboard</center></div>
                <div class="panel-body">
                    <form method="post" action="/approve">
                        {{ csrf_field() }} 
                        <table class="table table-hover">
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Role</td>
                                <td></td>
                            </tr>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    @if($user->role == 0)
                                    <td>{{$user->role}} (Participant)</td>
                                    @elseif($user->role==1)
                                    <td>{{$user->role}} (Facilitator)</td>
                                    @endif
                                    <td><button type=Submit name="userid" value={{$user->id}}>Approve</button></td>
                                </tr>
                            @endforeach
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

@endsection
