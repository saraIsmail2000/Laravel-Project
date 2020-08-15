@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="container">
    <div class="row">
        <div class="col-md- col-md-offset-1">
            <div class="panel panel-default">
                <center><div class="panel-heading"><center>Workshop Title : {{auth()->user()->workshop->Title}}</center></div>
                @foreach($groups as $group)
                <div class="panel-body" >
                    <form method="post" action="/workshop/kickfromgroup">
                    {{ csrf_field() }} 
                    <table class="w3-table w3-bordered w3-striped ">
                        <tr class="w3-black">
                            <td>Group ID</td>
                            <td colspan="3">The idea :</td>
                        </tr>
                        <tr>
                            <td>{{$group->id}}</td>
                            <td colspan="3">{{$group->idea->solution}}</td>
                        </tr>
                    </table>
                    @if($group->users->count() != 0 )
                    <div class="panel-heading"><center>Joined Users :</center></div>
                        <table border=1 class="w3-table w3-bordered w3-striped ">
                         @foreach ($group->users as $user)
                         <form method="post" action="/kickfromgroup">
                            {{ csrf_field() }} 
                          <tr class="w3-sand">
                            @if($user->id != auth()->user()->id)
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td><button type=Submit name="userid" value={{$user->id}}>Kick Out</button></td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                    @endif
                </form><br><hr>
                </div>
                @endforeach
                <div class="panel-body">
                    <form method="post" action="/workshop/finish">
                    {{ csrf_field() }} 
                    <center><button class="w3-pale-red"  type=Submit>Finalize Workshop</button></center>
                    </form>
                </div>
                </center>
             </div>
        </div>
    </div>
</div>
@endsection
